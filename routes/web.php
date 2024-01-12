<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\SalaryController;
use App\Http\Controllers\Backend\AttendanceController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\purchaseControllar;
use App\Http\Controllers\Backend\ProductImportController;
use App\Http\Controllers\Backend\ExpenseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::fallback( function(){
 return redirect('/404');
});

Route::middleware('auth')->controller(DashboardController::class)->group(function () {
    Route::get('/', 'ViewDashboard')->name('dashboard')->middleware(['auth', 'verified']);
});

Route::get('/404', function () {
    return view('backend.pages.404');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('admin/profile/update', [AdminController::class, 'AdminProfileUpdate'])->name('admin.profile.update');

    Route::get('admin/change/password', [AdminController::class, 'ChangePassword'])->name('change.paswword');
    Route::post('change/password', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');

    //employee Routes
    Route::controller(EmployeeController::class)->group(function () {
    Route::get('/view/Employee', 'ViewEmployee')->middleware('permission:employee.view')->name('view.employee');
    Route::get('/add/Employee', 'AddEmployeeForm')->middleware('permission:employee.add')->name('employee.add');
    Route::post('/adding/Employee', 'AddingEmployee')->middleware('permission:employee.add')->name('employee.adding');
    Route::get('/employee/update/{id}', 'UpdateEmployee')->middleware('permission:employee.update')->name('update.employee');
    Route::post('/updating/Employee/{id}', 'UpdatingEmployee')->middleware('permission:employee.update')->name('updating.employee');

    Route::get('/delete/employee/{id}','DeleteEmployee')->middleware('permission:employee.delete')->name('delete.employee');

});


//customer Routes
Route::middleware('auth')->controller(CustomerController::class)->group(function () {
    Route::get('/view/customer', 'ViewCustomer')->middleware('permission:customer.view')->name('view.customer');

    Route::get('/add/customer', function () {
        return view('backend.customer.Add_customer');
    })->middleware('permission:cusotmer.add')->name('customer_add_form');

    // Route::get('/add/Employee', 'AddEmployeeForm')->name('employee.add');
    Route::post('/adding/customer', 'AddingCustomer')->middleware('permission:customer.add')->name('customer.adding');
    Route::get('/customer/update/{id}', 'UpdateCustomer')->middleware('permission:customer.update')->name('update.customer');
    Route::post('/updating/customer/{id}', 'UpdatingCustomer')->middleware('permission:customer.update')->name('updating.customer');

    Route::get('/delete/customer/{id}','DeleteCustomer')->middleware('permission:customer.delete')->name('delete.customer');

});

Route::middleware('auth')->controller(SupplierController::class)->group(function () {
    Route::get('/view/suppliers', 'ViewSuppliers')->middleware('permission:supplier.view')->name('view.suppliers');

    Route::get('/add/supplier', function () {
        return view('backend.supplier.Add_supplier');
    })->middleware('permission:supplier.add')->name('supplier_add_form');

    // Route::get('/add/supplier', 'AddSupplierForm')->name('employee.add');
    Route::post('/adding/supplier', 'AddingSupplier')->middleware('permission:supplier.add')->name('supplier.adding');
    Route::get('/supplier/update/{id}', 'UpdateSupplier')->middleware('permission:supplier.update')->name('update.supplier');
    Route::post('/updating/supplier/{id}', 'UpdatingSupplier')->middleware('permission:supplier.update')->name('updating.supplier');

    Route::get('/supplier/details/{id}', 'SupplierDetails')->middleware('permission:supplier.view')->name('details.supplier');

    Route::get('/delete/supplier/{id}','DeleteSupplier')->middleware('permission:supplier.delete')->name('delete.supplier');

});

});

Route::middleware('auth')->controller(SalaryController::class)->group(function () {
    Route::get('/add/advanceSalary', 'AddAdvanceSalary')->middleware('permission:salary.view')->name('add.advance.salary');
    Route::post('/store/advanceSalary', 'StoreAdvanceSalary')->middleware('permission:salary.add')->name('advance.salary.store');
    Route::get('/all/advanceSalary', 'AllAdvanceSalary')->middleware('permission:salary.view')->name('all.advance.salary');
    Route::get('/advance/update/{id}', 'UpdateAdvance')->middleware('permission:salary.update')->name('update.advance');
    Route::post('/updating/Advance/{id}', 'UpdatingAdvance')->middleware('permission:salary.update')->name('updating.Advance');

    Route::get('/delete/AdvanceSalary/{id}','DeleteAdvance')->middleware('permission:salary.delete')->name('delete.advance');

    
});


Route::middleware('auth')->controller(SalaryController::class)->group(function () {
    Route::get('/pay/salary', 'PaySalary')->middleware('permission:salary.view')->name('PaySalary');
    Route::get('/pay/salary/{id}', 'PayNowSalary')->middleware('permission:salary.view')->name('pay.salary');
    Route::get('/paiad/salaries', 'PaidSalaries')->middleware('permission:salary.add')->name('PaidSalaries');
    Route::post('/store/salary', 'StoreSalary')->middleware('permission:salary.add')->name('store.salary');
});

Route::controller(AttendanceController::class)->group(function () {
    Route::get('/employee/attendance', 'EmployeeAttendanceList')->middleware('permission:attendance.view')->name('employee.attendance.list');
    Route::get('/attendance/add', 'attendanceform')->middleware('permission:attendance.add')->name('attendanceadd');
    
    // Route::get('/pay/salary/{id}', 'PayNowSalary')->name('pay.salary');
    // Route::get('/paiad/salaries', 'PaidSalaries')->name('PaidSalaries');
    Route::post('/store/attendance', 'AddAttendance')->middleware('permission:attendance.add')->name('attendance.store');
    Route::get('/attendance/list', 'EmployeeAttendanceList')->middleware('permission:attendance.view')->name('attendance.list');

});



Route::middleware('auth')->controller(CategoryController::class)->group(function () {
    Route::get('/category/list', 'CategoryList')->middleware('permission:category.view')->name('category.list');
    Route::post('/store/category', 'AddCategory')->middleware('permission:category.add')->name('add.category');
    Route::post('/update/category/{id}', 'UpdatingCategory')->middleware('permission:category.update')->name('updating.category');
    Route::get('/delete/category/{id}','DeleteCategory')->middleware('permission:category.delete')->name('delete.category');
    Route::get('/update/category/{id}','UpdateCategory')->middleware('permission:category.update')->name('update.category');
});

Route::middleware('auth')->controller(ProductController::class)->group(function () {
    Route::get('/product/list', 'ProductList')->middleware('permission:product.view')->name('product.list');
    // Route::get('/category/add/', 'categoryform')->name('categoryform');
    Route::post('/store/product', 'AddProduct')->middleware('permission:product.add')->name('add.product');
    Route::get('/delete/product/{id}','DeleteProduct')->middleware('permission:product.delete')->name('delete.product');
    Route::get('/update/product/{id}','UpdateProduct')->middleware('permission:product.update')->name('update.product');
    Route::post('/updating/product/{id}', 'UpdatingProduct')->middleware('permission:product.update')->name('updating.product');

});

Route::middleware('auth')->controller(purchaseControllar::class)->group(function () {
    Route::get('/purchase/list', 'AddForm')->middleware('permission:purchase.view')->name('pruchase.form');
    Route::post('/purchase/store', 'AddPurchase')->middleware('permission:purchase.view')->name('product.purchase');
    Route::get('/purchase/view', 'ViewPurchase')->middleware('permission:purchase.view')->name('view.purchase');
    Route::get('/stock/delete/{id}', 'DeleteStock')->middleware('permission:purchase.delete')->name('delete.stock');
    Route::get('/purchase/delete/{id}', 'DeletePurchase')->middleware('permission:purchase.delete')->name('delete.purchase');
});

Route::middleware('auth')->controller(ProductImportController::class)->group(function () {
    Route::post('/products/import', 'import')->name('product.import');
});


Route::middleware('auth')->controller(ExpenseController::class)->group(function () {
    Route::get('/expense/list', 'ExpenseList')->middleware('permission:expense.view')->name('expense.list');
    Route::post('/add/expense', 'AddExpense')->middleware('permission:expense.add')->name('add.expense');
    Route::put('/update/expense/{id}', 'UpdateExpense')->middleware('permission:expense.update')->name('update.expense');
    Route::get('/delete/expense/{id}', 'DeleteExpense')->middleware('permission:expense.delete')->name('delete.expense');
    Route::delete('/delete-multiple-expenses', 'DeleteMultipleExpenses')->middleware('permission:expense.delete')->name('delete.multiple.expenses');

});

Route::middleware('auth')->controller(SaleController::class)->group(function () {
    Route::get('/view/sale', 'SaleView')->middleware('permission:stock.view')->name('sale.view');
    Route::post('/sale/store', 'SaleStore')->middleware('permission:stock.add')->name('sale.store');

});


Route::middleware('auth')->controller(RoleController::class)->group(function () {
    Route::get('/all/permissions', 'AllPermissions')->middleware('permission:roles.view')->name('all.permissions');
    Route::get('/add/permissions', 'AddPermissions')->middleware('permission:roles.add')->name('add.permissions');
    Route::post('/store/permission', 'StorePermission')->middleware('permission:roles.add')->name('permission.store');
    Route::get('/update/permissions/{id}', 'UpdatePermission')->middleware('permission:roles.update')->name('permission.update');
    Route::post('/edit/permission/{id}', 'EditPermission')->middleware('permission:roles.update')->name('permission.edit');
    Route::get('/delete/permissions/{id}', 'DeletePermission')->middleware('permission:roles.delete')->name('permission.delete');


//////////////////Role Routes////////////////////////////////

    Route::get('/all/roles', 'AllRoles')->middleware('permission:roles.view')->name('all.roles');
    Route::get('/add/roles', 'AddRoles')->middleware('permission:roles.add')->name('add.roles');
    Route::post('/store/roles', 'StoreRoles')->middleware('permission:roles.add')->name('roles.store');
    Route::get('/update/roles/{id}', 'UpdateRoles')->middleware('permission:roles.update')->name('roles.update');
    Route::post('/edit/roles/{id}', 'EditRoles')->middleware('permission:roles.update')->name('roles.edit');
    Route::get('/delete/roles/{id}', 'DeleteRoles')->middleware('permission:roles.delete')->name('roles.delete');
    
    
    /////////////////Assisgn Permission//////////////////////////
    
    Route::get('/all/permission', 'AllPermission')->middleware('permission:roles.view')->name('assing.permission');
    Route::post('/assign/roles/permission', 'AssignRolesPermission')->middleware('permission:roles.add')->name('roles_permissions.store');
    
    /////////////////Assisgn Permission//////////////////////////
    
    Route::get('/all/users', 'UserList')->middleware('permission:roles.view')->name('users.list');
    Route::post('/add/user/', 'registeruser')->middleware('permission:roles.add')->name('add.user');

    Route::get('/users/edit/{id}/', 'UserEdit')->middleware('permission:roles.update')->name('edit.user');
    Route::put('/users/update/{id}', 'UserUpdate')->middleware('permission:roles.update')->name('update.user');
    Route::get('/users/delete/{id}', 'UserDelete')->middleware('permission:roles.delete')->name('delete.user');

});


require __DIR__.'/auth.php';
