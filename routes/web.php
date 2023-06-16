<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    return view('auth.login-home');
})->name('home')->middleware('guest');

Route::get('/json', function () {
   $arr = [];

   for( $i = 52; $i<= 117; $i++ ){
    $arr[] = "pendrive-".$i;
   }
   return response()->json([
    "data" => $arr,
    "count" => count($arr),
   ]

);


    return view('auth.login-home');
});



Auth::routes();

Route::get('login', function () {
    return redirect(route('home'));
})->name('login')->middleware('guest');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group(['prefix'=>'admin','as'=>'admin.','namespace'=>'Admin','middleware'=>['auth','admin']], function(){

    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    //Roles Route
    Route::get('roles', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('roles.index');
    Route::post('roles', [App\Http\Controllers\Admin\RoleController::class, 'store'])->name('roles.store');
    Route::delete('roles/{id}', [App\Http\Controllers\Admin\RoleController::class, 'destroy'])->name('roles.destroy');

    //ProductType Route
    Route::get('product-types', [App\Http\Controllers\Admin\ProductTypeController::class, 'index'])->name('product-types.index');
    Route::post('product-types', [App\Http\Controllers\Admin\ProductTypeController::class, 'store'])->name('product-types.store');
    Route::get('product-types/{id}', [App\Http\Controllers\Admin\ProductTypeController::class, 'edit'])->name('product-types.edit');
    Route::put('product-types/{id}', [App\Http\Controllers\Admin\ProductTypeController::class, 'update'])->name('product-types.update');
    Route::delete('product-types/{id}', [App\Http\Controllers\Admin\ProductTypeController::class, 'destroy'])->name('product-types.destroy');


    //Products Route
    Route::get('products', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('products.index');
    Route::post('products', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('products.store');
    Route::get('products/{id}', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('products.edit');
    Route::PUT('products/{id}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{id}', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('products.destroy');

    //Suppliers Route
    Route::get('suppliers', [App\Http\Controllers\Admin\SupplierController::class, 'index'])->name('suppliers.index');
    Route::post('suppliers', [App\Http\Controllers\Admin\SupplierController::class, 'store'])->name('suppliers.store');
    Route::get('suppliers/{id}', [App\Http\Controllers\Admin\SupplierController::class, 'edit'])->name('suppliers.edit');
    Route::PUT('suppliers/{id}', [App\Http\Controllers\Admin\SupplierController::class, 'update'])->name('suppliers.update');
    Route::delete('suppliers/{id}', [App\Http\Controllers\Admin\SupplierController::class, 'destroy'])->name('suppliers.destroy');
    Route::get('suppliers/check-unique', [App\Http\Controllers\Admin\SupplierController::class, 'unique'])->name('suppliers.check.unique');

    //Departments Route
    Route::get('departments', [App\Http\Controllers\Admin\DepartmentController::class, 'index'])->name('departments.index');
    Route::post('departments', [App\Http\Controllers\Admin\DepartmentController::class, 'store'])->name('departments.store');
    Route::get('departments/{id}', [App\Http\Controllers\Admin\DepartmentController::class, 'edit'])->name('departments.edit');
    Route::PUT('departments/{id}', [App\Http\Controllers\Admin\DepartmentController::class, 'update'])->name('departments.update');
    Route::delete('departments/{id}', [App\Http\Controllers\Admin\DepartmentController::class, 'destroy'])->name('departments.destroy');

    //Employees Route

    Route::get('employees', [App\Http\Controllers\Admin\EmployeeController::class, 'index'])->name('employees.index');
    Route::get('employees/create', [App\Http\Controllers\Admin\EmployeeController::class, 'create'])->name('employees.create');
    Route::post('employees', [App\Http\Controllers\Admin\EmployeeController::class, 'store'])->name('employees.store');
    Route::get('employees/{id}', [App\Http\Controllers\Admin\EmployeeController::class, 'show'])->name('employees.show');
    Route::get('employees/{id}/edit', [App\Http\Controllers\Admin\EmployeeController::class, 'edit'])->name('employees.edit');
    Route::PUT('employees/{id}', [App\Http\Controllers\Admin\EmployeeController::class, 'update'])->name('employees.update');
    Route::post('employees/status/{id}', [App\Http\Controllers\Admin\EmployeeController::class, 'updateStatus'])->name('employees.status');
    Route::delete('employees/{id}', [App\Http\Controllers\Admin\EmployeeController::class, 'destroy'])->name('employees.destroy');

    //Purchases Route

    Route::get('purchases', [App\Http\Controllers\Admin\PurchaseController::class, 'index'])->name('purchases.index');
    Route::get('purchases/create', [App\Http\Controllers\Admin\PurchaseController::class, 'create'])->name('purchases.create');
    Route::post('purchases', [App\Http\Controllers\Admin\PurchaseController::class, 'store'])->name('purchases.store');
    Route::get('purchases/{id}', [App\Http\Controllers\Admin\PurchaseController::class, 'show'])->name('purchases.show');
    Route::get('purchases/{id}/edit', [App\Http\Controllers\Admin\PurchaseController::class, 'edit'])->name('purchases.edit');
    Route::PUT('purchases/{id}', [App\Http\Controllers\Admin\PurchaseController::class, 'update'])->name('purchases.update');
    Route::delete('purchases/{id}', [App\Http\Controllers\Admin\PurchaseController::class, 'destroy'])->name('purchases.destroy');


    Route::get('purchased-products', [App\Http\Controllers\Admin\PurchaseController::class, 'purchasedProducts'])->name('purchased.products');
    Route::get('purchased-products/{id}', [App\Http\Controllers\Admin\PurchaseController::class, 'purchasedProductShow'])->name('purchased.products.show');


    Route::get('invoice', [App\Http\Controllers\Admin\PurchaseController::class, 'invoice'])->name('purchases.invoice');
    Route::get('grn/{id}', [App\Http\Controllers\Admin\PurchaseController::class, 'grn'])->name('purchases.grn');


    Route::post('purchases/inventory/{id}', [App\Http\Controllers\Admin\PurchaseController::class, 'addInventory'])->name('purchases.inventory');
    Route::get('purchases/typed/{id}', [App\Http\Controllers\Admin\PurchaseController::class, 'typedProducts'])->name('purchases.typed.product');
    Route::get('purchases/product/{id}', [App\Http\Controllers\Admin\PurchaseController::class, 'product'])->name('purchases.product');

    //Inventories Route
    Route::get('inventories', [App\Http\Controllers\Admin\InventoryController::class, 'index'])->name('inventories.index');
    Route::get('inventories/{id}', [App\Http\Controllers\Admin\InventoryController::class, 'show'])->name('inventories.show');
    Route::get('inventories/create', [App\Http\Controllers\Admin\InventoryController::class, 'create'])->name('inventories.create');
    Route::post('inventories', [App\Http\Controllers\Admin\InventoryController::class, 'store'])->name('inventories.store');
    Route::post('inventories/{id}', [App\Http\Controllers\Admin\InventoryController::class, 'update'])->name('inventories.update');

    //Transection Route
    Route::get('transections', [App\Http\Controllers\Admin\TransectionController::class, 'index'])->name('transections.index');
    Route::get('transections/create', [App\Http\Controllers\Admin\TransectionController::class, 'create'])->name('transections.create');
    Route::post('transections', [App\Http\Controllers\Admin\TransectionController::class, 'store'])->name('transections.store');
    Route::get('transections/{id}', [App\Http\Controllers\Admin\TransectionController::class, 'show'])->name('transections.show');
    Route::put('transections/{id}', [App\Http\Controllers\Admin\TransectionController::class, 'update'])->name('transections.update');
    Route::get('transections/ack/{id}', [App\Http\Controllers\Admin\TransectionController::class, 'ack'])->name('transections.ack');
    Route::get('typed-products/{id}', [App\Http\Controllers\Admin\TransectionController::class, 'typedProducts'])->name('transections.typed.products');
    Route::get('single-stock/{id}', [App\Http\Controllers\Admin\TransectionController::class, 'singleStock'])->name('transections.stock');
    Route::get('transec', [App\Http\Controllers\Admin\TransectionController::class, 'test'])->name('transections.test');


    //Users Route
    Route::get('users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::post('users', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
    Route::get('users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
    Route::delete('users/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');

    //Reports Route
    Route::get('reports/employees', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/get-report', [App\Http\Controllers\Admin\ReportController::class, 'getReport'])->name('reports.get');
    Route::get('reports/employees/{id}', [App\Http\Controllers\Admin\ReportController::class, 'show'])->name('reports.show');

    Route::get('reports/transections', [App\Http\Controllers\Admin\ReportController::class, 'transections'])->name('reports.transections');

     // Management Routes
     Route::get('management/employees', [App\Http\Controllers\Admin\ManagementController::class, 'employees'])->name('management.employees');
     Route::get('management/employees/{id}', [App\Http\Controllers\Admin\ManagementController::class, 'editEmployee'])->name('management.employees.edit');
     Route::post('management/employees/{id}', [App\Http\Controllers\Admin\ManagementController::class, 'updateEmployee'])->name('management.employees.update');
     Route::get('management/products', [App\Http\Controllers\Admin\ManagementController::class, 'products'])->name('management.products');
     Route::post('management/products/{id}', [App\Http\Controllers\Admin\ManagementController::class, 'updateProducts'])->name('management.products.update');



    //EXCHANGE Route
    Route::get('exchange-input', [App\Http\Controllers\Admin\ReturnExchangeController::class, 'exchange'])->name('exchange.show');
    Route::get('exchange-print', [App\Http\Controllers\Admin\ReturnExchangeController::class, 'exchangePrint'])->name('exchange.print');



     // Imports Route
     Route::get('imports/stocks', [App\Http\Controllers\Admin\ImportController::class, 'getStock'])->name('imports.stocks');
     Route::post('imports/stocks', [App\Http\Controllers\Admin\ImportController::class, 'stockStore'])->name('imports.stocks.store');


     //Print multi ACK
     Route::post('transections/multi-ack', [App\Http\Controllers\Admin\TransectionController::class, 'multiAck'])->name('transections.multi.ack');

     //Print return Form
     Route::get('transections/return/{id}', [App\Http\Controllers\Admin\TransectionController::class, 'return'])->name('transections.return');
});




//Author Routes

Route::group(['prefix'=>'author','as'=>'author.','namespace'=>'Author','middleware'=>['auth','author']], function(){
    Route::get('dashboard', [App\Http\Controllers\Author\DashboardController::class, 'index'])->name('dashboard');




    // Department Route
    Route::get('departments', [App\Http\Controllers\Author\DepartmentController::class, 'index'])->name('departments.index');
    Route::post('departments', [App\Http\Controllers\Author\DepartmentController::class, 'store'])->name('departments.store');


    //Employees Route



    Route::get('employees', [App\Http\Controllers\Author\EmployeeController::class, 'index'])->name('employees.index');
    Route::get('employees/create', [App\Http\Controllers\Author\EmployeeController::class, 'create'])->name('employees.create');
    Route::post('employees', [App\Http\Controllers\Author\EmployeeController::class, 'store'])->name('employees.store');
    Route::get('employees/{id}', [App\Http\Controllers\Author\EmployeeController::class, 'show'])->name('employees.show');
    Route::get('employees/{id}/edit', [App\Http\Controllers\Author\EmployeeController::class, 'edit'])->name('employees.edit');
    Route::PUT('employees/{id}', [App\Http\Controllers\Author\EmployeeController::class, 'update'])->name('employees.update');
    Route::post('employees/status/{id}', [App\Http\Controllers\Author\EmployeeController::class, 'updateStatus'])->name('employees.status');
    Route::delete('employees/{id}', [App\Http\Controllers\Author\EmployeeController::class, 'destroy'])->name('employees.destroy');


    //Purchases Route

    Route::get('purchases', [App\Http\Controllers\Author\PurchaseController::class, 'index'])->name('purchases.index');
    Route::get('purchases/create', [App\Http\Controllers\Author\PurchaseController::class, 'create'])->name('purchases.create');
    Route::post('purchases', [App\Http\Controllers\Author\PurchaseController::class, 'store'])->name('purchases.store');
    Route::get('purchases/{id}', [App\Http\Controllers\Author\PurchaseController::class, 'show'])->name('purchases.show');
    Route::get('purchases/{id}/edit', [App\Http\Controllers\Author\PurchaseController::class, 'edit'])->name('purchases.edit');
    Route::PUT('purchases/{id}', [App\Http\Controllers\Author\PurchaseController::class, 'update'])->name('purchases.update');
    // Route::delete('purchases/{id}', [App\Http\Controllers\Author\PurchaseController::class, 'destroy'])->name('purchases.destroy');

    Route::post('purchases/inventory/{id}', [App\Http\Controllers\Author\PurchaseController::class, 'addInventory'])->name('purchases.inventory');


    //Inventories Route
    Route::get('inventories', [App\Http\Controllers\Author\InventoryController::class, 'index'])->name('inventories.index');
    Route::get('inventories/{id}', [App\Http\Controllers\Author\InventoryController::class, 'show'])->name('inventories.show');
    Route::get('inventories/create', [App\Http\Controllers\Author\InventoryController::class, 'create'])->name('inventories.create');
    Route::post('inventories', [App\Http\Controllers\Author\InventoryController::class, 'store'])->name('inventories.store');
    Route::put('inventories/{id}', [App\Http\Controllers\Author\InventoryController::class, 'update'])->name('inventories.update');


    //Transection Route
    Route::get('transections', [App\Http\Controllers\Author\TransectionController::class, 'index'])->name('transections.index');
    Route::get('transections/create', [App\Http\Controllers\Author\TransectionController::class, 'create'])->name('transections.create');
    Route::post('transections', [App\Http\Controllers\Author\TransectionController::class, 'store'])->name('transections.store');
    Route::get('transections/{id}', [App\Http\Controllers\Author\TransectionController::class, 'show'])->name('transections.show');
    // Route::put('transections/{id}', [App\Http\Controllers\Author\TransectionController::class, 'update'])->name('transections.update');

    // Management Routes
    Route::get('management/employees', [App\Http\Controllers\Author\ManagementController::class, 'employees'])->name('management.employees');
    Route::get('management/employees/{id}', [App\Http\Controllers\Author\ManagementController::class, 'editEmployee'])->name('management.employees.edit');
    Route::post('management/employees/{id}', [App\Http\Controllers\Author\ManagementController::class, 'updateEmployee'])->name('management.employees.update');
    Route::get('management/products', [App\Http\Controllers\Author\ManagementController::class, 'products'])->name('management.products');
    Route::post('management/products/{id}', [App\Http\Controllers\Author\ManagementController::class, 'updateProducts'])->name('management.products.update');


    //Reports Route
    Route::get('reports/employees', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/get-report', [App\Http\Controllers\Admin\ReportController::class, 'getReport'])->name('reports.get');
    Route::get('reports/employees/{id}', [App\Http\Controllers\Admin\ReportController::class, 'show'])->name('reports.show');

    Route::get('reports/transections', [App\Http\Controllers\Admin\ReportController::class, 'transections'])->name('reports.transections');



});


Route::group(['middleware'=>['auth']], function(){
    Route::get('xyz', [App\Http\Controllers\ReportController::class, 'index'])->name('xyz.index');
    Route::match(array('GET', 'POST'), 'settings/password', [App\Http\Controllers\SettingController::class, 'password'])->name('settings.password');
    Route::match(array('GET', 'POST'), 'settings/profile', [App\Http\Controllers\SettingController::class, 'profile'])->name('settings.profile');

    Route::get('policy-print/{id}', [App\Http\Controllers\SettingController::class, 'policy'])->name('settings.policy');

    Route::get('ppath', function (){

        $path = [
            'base' => base_path('public'),
            'pub'  => public_path(),
        ];
        return $path;
    });



});
Route::post('admin/login', [App\Http\Controllers\LoginController::class, 'postLogin'])->name('add.login');
