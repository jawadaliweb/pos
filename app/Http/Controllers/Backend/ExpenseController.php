<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use Carbon\Carbon;

class ExpenseController extends Controller
    {
        public function ExpenseList(Request $request) {
            $fromDate = $request->input('from_date', now()->startOfMonth());
            $toDate = $request->input('to_date', now()->endOfMonth());

            // Create a new query builder instance for the `Expense` model and filter it by date range.
            $expenses = Expense::query()
                ->whereBetween('date', [$fromDate, $toDate])
                ->get();
        
            return view('backend.expense.expense_list', compact('expenses','fromDate', 'toDate'));
        }
        
        

    public function AddExpense(Request $request) {
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'amount' => $request->amount,
            'date' => $request->date
        ];

        if ($request->hasFile('receipt')) {
            $image = $request->file('receipt');
            $name_generate = time() . '_' . $image->getClientOriginalName();
            $image->move('upload/expenses', $name_generate);
            $data['receipt'] = $name_generate;
        }

        Expense::create($data);

         return redirect()->back()->with('sucess','Expense Added Succesfully')->withInput();
    }


    public function UpdateExpense(Request $request, $id)
{
    $data = [
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'amount' => $request->input('amount'),
        'date' => $request->input('date'),
    ];

    if ($request->hasFile('receipt')) {
        $image = $request->file('receipt');
        $name_generate = time() . '_' . $image->getClientOriginalName();
        $image->move('upload/expenses', $name_generate);
        $data['receipt'] = $name_generate;
    }

    $expense = Expense::find($id);
    if (!$expense) {
        return redirect()->back()->with('error', 'Expense not found');
    }

    $expense->update($data);

    return redirect()->route('expense.list')->with('success', 'Expense updated successfully');
}

public function DeleteExpense($id) {
    // Find the expense and get the image filename
    $expense = Expense::findOrFail($id);
    $imageFilename = $expense->receipt;

    // Delete the image file
    if (!empty($imageFilename)) {
        $imagePath = public_path('upload/expenses/' . $imageFilename);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    // Delete the expense record from the database
    $expense->delete();

    return redirect()->back()->with('success', 'Expense deleted successfully');
}


public function DeleteMultipleExpenses(Request $request) {
  // Get the selected expense IDs.
  $selectedExpenses = $request->input('delete', []);

  // Attempt to delete the selected expenses.
  if (Expense::whereIn('id', $selectedExpenses)->delete()) {
    // Deletion was successful.
    return redirect()->back()->with('success', 'Expense deleted successfully');
  } else {
    // Deletion failed, show an error message.
    return redirect()->back()->with('error', 'An error occurred while deleting expenses');
  }
}


}
