<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

if(Auth::user())
    Route::get('/', 'App\Http\Controllers\DashboardController@index');
if(Auth::guest())
    Route::get('/', function () {
        return view('auth.login');
    })->middleware('guest');




Route::get('/register', function () {
    return view('auth.register');
} )->name('register');


//auth route for all
Route::group(['middleware' => ['auth']], function() {
   Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
    Route::get('/user/reset', 'App\\Http\\Controllers\\UserController@userReset' )->name('user.reset');
    Route::post('/user/userUpdate', 'App\\Http\\Controllers\\UserController@userUpdate' )->name('user.userUpdate');

});


 //for administrator
Route::group(['middleware' => ['auth', 'role:administrator']], function() {
    Route::get('/graphs', 'App\\Http\\Controllers\\GraphsController@index')->name('graphs');
    Route::get('/users', '\App\Http\Controllers\UserController@index')->name('users');
    Route::get('/createuser', '\App\Http\Controllers\UserController@create')->name('createuser');
    Route::post('/createuser', '\App\Http\Controllers\UserController@store')->name('user.store');
    Route::get('/user/edit/{id}', 'App\\Http\\Controllers\\UserController@edit' )->name('user.edit');
    Route::post('/user/update/{id}', 'App\\Http\\Controllers\\UserController@update' )->name('user.update');
    Route::post('/user/changename/{id}', 'App\\Http\\Controllers\\UserController@changeName' )->name('user.changeName');
    Route::get('/user/destroy/{id}', 'App\\Http\\Controllers\\UserController@destroy' )->name('user.destroy');
    Route::get('/user/hdelete/{id}', 'App\\Http\\Controllers\\UserController@hdelete' )->name('user.hdelete');
    Route::get('/user/restore/{id}', 'App\\Http\\Controllers\\UserController@restore' )->name('user.restore');
    Route::get('/users/trashed', 'App\\Http\\Controllers\\UserController@usersTrashed' )->name('users.trashed');
});


