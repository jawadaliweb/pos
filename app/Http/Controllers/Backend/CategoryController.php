<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
   public function CategoryList(){
    $categories = Category::latest()->get();
    return view('backend.category.category_list', compact('categories'));
   }

//    public function categoryform() {
//     $categories = Category::latest()->get();

//     return view('backend.category.add_category', compact('categories'));
    
//    }

   public function AddCategory(Request $request) {
    
    $data = [
    'category_name' => $request->category_name,
    ];

    Category::insert($data);
    return redirect()->route('category.list')->withErrors('success', 'category added successfully')->withInput();
   }


   public function UpdateCategory($id){
       
       $cateogry = Category::findOrfail($id);
       $categories = Category::latest()->get();
    return view('backend.category.update_category', compact('cateogry','categories'));
   }

   public function UpdatingCategory(Request $request, $id) {
    $data = [
        'category_name' => $request->category_name,
        ];

    Category::findOrfail($id)->update($data);
    return redirect()->route('category.list')->with('success', 'Category Successfully deleted');

   }

   public function DeleteCategory($id) {
      $category = Category::find($id);
  
      if (!$category) {
          return redirect()->route('category.list')->with('error', 'Category not found.');
      }
  
      // Check if the category has associated products
      if ($category->products->count() > 0) {
          return redirect()->route('category.list')->with('error', 'Cannot delete category with associated products.');
      }
  
      // If no associated products, proceed with deletion
      $category->delete();
  
      return redirect()->route('category.list')->with('success', 'Category successfully deleted.');
  }
}
