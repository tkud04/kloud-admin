<?php

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

#Route::get('/', function(){return "<h2 style='color: red;'>Out of service</h2>";});

/***** Admin routes *****/
Route::get('login', 'LoginController@getLogin');
Route::post('login', 'LoginController@postLogin');

Route::get('forgot-password', 'LoginController@getAdminForgotPassword');
Route::post('forgot-password', 'LoginController@postAdminForgotPassword');

Route::get('/', 'MainController@getIndex');
#Route::post('cobra', 'MainController@postIndex');

Route::get('users', 'MainController@getUsers');
Route::get('user', 'MainController@getUser');
Route::post('user', 'MainController@postUser');

Route::get('activate-user', 'MainController@getActivateUser');
Route::get('suspend-user', 'MainController@getSuspendUser');

Route::get('posts', 'MainController@getBlogPosts');
Route::get('post', 'MainController@getBlogPost');
Route::post('post', 'MainController@postBlogPost');
Route::get('add-post', 'MainController@getAddBlogPost');
Route::post('add-post', 'MainController@postAddBlogPost');

Route::get('deals', 'MainController@getDeals');
Route::get('deal', 'MainController@getDeal');
Route::post('deal', 'MainController@postDeal');

Route::get('add-deal', 'MainController@getAddDeal');
Route::post('add-deal', 'MainController@postAddDeal');

Route::get('stores', 'MainController@getStores');
Route::get('store', 'MainController@getStore');
Route::post('store', 'MainController@postStore');
Route::get('delete-store', 'MainController@getDeleteStore');

Route::get('be', 'MainController@getSiteConfig');
Route::post('be', 'MainController@postSiteConfig');

Route::get('auctions', 'MainController@getAuctions');
Route::get('auction', 'MainController@getAuction');

#Route::get('add-auction', 'MainController@getAddAuction');
#Route::post('add-auction', 'MainController@postAddAuction');
Route::get('end-auction', 'MainController@getEndAuction');
Route::get('delete-auction', 'MainController@getDeleteAuction');

Route::get('transactions', 'MainController@getTransactions');
Route::get('invoice', 'MainController@getInvoice');

Route::get('orders', 'MainController@getOrders');
Route::get('order', 'MainController@getOrder');
Route::post('order', 'MainController@postOrder');

Route::get('fund-wallet', 'MainController@getFundWallet');
Route::post('fund-wallet', 'MainController@postFundWallet');

Route::get('withdrawals', 'MainController@getWithdrawals');
Route::get('approve-withdrawal', 'MainController@getApproveWithdrawal');

Route::get('add-coupon', 'MainController@getAddCoupon');
Route::post('add-coupon', 'MainController@postAddCoupon');

Route::get('coupon', 'MainController@getCoupon');
Route::get('coupons', 'MainController@getCoupons');

Route::get('rc', 'MainController@getRC');
Route::get('rating', 'MainController@getRating');
Route::get('mr', 'MainController@getApproveRating');

Route::get('comments', 'MainController@getComments');
Route::get('comment', 'MainController@getComment');
Route::post('comment', 'MainController@postComment');

Route::get('mailer', 'MainController@getMailer');
Route::get('smtp', 'MainController@getSmtp');
Route::post('smtp', 'MainController@postSmtp');

Route::get('leads', 'MainController@getLeads');
Route::get('delete-leads', 'MainController@getDeleteLeads');
Route::post('leads', 'MainController@postLeads');

Route::post('bomb', 'MainController@postSend');

Route::get('sdd', 'MainController@getSeeder');

Route::get('logout', 'LoginController@getLogout');

Route::get('practice', 'MainController@getPractice');
Route::get('zohoverify/{url}', 'MainController@getZoho');