// for recipient
Route::group(['middleware' => ['auth', 'role:recipient|administrator']], function() {
   ///orders
   Route::get('/orders', 'App\\Http\\Controllers\\OrderController@index' )->name('orders');
   Route::get('/orders/{status}', 'App\\Http\\Controllers\\OrderController@indexPerStatus' )->name('orders.status');
   Route::get('/orders/trashed', 'App\\Http\\Controllers\\OrderController@ordersTrashed' )->name('orders.trashed');
   Route::get('/order/create', 'App\\Http\\Controllers\\OrderController@create' )->name('order.create');
   Route::get('/order/confirm', 'App\\Http\\Controllers\\OrderController@confirm' )->name('order.confirm');
   Route::get('/order/retry/{id}', 'App\\Http\\Controllers\\OrderController@retry' )->name('order.retry');
   Route::get('/order/finish/{id}', 'App\\Http\\Controllers\\OrderController@finish' )->name('order.finish');
   Route::get('/approve/{id}', 'App\\Http\\Controllers\\OrderController@approve' )->name('approve');
   Route::get('/estimate/{id}', 'App\\Http\\Controllers\\OrderController@estimate' )->name('estimate');
   Route::get('/order/export/{id}', 'App\\Http\\Controllers\\OrderController@export' )->name('order.export');

   //Route::get('/order/searchbyitem/{item}', 'App\\Http\\Controllers\\OrderController@searchByItem');
   //Route::get('/order/searchbycustomer/{customer}', 'App\\Http\\Controllers\\OrderController@searchByCustomer');
   Route::get('/order/action',  'App\\Http\\Controllers\\OrderController@action')->name('order.action');
   Route::get('/order/action2',  'App\\Http\\Controllers\\OrderController@action2')->name('order.action2');

   Route::post('/order/store', 'App\\Http\\Controllers\\OrderController@store' )->name('order.store');
   Route::get('/order/show/{id}', 'App\\Http\\Controllers\\OrderController@show' )->name('order.show');
   Route::get('/order/edit/{id}', 'App\\Http\\Controllers\\OrderController@edit' )->name('order.edit');
   Route::get('/order/editconfirm/{id}', 'App\\Http\\Controllers\\OrderController@editconfirm' )->name('order.editconfirm');

   Route::post('/order/update/{id}', 'App\\Http\\Controllers\\OrderController@update' )->name('order.update');
   Route::post('/order/updateconfirm/{id}', 'App\\Http\\Controllers\\OrderController@updateconfirm' )->name('order.updateconfirm');

   Route::get('/order/destroy/{id}', 'App\\Http\\Controllers\\OrderController@destroy' )->name('order.destroy');
   Route::get('/order/hdelete/{id}', 'App\\Http\\Controllers\\OrderController@hdelete' )->name('order.hdelete');
   Route::get('/order/restore/{id}', 'App\\Http\\Controllers\\OrderController@restore' )->name('order.restore');
   Route::get('/order/orderPhotoDownload/{id}', 'App\\Http\\Controllers\\OrderController@orderPhotoDownload' )->name('recipientDownload');
   Route::get('/order/ordercustomPhotoDownload/{id}', 'App\\Http\\Controllers\\OrderController@ordercustomPhotoDownload' )->name('recipientDownload1');



   ///items
   Route::get('/items', 'App\\Http\\Controllers\\ItemController@index' )->name('items');
   Route::get('/items/trashed', 'App\\Http\\Controllers\\ItemController@itemsTrashed' )->name('items.trashed');
   Route::get('/item/create', 'App\\Http\\Controllers\\ItemController@create' )->name('item.create');
   Route::post('/item/store', 'App\\Http\\Controllers\\ItemController@store' )->name('item.store');
   Route::get('/item/show/{id}', 'App\\Http\\Controllers\\ItemController@show' )->name('item.show');
   Route::get('/item/edit/{id}', 'App\\Http\\Controllers\\ItemController@edit' )->name('item.edit');
   Route::post('/item/update/{id}', 'App\\Http\\Controllers\\ItemController@update' )->name('item.update');
   Route::get('/item/destroy/{id}', 'App\\Http\\Controllers\\ItemController@destroy' )->name('item.destroy');
   Route::get('/item/hdelete/{id}', 'App\\Http\\Controllers\\ItemController@hdelete' )->name('item.hdelete');
   Route::get('/item/restore/{id}', 'App\\Http\\Controllers\\ItemController@restore' )->name('item.restore');

   //customers
   Route::get('/customers', 'App\\Http\\Controllers\\CustomerController@index' )->name('customers');
    Route::get('/customers/trashed', 'App\\Http\\Controllers\\CustomerController@customersTrashed' )->name('customers.trashed');
    Route::get('/customer/create', 'App\\Http\\Controllers\\CustomerController@create' )->name('customer.create');
    Route::post('/customer/store', 'App\\Http\\Controllers\\CustomerController@store' )->name('customer.store');
    Route::get('/customer/show/{customer}', 'App\\Http\\Controllers\\CustomerController@show' )->name('customer.show');
    Route::get('/customer/edit/{customer}', 'App\\Http\\Controllers\\CustomerController@edit' )->name('customer.edit');
    Route::post('/customer/update/{customer}', 'App\\Http\\Controllers\\CustomerController@update' )->name('customer.update');
    Route::post('/customer/destroy/{customer}', 'App\\Http\\Controllers\\CustomerController@destroy' )->name('customer.destroy');
    Route::post('/customer/hdelete/{id}', 'App\\Http\\Controllers\\CustomerController@hdelete' )->name('customer.hdelete');
    Route::get('/customer/restore/{id}', 'App\\Http\\Controllers\\CustomerController@restore' )->name('customer.restore');


});


// for designer
Route::group(['middleware' => ['auth', 'role:designer']], function() {
    Route::get('/orders/designerorders/{id}', 'App\\Http\\Controllers\\OrderController@designerorders' )->name('designerorders');
    Route::get('/order/designeraccept/{id}', 'App\\Http\\Controllers\\OrderController@designeraccept' )->name('designeraccept');
    Route::get('/order/designerend/{id}', 'App\\Http\\Controllers\\OrderController@designerend' )->name('designerend');
    Route::post('/order/designersubmit/{id}', 'App\\Http\\Controllers\\OrderController@designersubmit' )->name('designersubmit');
    Route::get('/order/designercancel/{id}', 'App\\Http\\Controllers\\OrderController@designercancel' )->name('designercancel');
    Route::get('/order/designerPhotoDownload/{id}', 'App\\Http\\Controllers\\OrderController@orderPhotoDownload' )->name('designerDownload');
    Route::get('/order/designerPhotoDownload1/{id}', 'App\\Http\\Controllers\\OrderController@ordercustomPhotoDownload' )->name('designerDownload1');
     Route::get('/orders/designeritemsorder/{id}', 'App\\Http\\Controllers\\OrderController@itemsorder' )->name('designeritemsorder');
 });

