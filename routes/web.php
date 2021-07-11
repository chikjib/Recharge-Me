<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AirtimeController;
use App\Http\Controllers\DataShareController;
use App\Http\Controllers\CorporateDataController;
use App\Http\Controllers\DirectDataController;
use App\Http\Controllers\DstvController;
use App\Http\Controllers\GotvController;
use App\Http\Controllers\StartimesController;
use App\Http\Controllers\WaecController;
use App\Http\Controllers\NecoController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontController;

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

Route::get('/',[FrontController::class, 'index'])->name('home');
Route::get('/about-us',[FrontController::class, 'aboutUs'])->name('aboutUs');
Route::get('/post',[FrontController::class, 'blog'])->name('blog');
Route::get('/post/{slug}',[FrontController::class, 'singlePost'])->where('slug','^[A-Za-z0-9\-]+')->name('singlePost');



Route::group(['middleware' => 'auth'], function () {

    //Dashboard
    Route::get('/dashboard',[DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

    //Airtime Top Up Section
    Route::get('/dashboard/airtime',[AirtimeController::class, 'index'])->middleware(['auth'])->name('airtime');
    Route::post('/dashboard/airtime',[AirtimeController::class, 'recharge'])->middleware(['auth'])->name('re_airtime');

    //DataShare Section
    Route::get('/dashboard/datashare',[DataShareController::class, 'index'])->middleware(['auth'])->name('datashare');
    Route::post('/dashboard/datashare',[DataShareController::class, 'subme'])->middleware(['auth'])->name('sub_datashare');

    //Corporate Data Section
    Route::get('/dashboard/corporate',[CorporateDataController::class, 'index'])->middleware(['auth'])->name('corporate');
    Route::post('/dashboard/corporate',[CorporateDataController::class, 'subme'])->middleware(['auth'])->name('sub_corporate');

    //Direct Data Section
    Route::get('/dashboard/direct-data',[DirectDataController::class, 'index'])->middleware(['auth'])->name('direct_data');
    Route::get('/dashboard/get-direct-data-bundles',[DirectDataController::class, 'getdata'])->middleware(['auth'])->name('get_direct_data');
    Route::post('/dashboard/direct-data',[DirectDataController::class, 'subme'])->middleware(['auth'])->name('sub_direct_data');

    //DSTV section
    Route::get('/dashboard/dstv',[DstvController::class, 'index'])->middleware(['auth'])->name('dstv');
    Route::get('/dashboard/billcustomer_check',[DstvController::class, 'getcustomer'])->middleware(['auth'])->name('get_customer');
    Route::post('/dashboard/dstv',[DstvController::class, 'recharge'])->middleware(['auth'])->name('re_dstv');

    //GOTV section
    Route::get('/dashboard/gotv',[GotvController::class, 'index'])->middleware(['auth'])->name('gotv');
    Route::get('/dashboard/billcustomer_check',[GotvController::class, 'getcustomer'])->middleware(['auth'])->name('get_customer');
    Route::post('/dashboard/gotv',[GotvController::class, 'recharge'])->middleware(['auth'])->name('re_gotv');

    //Startimes section
    Route::get('/dashboard/startimes',[StartimesController::class, 'index'])->middleware(['auth'])->name('startimes');
    Route::get('/dashboard/customercheck',[StartimesController::class, 'getcustomer'])->middleware(['auth'])->name('get_customer');
    Route::post('/dashboard/startimes',[StartimesController::class, 'recharge'])->middleware(['auth'])->name('re_startimes');

    //Waec pin section
    Route::get('/dashboard/waec-pin',[WaecController::class, 'index'])->middleware(['auth'])->name('waec');
    Route::post('/dashboard/waec-pin',[WaecController::class, 'buy'])->middleware(['auth'])->name('buy_waec');

    //Neco pin section
    Route::get('/dashboard/neco-pin',[NecoController::class, 'index'])->middleware(['auth'])->name('neco');
    Route::post('/dashboard/neco-pin',[NecoController::class, 'buy'])->middleware(['auth'])->name('buy_neco');

    //Market Place Section
    Route::get('/dashboard/market',[MarketController::class, 'index'])->middleware(['auth'])->name('market');
    Route::post('/dashboard/market',[MarketController::class, 'buy'])->middleware(['auth'])->name('buy_market');

    //Profile Section
    Route::get('/dashboard/profile',[OverviewController::class, 'getprofile'])->middleware(['auth'])->name('profile');
    Route::post('/dashboard/profile',[OverviewController::class, 'updateprofile'])->middleware(['auth'])->name('update_profile');

    //Fund Wallet Section
    Route::get('/dashboard/fund-wallet',[OverviewController::class, 'getfundwallet'])->middleware(['auth'])->name('fundwallet');

    //Change Password Section
    //Route::get('/dashboard/change-password',[OverviewController::class, 'getchangepassword'])->middleware(['auth'])->name('changepassword');
    Route::post('/dashboard/change-password',[OverviewController::class, 'updatepassword'])->middleware(['auth'])->name('update_password');

    //Transactions Section
    Route::get('/dashboard/transactions',[OverviewController::class, 'get_transactions'])->middleware(['auth'])->name('transactions');
    
    //Vendor Payment Page
    Route::get('/pay',[PayController::class, 'index'])->middleware(['auth'])->name('pay');
    Route::post('/paid',[PayController::class, 'paid'])->middleware(['auth'])->name('paid');

});

//Admin Dashboard
Route::group(['middleware' => 'admin'], function () {
    //Admin Dashboard
    Route::get('/admin',[AdminController::class, 'index'])->middleware(['auth'])->name('admin');

    //USERS 
    Route::get('/admin/users',[AdminController::class, 'users'])->middleware(['auth'])->name('users');
    Route::get('/admin/users/update/{id}',[AdminController::class, 'updateUserShow'])->where('id','^[0-9]+')->middleware(['auth'])->name('update_users');
    Route::post('/admin/users/save',[AdminController::class, 'saveUser'])->middleware(['auth'])->name('saveUser');
    
    Route::get('/admin/users/topup/{id}',[AdminController::class, 'topupUserShow'])->where('id','^[0-9]+')->middleware(['auth'])->name('topup_user');
    Route::post('/admin/users/topup',[AdminController::class, 'topup'])->middleware(['auth'])->name('topupWallet');
    Route::post('/admin/users/delete',[AdminController::class, 'destroyUser'])->middleware(['auth'])->name('deleteUser');


    //ORDERS
    Route::get('/admin/transactions',[AdminController::class, 'getTransactions'])->middleware(['auth'])->name('orders');
    Route::post('/admin/transaction/delete',[AdminController::class, 'destroyTransaction'])->middleware(['auth'])->name('deleteOrder');

    //BLOGS
    Route::get('/admin/post',[AdminController::class, 'getPosts'])->middleware(['auth'])->name('post');
    Route::post('/admin/post',[AdminController::class, 'addPost'])->middleware(['auth'])->name('addPost');

    Route::get('/admin/posts/update/{id}',[AdminController::class, 'updatePostShow'])->where('id','^[0-9]+')->middleware(['auth'])->name('update_posts');
    Route::post('/admin/posts/save',[AdminController::class, 'savePost'])->middleware(['auth'])->name('savePost');
    Route::post('/admin/posts/delete',[AdminController::class, 'destroyPost'])->middleware(['auth'])->name('deletePost');


    //SITE SETTINGS
    Route::get('/admin/settings',[AdminController::class, 'settings'])->middleware(['auth'])->name('settings');
    Route::post('/admin/settings',[AdminController::class, 'updateSettings'])->middleware(['auth'])->name('updateSettings');






});   
require __DIR__.'/auth.php';
