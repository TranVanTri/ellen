<?php


Route::get('/a', function () {
    return view('test');
});


Route::group(['namespace' => 'AdminAuth'], function() {

    Route::group(['prefix' => 'authadmin','middleware'=>'adminCheckLogin'], function()
    {
        Route::get('login','AuthController@getLogin');
        Route::post('login',['as'=>'loginAdmin','uses'=>'AuthController@postLogin']);
    });
    
    // Route::get('admin/register','AuthController@getRegister');
    // Route::post('admin/register','AuthController@postRegister');

    Route::get('admin/dashboard','AdminAuthController@getIndex');
    Route::get('admin/logout','AdminAuthController@getLogout');

    Route::get('admin/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('admin/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');

    Route::get('admin/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('admin/password/reset', 'ResetPasswordController@reset');
});

Route::group(['namespace' => 'AdminManager'], function() {
    Route::group(['middleware'=>'userCheckLogin'], function() {
        Route::get('login',['as'=>'loginUser','uses'=>'UserController@getDangNhap']);
        Route::post('login','UserController@postDangNhap');
    });
    

    Route::get('logout',['as'=>'getUserLogout','uses'=>'UserController@getUserLogout']);

    Route::get('register',['as'=>'userregister','uses'=>'UserController@userregister']);
    Route::post('register',['as'=>'postUserRegister','uses'=>'UserController@postUserRegister']);

});


Route::group(['namespace' => 'AdminManager'], function() {

    Route::group(['prefix' => 'admin', 'middleware'=>'adminCheckLogout'], function() {
        // Route::get('test', function() {
        //     App\Promotion::where('end_date_sale','>',date("Y-m-d H:i:s"))->update(['enable'=>0]);
        // });
        // Edit admin info
        Route::get('edit/{id}', 'AdminController@getEdit');
        Route::post('edit/{id}', 'AdminController@postEdit');

        // Route::group(['prefix' => 'ckfinder'], function() {
        //     Route::get('view', 'CkfinderController@getCkfinder');
        //     Route::any('connector', 'CkfinderController@getConnector');
        // });
        
        /* Product*/
        Route::group(['prefix' => 'product'], function() {
            Route::get('list', 'ProductController@getList');
            Route::get('add', 'ProductController@getAdd');
            Route::post('add', 'ProductController@postAdd');
            Route::get('edit/{id}', 'ProductController@getEdit');
            Route::post('edit/{id}', 'ProductController@postEdit');
            Route::get('delete/{id}', 'ProductController@getDelete');
            Route::get('view-history-pro/{id}', 'ProductController@getHistory');
           
        });

        /* Bill*/
        Route::group(['prefix' => 'bill'], function() {
            Route::get('list', 'BillController@getList');
            // Route::get('add', 'BillController@getAdd');
            // Route::post('add', 'BillController@postAdd');
            Route::get('edit/{id}', 'BillController@getEdit');
            Route::post('edit/{id}', 'BillController@postEdit');
            Route::get('delete/{id}', 'BillController@getDelete');
            Route::get('view-bill-detail/{id}', 'BillController@getBillDetail');
        });


        /*------------------------------------------------------------------*/
        /* Category Group*/
        Route::group(['prefix' => 'categorygroup'], function() {
            Route::get('list', 'CategoryGroupController@getList');
            Route::get('add', 'CategoryGroupController@getAdd');
            Route::post('add', 'CategoryGroupController@postAdd');
            Route::get('edit/{id}', 'CategoryGroupController@getEdit');
            Route::post('edit/{id}', 'CategoryGroupController@postEdit');
            Route::get('delete/{id}', 'CategoryGroupController@getDelete');
            Route::get('view-history-cate-group/{id}', 'CategoryGroupController@getHistory');
        });

        /* Category Product*/
        Route::group(['prefix' => 'categoryproduct'], function() {
            Route::get('list', 'CategoryProductController@getList');
            Route::get('add', 'CategoryProductController@getAdd');
            Route::post('add', 'CategoryProductController@postAdd');
            Route::get('edit/{id}', 'CategoryProductController@getEdit');
            Route::post('edit/{id}', 'CategoryProductController@postEdit');
            Route::get('delete/{id}', 'CategoryProductController@getDelete');
            Route::get('view-history-cate-product/{id}', 'CategoryProductController@getHistory');


        });

        /* Slide*/
        Route::group(['prefix' => 'slide'], function() {
            Route::get('list', 'SlideController@getList');
            Route::get('add', 'SlideController@getAdd');
            Route::post('add', 'SlideController@postAdd');
            Route::get('edit/{id}', 'SlideController@getEdit');
            Route::post('edit/{id}', 'SlideController@postEdit');
            Route::get('delete/{id}', 'SlideController@getDelete');
            Route::get('view-history-slide/{id}', 'SlideController@getHistory');

        });

        /* Size*/
        Route::group(['prefix' => 'size'], function() {
            Route::get('list', 'SizeController@getList');
            Route::get('add', 'SizeController@getAdd');
            Route::post('add', 'SizeController@postAdd');
            Route::get('edit/{id}', 'SizeController@getEdit');
            Route::post('edit/{id}', 'SizeController@postEdit');
            Route::get('delete/{id}', 'SizeController@getDelete');
            Route::get('view-history-size/{id}', 'SizeController@getHistory');
        });

        /* Promotion*/
        Route::group(['prefix' => 'promotion'], function() {
            Route::get('list', 'PromotionController@getList');
            Route::get('add', 'PromotionController@getAdd');
            Route::post('add', 'PromotionController@postAdd');
            Route::get('edit/{id}', 'PromotionController@getEdit');
            Route::post('edit/{id}', 'PromotionController@postEdit');
            Route::get('delete/{id}', 'PromotionController@getDelete');
            Route::get('view-history-promotion/{id}', 'PromotionController@getHistory');
        });

        /*User*/
        Route::group(['prefix' => 'user'], function() {
            Route::get('list', 'UserController@getList');
            Route::get('add', 'UserController@getAdd');
            Route::post('add', 'UserController@postAdd');
            Route::get('edit/{id}', 'UserController@getEdit');
            Route::post('edit/{id}', 'UserController@postEdit');
            Route::get('delete/{id}', 'UserController@getDelete');
        });

        /*Chatbot*/
        Route::group(['prefix' => 'chatbot'], function() {
            Route::get('view', 'ChatBotController@getView')->name('view_chatbox_admin');     
            
            Route::get('anwser/view', 'ChatBotController@getViewAnwser')->name('view_chatbox_anwser');     

            Route::post('import',["as"=>"importExcel","uses"=>'ChatBotController@import']);  

            Route::get('down-excel',["as"=>"downloadExcel","uses"=>'ChatBotController@export']);
            
            
            Route::post('import-bot-anwser',["as"=>"importExcelAnwser","uses"=>'ChatBotController@importExcelAnwser']);  

            Route::get('export-excel-anwser',["as"=>"exportExcelAnwser","uses"=>'ChatBotController@exportExcelAnwser']);
            


        });
        
    });


});

/*Giỏ hàng*/

Route::resource('/cart','CartController');


Route::group(['namespace' => 'UserController'], function() {

    Route::get('/', 'BeforeCartController@getTrangChu'); 

    // dò tất cả sản phẩm theo category_product
    Route::get('/tat-ca-san-pham/{name}/{id}','BeforeCartController@getViewProduct')->name('tatcasanpham');

    Route::get('/tat-ca-san-pham','BeforeCartController@getAllProduct')->name('allproduct');

    //Khuyen mai
    Route::get('/khuyen-mai/{name}/{id}','BeforeCartController@getViewProductPromotion')->name('khuyenmai');

    Route::get('/khuyen-mai','BeforeCartController@getAllPromotion')->name('allkhuyenmai');

    //Sap xếp theo giá 
    Route::get('/sap-xep/{name}','BeforeCartController@getPriceSort')->name('pricesort');

    
    // dò sản phẩm theo id của sản phẩm
    Route::get('/chi-tiet-san-pham/{name}/{id}','BeforeCartController@viewDetailProduct')->name('chitietsanpham');

    // hiển thị tất cả sản phẩm trong gio hàng
    Route::get('gio-hang',['as'=>'giohang','uses'=>'BeforeCartController@giohang']);

    // xóa sản phẩm trong giỏ hàng với id tương ứng
    Route::get('xoa-san-pham/{id}',['as'=>'xoasanpham','uses'=>'InCartController@xoasanpham']);

    Route::get('xem-gio-hang',['as'=>'xemgiohang','uses'=>'InCartController@xemgiohang']);

    Route::get('tim-san-pham',["as"=>"timsanpham","uses"=>'findProductController@timSanPham']);
    
    
    

});


///
// Login Google
Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 
    'Auth\LoginController@handleProviderCallback');


Route::match(['get', 'post'], '/botman', 'BotManController@handle');
Route::get('/botman/tinker', 'BotManController@tinker');
