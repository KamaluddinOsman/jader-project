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

Route::get('/soon', function () {
    return view('site.index');
});

//Clear Cache facade value:
use Illuminate\Support\Facades\Auth;

Route::get('/1', function () {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/2', function () {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/3', function () {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/4', function () {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/5', function () {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function () {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],function () {
        Route::group(['namespace' => 'Dashboard'], function () {
            Route::group(['middleware' => ['auth', 'Auto-checked-permission']], function () {

                //mark all seen notification
                Route::get('/MarkAllSeen', 'DashboardController@MarkAllSeen');

                Route::get('/', 'DashboardController@index')->name('dashboard.index');

                Route::group(['prefix' => 'category'], function () {
                    Route::get('/', 'CategoryController@index')->name('category.index');
                    Route::post('/', 'CategoryController@store')->name('category.store');
                    Route::get('/{id}', 'CategoryController@show')->name('category.show');
                    Route::put('/{id}', 'CategoryController@update')->name('category.update');
                    Route::delete('/{id}', 'CategoryController@destroy')->name('category.destroy');
                    Route::get('/active/{id}', 'CategoryController@active')->name('category.active');
                });
            });
        });


        //All the below must be overwritten
        Route::group(['namespace' => 'Admin'], function () {
            Route::group(['middleware' => ['auth', 'Auto-checked-permission']], function () {
//                Route::group(['middleware' => ['auth']],function (){

                //mark all seen notification
                // Route::get('/MarkAllSeen', 'AdminController@MarkAllSeen');

                // Route::get('/', 'AdminController@index');

                Route::group(['prefix' => 'city'], function () {
                    Route::get('/', 'CityController@index')->name('city.index');
                    Route::post('/', 'CityController@store')->name('city.store');
                    Route::get('/{id}', 'CityController@show')->name('city.show');
                    Route::put('/{id}', 'CityController@update')->name('city.update');
                    Route::delete('/{id}', 'CityController@destroy')->name('city.destroy');
                });
                Route::resource('city.district', 'CityDistrictController');
                Route::delete('city.district/{id}', 'CityDistrictController@destroy')->name('city.district.destroy');


                Route::group(['prefix' => 'user'], function () {
                    Route::get('/change-password', 'UserController@editPassword')->name('password.change');
                    Route::post('/change-password', 'UserController@updatePassword')->name('password.update');
                    Route::get('/create', 'UserController@create')->name('user.create');
                    Route::get('/', 'UserController@index')->name('user.index');
                    Route::post('/', 'UserController@store')->name('user.store');
                    Route::get('/{id}', 'UserController@show')->name('user.show');
                    Route::get('/{id}/edit', 'UserController@edit')->name('user.edit');
                    Route::put('/{id}', 'UserController@update')->name('user.update');
                    Route::delete('/delete/{id}', 'UserController@delete')->name('user.destroy');
                });

                Route::get('edit/password', 'UserController@editPassword');
                Route::post('update/password', 'UserController@updatePassword');

                Route::group(['prefix' => 'role'], function () {
                    Route::get('/create', 'RoleController@create')->name('role.create');
                    Route::get('/', 'RoleController@index')->name('role.index');
                    Route::post('/', 'RoleController@store')->name('role.store');
                    Route::get('/{id}', 'RoleController@show')->name('role.show');
                    Route::get('/{id}/edit', 'RoleController@edit')->name('role.edit');
                    Route::put('/{id}', 'RoleController@update')->name('role.update');
                    Route::delete('/delete/{id}', 'RoleController@delete')->name('role.destroy');
                });


                Route::group(['prefix' => 'store'], function () {
                    Route::get('pending', 'StoreController@pend');
                    Route::get('rejected', 'StoreController@rejected');
                    Route::get('/', 'StoreController@index')->name('store.index');
                    Route::get('/create', 'StoreController@create')->name('store.create');
                    Route::get('/{id}/edit', 'StoreController@edit')->name('store.edit');
                    Route::post('/', 'StoreController@store')->name('store.store');
                    Route::get('/{id}', 'StoreController@show')->name('store.show');
                    Route::put('/{id}', 'StoreController@update')->name('store.update');
                    Route::delete('/{id}', 'StoreController@destroy')->name('store.destroy');
                    Route::get('/active/{id}', 'StoreController@active')->name('store.active');
                    Route::post('/cancel', 'StoreController@cancel')->name('store.cancel');
                    Route::get('/getcategory/{id}', 'StoreController@getcategory');
                });

                Route::group(['prefix' => 'delivery-cost'], function () {
                    Route::get('/', 'DeliversCostsController@index')->name('deliveryCost.index');
                    Route::get('/create', 'DeliversCostsController@create')->name('deliveryCost.create');
                    Route::get('/{id}/edit', 'DeliversCostsController@edit')->name('deliveryCost.edit');
                    Route::post('/', 'DeliversCostsController@store')->name('deliveryCost.store');
                    Route::get('/{id}', 'DeliversCostsController@show')->name('deliveryCost.show');
                    Route::put('/{id}', 'DeliversCostsController@update')->name('deliveryCost.update');
                    Route::delete('/{id}', 'DeliversCostsController@delete')->name('deliveryCost.delete');
                });

                Route::group(['prefix' => 'product'], function () {
                    Route::get('/create/{id}', 'StoreController@ProductCreate');
                    Route::get('/{id}/edit', 'StoreController@ProductEdit');
                    Route::get('ProductShow/{id}', 'StoreController@ProductShow')->name('product.show');
                    Route::put('ProductUpdate/{id}', 'StoreController@ProductUpdate')->name('product.update');
                    Route::delete('/{id}', 'StoreController@ProductDestroy')->name('product.destroy');
                    Route::post('/StoreProducts', 'StoreController@StoreProducts');
                    Route::get('/getbrand/{id}', 'StoreController@getBrand');
                    Route::get('/getcolor/{id}', 'StoreController@getColor');
                    Route::get('/getunit/{id}', 'StoreController@getSize');
                    Route::get('/getunitplus/{id}', 'StoreController@getSizePlus');
                    Route::get('/getcolorplus/{id}', 'StoreController@getColorPlus');

                    Route::get('/pending', 'ProductController@pend');
                    Route::get('/rejected', 'ProductController@rejected');
                    Route::get('/active/{id}', 'ProductController@active')->name('product.active');
                    Route::post('/cancel', 'ProductController@cancel')->name('product.cancel');
                });

                Route::group(['prefix' => 'car'], function () {
                    Route::get('pending', 'CarController@pend');
                    Route::get('rejected', 'CarController@rejected');
                    Route::get('/', 'CarController@index')->name('car.index');
                    Route::get('/create', 'CarController@create')->name('car.create');
                    Route::get('/{id}/edit', 'CarController@edit')->name('car.edit');
                    Route::post('/', 'CarController@store')->name('car.store');
                    Route::get('/{id}', 'CarController@show')->name('car.show');
                    Route::put('/{id}', 'CarController@update')->name('car.update');
                    Route::delete('/{id}', 'CarController@destroy')->name('car.destroy');
                    Route::get('/active/{id}', 'CarController@active')->name('car.active');
                    Route::post('/cancel', 'CarController@cancel')->name('car.cancel');

                });

                // Route::group(['prefix' => 'category'], function () {
                //     Route::get('/', 'CategoryController@index')->name('category.index');
                //     Route::post('/', 'CategoryController@store')->name('category.store');
                //     Route::get('/{id}', 'CategoryController@show')->name('category.show');
                //     Route::put('/{id}', 'CategoryController@update')->name('category.update');
                //     Route::delete('/{id}', 'CategoryController@destroy')->name('category.destroy');
                //     Route::get('/active/{id}', 'CategoryController@active')->name('category.active');
                // });

                // coupons
                Route::group(['prefix' => 'coupons'], function () {
                    Route::get('/', 'CouponController@coupon')->name('coupons');
                    Route::post('store/', 'CouponController@store')->name('store.coupon');
                    Route::get('delete/{id}', 'CouponController@delete')->name('delete.coupon');
                    Route::get('/{id}', 'CouponController@update')->name('coupon.update');
                    Route::get('edit/{id}', 'CouponController@edit')->name('edit.coupon');
                });


                Route::group(['prefix' => 'color'], function () {
                    Route::get('/', 'ColorController@index')->name('color.index');
                    Route::post('/', 'ColorController@store')->name('color.store');
                    Route::get('/{id}', 'ColorController@show')->name('color.show');
                    Route::put('/{id}', 'ColorController@update')->name('color.update');
                    Route::delete('/{id}', 'ColorController@destroy')->name('color.destroy');
                });

                Route::group(['prefix' => 'unit'], function () {
                    Route::get('/', 'UnitController@index')->name('unit.index');
                    Route::post('/', 'UnitController@store')->name('unit.store');
                    Route::get('/{id}', 'UnitController@show')->name('unit.show');
                    Route::put('/{id}', 'UnitController@update')->name('unit.update');
                    Route::delete('/{id}', 'UnitController@destroy')->name('unit.destroy');
                });

                Route::group(['prefix' => 'brand'], function () {
                    Route::get('/', 'BrandController@index')->name('brand.index');
                    Route::post('/', 'BrandController@store')->name('brand.store');
                    Route::get('/{id}', 'BrandController@show')->name('brand.show');
                    Route::put('/{id}', 'BrandController@update')->name('brand.update');
                    Route::delete('/{id}', 'BrandController@destroy')->name('brand.destroy');
                });

                Route::group(['prefix' => 'log'], function () {
                    Route::get('/', 'LogController@index')->name('log.index');
                    Route::delete('/{id}', 'LogController@destroy')->name('log.destroy');
                });

                Route::group(['prefix' => 'client'], function () {
                    Route::get('/', 'ClientController@index')->name('client.index');
                    Route::get('/create', 'ClientController@create')->name('client.create');
                    Route::post('/', 'ClientController@store')->name('client.store');
                    Route::get('/{id}', 'ClientController@show')->name('client.show');
                    Route::get('/{id}/edit', 'ClientController@edit')->name('client.edit');
                    Route::put('/{id}', 'ClientController@update')->name('client.update');
                    Route::delete('/{id}', 'ClientController@destroy')->name('client.destroy');
                    Route::get('/active/{id}', 'ClientController@active')->name('store.active');
                    Route::get('/showdetailsorder/{order_id}', 'ClientController@showdetailsorder');
                });

                Route::group(['prefix' => 'product'], function () {
                    Route::get('/', 'ProductController@index')->name('product.index');
                    Route::post('/', 'ProductController@store')->name('product.store');
                    Route::get('/{id}', 'ProductController@show')->name('product.show');
                    Route::put('/{id}', 'ProductController@update')->name('product.update');
                    Route::delete('/{id}', 'ProductController@destroy')->name('product.destroy');
                });

                Route::group(['prefix' => 'offer'], function () {
                    Route::get('/', 'OfferController@index')->name('offer.index');
                    Route::get('/{id}', 'OfferController@show')->name('offer.show');
                    Route::delete('/{id}', 'OfferController@destroy')->name('offer.destroy');
                    Route::get('/active/{id}', 'OfferController@active')->name('offer.active');
                });


                Route::group(['prefix' => 'banner'], function () {
                    Route::get('/', 'BannerController@index')->name('banner.index');
                    Route::post('/', 'BannerController@store')->name('banner.store');
                    Route::get('/{id}', 'BannerController@show')->name('banner.show');
                    Route::put('/{id}', 'BannerController@update')->name('banner.update');
                    Route::delete('/{id}', 'BannerController@destroy')->name('banner.destroy');
                    Route::get('/active/{id}', 'BannerController@active')->name('banner.active');
                });

                Route::group(['prefix' => 'notification'], function () {
                    Route::get('/create', 'NotificationController@create');
                    Route::post('/send', 'NotificationController@store')->name('notification.send');
                });

                Route::group(['prefix' => 'money'], function () {
                    Route::get('/transactions', 'MoneyAccountController@index');
                    Route::get('/create', 'MoneyAccountController@create');
                    Route::get('/getclient/{type}', 'MoneyAccountController@getclient');
                    Route::get('/getAccounts/{id}', 'MoneyAccountController@getAccounts');
                    Route::post('/transactions', 'MoneyAccountController@store')->name('transactions.money');
                    Route::get('/{id}', 'MoneyAccountController@show')->name('transactions.show');
                });

                Route::group(['prefix' => 'support'], function () {
                    Route::get('/user', 'TicketsController@user');
                    Route::get('/store', 'TicketsController@store');
                    Route::get('/car', 'TicketsController@car');
                    Route::get('/update/{id}', 'TicketsController@update');
                });

                Route::group(['prefix' => 'setting'], function () {
                    Route::get('/', 'SettingController@index');
                    Route::put('/{id}', 'SettingController@update')->name('setting.update');
                });
            });
        });

    });


Auth::routes();


