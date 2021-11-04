<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['prefix' => 'v1', 'namespace' => 'Api\client'], function () {

        Route::get('/fb', 'AuthController@facebookAuth');
        Route::post('register', 'AuthController@register');
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('reset-password', 'AuthController@resetPassword');
        Route::post('new-password', 'AuthController@newPassword');
        Route::post('activeAccount', 'AuthController@activeAccount');
        Route::post('checkUser', 'AuthController@checkUser');
        Route::post('checkPhone', 'AuthController@checkPhone');

        //Token
        Route::post('Register-notification-token','AuthController@RegisterNotificationToken')->middleware('auth:client');
        Route::post('Remove-notification-token','AuthController@RemoveNotificationToken')->middleware('auth:client');

        Route::group(['middleware' => 'auth:client'],function(){
            Route::post('/store', 'StoreController@store');
            Route::post('get_profile', 'AuthController@get_profile');
            Route::post('profile', 'AuthController@profile');
            Route::post('store/update/{id}', 'StoreController@update');
            Route::post('store/status', 'StoreController@updateStausStore');
            Route::delete('store/{id}', 'StoreController@destroy');
            Route::get('store/new_order', 'StoreController@newOrder');
            Route::get('store/countOrder', 'StoreController@countOrderStatus');
            Route::post('store/updateStatusOrder', 'StoreController@updateStatusOrder');
            Route::post('store/commissions','StoreController@commissions');
            Route::get('store/profileStore','StoreController@profileStore')->middleware('auth:client');

            Route::get('indexOfferDriver', 'ClientController@indexOfferDriver');
            Route::get('AllOrderClient', 'ClientController@AllOrderClient');
            Route::get('allOrderDriver', 'ClientController@AllOrderDriver');
            Route::get('AllEndedOrderDriver', 'ClientController@AllEndedOrderDriver');
            Route::get('client/commissions', 'ClientController@commissions');
            Route::get('destroyOrder', 'ClientController@destroyOrder');
            Route::get('removeAddress', 'ClientController@destroyAddress');
        });

        //-- Main Route ---
        Route::get('categories','MainController@categories');
        Route::get('child_categories','MainController@categoriesChild');
        Route::get('variates','MainController@variety');
        Route::get('city','MainController@city');
        Route::get('district','MainController@district');
        Route::get('unit','MainController@unit');
        Route::get('brand','MainController@brand');
        Route::get('about','MainController@about');
        Route::get('banner','MainController@banner');
        Route::get('/store/filter', 'StoreController@filter');
        Route::get('store', 'StoreController@index');
        Route::get('store/{id}', 'StoreController@show');
        //notifications
        Route::post('notifications','MainController@notifications')->middleware('auth:client');
        //notification
        Route::post('notification','MainController@notification')->middleware('auth:client');
        //notification  count
        Route::post('notification/count','MainController@notificationCount')->middleware('auth:client');

        //-- Address Route ---
        Route::group(['prefix' => 'spacial_category', 'middleware' => 'auth:client'], function () {
            Route::get('/', 'SpacialCategoryController@index');
            Route::post('/', 'SpacialCategoryController@store');
            Route::post('/{id}', 'SpacialCategoryController@update');
            Route::delete('/{id}', 'SpacialCategoryController@destroy');
        });

        //-- Car Route ---
        Route::group(['prefix' => 'car'], function () {
            Route::get('ChangeStatusDeliveryOrder', 'CarsController@ChangeStatusDeliveryOrder');
            Route::post('updateStausCar', 'CarsController@updateStausCar')->middleware('auth:client');
            Route::get('money-car', 'CarsController@MoneyCar');
            Route::get('/commissions','CarsController@commissions')->middleware('auth:client');
            Route::get('/', 'CarsController@index')->middleware('auth:client');
            Route::post('/', 'CarsController@store')->middleware('auth:client');
            Route::get('/{id}', 'CarsController@show');
            Route::post('/{id}', 'CarsController@update')->middleware('auth:client');
            Route::delete('/{id}', 'CarsController@destroy');
            Route::post('updateLocation/{id}', 'CarsController@updateLocation');
            Route::post('SendCodeDelivered/{id}', 'CarsController@SendCodeDelivered');
            Route::post('StatusOrderDelivery/{id}', 'CarsController@StatusOrderDelivery');
        });

        //-- Product Route ---
        Route::group(['prefix' => 'product'], function () {
            Route::get('/', 'ProductController@index')->middleware('auth:client');
            Route::post('/', 'ProductController@store')->middleware('auth:client');
            Route::get('/{id}', 'ProductController@show')->middleware('auth:client');
            Route::post('update/{id}', 'ProductController@update')->middleware('auth:client');
            Route::delete('/{id}', 'ProductController@destroy');
            Route::post('/favorites', 'ProductController@favorites')->middleware('auth:client');
            Route::post('/my-favorites', 'ProductController@myFavorites')->middleware('auth:client');
            Route::post('/reviews', 'ProductController@reviews')->middleware('auth:client');
            Route::post('/filter', 'ProductController@filter');
            Route::post('/addAttr/{id}', 'ProductController@addAttr');
            Route::post('/statusUpdate/{id}', 'ProductController@statusUpdate');
            Route::post('/statusUpdateAttr/{id}', 'ProductController@activeAttr');
        });

        //-- offer Route ---
        Route::group(['prefix' => 'offer'], function () {
            Route::get('/', 'OfferController@index');
            Route::post('/', 'OfferController@store')->middleware('auth:client');
            Route::get('/{id}', 'OfferController@show');
            Route::put('/{id}', 'OfferController@update')->middleware('auth:client');
            Route::delete('/{id}', 'OfferController@destroy');
            Route::post('/delete_end_offer', 'OfferController@deleteEndOffer');
            Route::post('/favorites', 'OfferController@favorites')->middleware('auth:client');
            Route::post('/my-favorites', 'OfferController@myFavorites')->middleware('auth:client');
        });

        //-- order Route ---
        Route::group(['prefix' => 'checkout', 'middleware' => 'auth:client'], function () {
            Route::get('/', 'CheckoutController@index');
            Route::get('/getDriverNearby', 'CheckoutController@getDriverNearby');
            Route::get('/newOrdersDriver', 'CheckoutController@NewOrdersDriver');
            Route::get('/PendingOrdersDriver', 'CheckoutController@PendingOrdersDriver');
            Route::get('/DetailsNewOrder/{id}', 'CheckoutController@DetailsNewOrder');
            Route::Post('/SendOfferDelivery/{id}', 'CheckoutController@SendOfferDelivery');
        });
            Route::get('checkout/store', 'CheckoutController@store');
            Route::get('checkStautsOrder', 'CheckoutController@checkOrder');
            Route::post('invoice/image/order/{id}', 'OrdersController@invoiceImage');


    Route::get('/BackPaymentCheckout/{client_id}', 'CheckoutController@BackPaymentCheckout');

        //cart
        Route::group(['prefix' => 'cart', 'middleware' => 'auth:client'], function () {
            Route::get('/cartCount', 'CartsController@cartCount');
            Route::get('/', 'CartsController@index');
            Route::post('/', 'CartsController@store');
            Route::get('/{id}', 'CartsController@destroy');

        });


        //ticket
        Route::group(['prefix' => 'ticket', 'middleware' => 'auth:client'], function () {
            Route::get('/', 'TicketsController@index');
            Route::post('/', 'TicketsController@store');
        });

       //-- Address Route ---
        Route::group(['prefix' => 'address', 'middleware' => 'auth:client'], function () {
            Route::get('/', 'AddressController@index');
            Route::post('/', 'AddressController@store');
            Route::get('/{id}', 'AddressController@show');
            Route::post('/{id}', 'AddressController@update');
            Route::delete('/{id}', 'AddressController@destroy');
        });

        //cart
        Route::group(['prefix' => 'bank_account', 'middleware' => 'auth:client'], function () {
            Route::get('/', 'BankAccountController@index');
            Route::post('/', 'BankAccountController@store');
            Route::get('/{id}', 'BankAccountController@show');
            Route::post('/{id}', 'BankAccountController@update');
            Route::delete('/{id}', 'BankAccountController@destroy');

        });


    Route::group(['prefix' => 'nationality'], function () {
        Route::get('/', 'NationalityController@index');
    });
});