// for printworker
Route::group(['middleware' => ['auth', 'role:printworker']], function() {
    Route::get('/orders/printworkerorders/{id}', 'App\\Http\\Controllers\\OrderController@printworkerorders' )->name('printworkerorders');
    Route::get('/orders/printworkeritemsorder/{id}', 'App\\Http\\Controllers\\OrderController@printworkeritemsorder' )->name('printworkeritemsorder');
    Route::get('/order/printworkeraccept/{id}', 'App\\Http\\Controllers\\OrderController@printworkeraccept' )->name('printworkeraccept');
    Route::get('/order/printworkersubmit/{id}', 'App\\Http\\Controllers\\OrderController@printworkersubmit' )->name('printworkersubmit');
    Route::get('/order/printworkercancel/{id}', 'App\\Http\\Controllers\\OrderController@printworkercancel' )->name('printworkercancel');
    Route::get('/order/printworkerdownload/{id}', 'App\\Http\\Controllers\\OrderController@printworkerdownload' )->name('printworkerdownload');
});

// for accountant
Route::group(['middleware' => ['auth', 'role:accountant']], function() {
   // Route::get('/invoices', 'App\\Http\\Controllers\\InvoiceController@index' )->name('invoices');
   //Route::get('/invoices/trashed', 'App\\Http\\Controllers\\InvoiceController@invoicesTrashed' )->name('invoices.trashed');
    //Route::get('/invoices/create/{id}', 'App\\Http\\Controllers\\InvoiceController@create' )->name('invoice.create');
    //Route::post('/invoices/store/{id}', 'App\\Http\\Controllers\\InvoiceController@store' )->name('invoice.store');
    //Route::get('/invoices/show/{id}', 'App\\Http\\Controllers\\InvoiceController@show' )->name('invoice.show');
    //Route::get('/invoices/itemsorder/{id}', 'App\\Http\\Controllers\\InvoiceController@itemsorder' )->name('invoice.itemsorder');
    //Route::get('/invoices/edit/{id}', 'App\\Http\\Controllers\\InvoiceController@edit' )->name('invoice.edit');
    //Route::post('/invoices/update/{id}', 'App\\Http\\Controllers\\InvoiceController@update' )->name('invoice.update');
    //Route::get('/invoices/destroy/{id}', 'App\\Http\\Controllers\\InvoiceController@destroy' )->name('invoice.destroy');
    //Route::get('/invoices/hdelete/{id}', 'App\\Http\\Controllers\\InvoiceController@hdelete' )->name('invoice.hdelete');
    //Route::get('/invoices/restore/{id}', 'App\\Http\\Controllers\\InvoiceController@restore' )->name('invoice.restore');
    //Route::get('/invoices/export/{id}', 'App\\Http\\Controllers\\InvoiceController@export' )->name('invoice.export');

    Route::get('/orders/accountantorders/{id}', 'App\\Http\\Controllers\\OrderController@accountantorders' )->name('accountantorders');
    Route::get('/order/accountantaccept/{id}', 'App\\Http\\Controllers\\OrderController@accountantaccept' )->name('accountantaccept');
    Route::post('/order/accountantsubmit/{id}', 'App\\Http\\Controllers\\OrderController@accountantsubmit' )->name('accountantsubmit');
    Route::get('/order/accountantcancel/{id}', 'App\\Http\\Controllers\\OrderController@accountantcancel' )->name('accountantcancel');
    Route::get('/order/accountantdownload/{id}', 'App\\Http\\Controllers\\OrderController@accountantdownload' )->name('accountantdownload');
    Route::get('/orders/accountantitemsorder/{id}', 'App\\Http\\Controllers\\OrderController@accountantitemsorder' )->name('accountantitemsorder');
});

// for packager
Route::group(['middleware' => ['auth', 'role:packager']], function() {
    Route::get('/orders/packagerorders/{id}', 'App\\Http\\Controllers\\OrderController@packagerorders' )->name('packagerorders');
    Route::get('/orders/packageritemsorder/{id}', 'App\\Http\\Controllers\\OrderController@packageritemsorder' )->name('packageritemsorder');
    Route::get('/order/packageraccept/{id}', 'App\\Http\\Controllers\\OrderController@packageraccept' )->name('packageraccept');
    Route::get('/order/packagersubmit/{id}', 'App\\Http\\Controllers\\OrderController@packagersubmit' )->name('packagersubmit');
    Route::get('/order/packagercancel/{id}', 'App\\Http\\Controllers\\OrderController@packagercancel' )->name('packagercancel');
    Route::get('/order/packagerdownload/{id}', 'App\\Http\\Controllers\\OrderController@packagerdownload' )->name('packagerdownload');
});

//for Telegram

Route::post('/webhook', 'App\\Http\\Controllers\\TelegramController@bot' );



require __DIR__.'/auth.php';
