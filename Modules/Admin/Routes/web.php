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

Route::prefix('admin')->group(function() {
    Route::middleware(['admin_not_logged_in'])->group(function () {
        Route::get('/', 'AuthController@get_login');
        Route::get('admin-login', ['uses' => 'AuthController@get_login', 'as' => 'admin-login']);
        Route::post('admin-login', ['uses' => 'AuthController@post_login', 'as' => 'admin-login']);
        Route::post('admin-forgotpassword', ['uses' => 'AuthController@post_forgot_password', 'as' => 'admin-forgotpassword']);
        Route::get('admin-lockscreen', ['uses' => 'AuthController@get_lockscreen', 'as' => 'admin-lockscreen']);
        Route::post('admin-lockscreen', ['uses' => 'AuthController@post_lockscreen', 'as' => 'admin-lockscreen']);
    });
    Route::middleware(['admin_logged_in'])->group(function () {
        Route::get('admin-logout', ['uses' => 'AuthController@logout', 'as' => 'admin-logout']);

        Route::get('admin-dashboard', ['uses' => 'DashboardController@index', 'as' => 'admin-dashboard']);
        
        Route::get('create_user',['uses' =>'UserController@create_user', 'as'=> 'create_user']);
        Route::post('create_user_post',['uses' =>'UserController@create_user_post', 'as'=> 'create_user_post']);
        Route::get('update-user/{id}',['uses' =>'UserController@update_user', 'as'=> 'update-user']);
        Route::post('update-user/{id}',['uses' =>'UserController@post_update_users', 'as'=> 'update-user']);
        Route::get('admin-manage-users',['uses'=>'UserController@manage_user', 'as'=>'admin-manage-users']);
        Route::get('view-user/{id}',['uses' =>'UserController@view_user', 'as'=> 'view-user']);
        
        // project Controller
        Route::get('admin-project', ['uses' => 'ProjectController@index', 'as' => 'admin-project']);
        Route::get('admin-project-list-datatable',['uses'=>'ProjectController@project_list','as'=>"admin-project-list-datatable"]);
        Route::get('admin-addproject', ['uses' => 'ProjectController@add', 'as' => 'admin-addproject']);
        Route::post('admin-projectpost', ['uses' => 'ProjectController@post_add', 'as' => 'admin-projectpost']);
        Route::get('admin-editproject/{id}', ['uses' => 'ProjectController@edit', 'as' => 'admin-editproject']);
        Route::post('admin-updateproject/{id}', ['uses' => 'ProjectController@update', 'as' => 'admin-updateproject']);
        // Route::post('admin-updateclass/{id}', ['uses' => 'ClassController@class_update', 'as' => 'admin-updateclass']);
        Route::get('admin-deleteproject', ['uses' => 'ProjectController@delete_project', 'as' => 'admin-deleteproject']);
  
        Route::get('admin-event',['uses'=>'EventController@index','as'=>'admin-event']);
        Route::get('admin-event-list-datatable',['uses'=>'EventController@event_list','as'=>"admin-event-list-datatable"]);
        Route::get('admin-addevent',['uses'=>'EventController@add','as'=>'admin-addevent']);
        Route::post('admin-eventpost',['uses'=>'EventController@post_add','as'=>'admin-eventpost']);
        Route::get('admin-deleteevent',['uses'=>'EventController@delete_event','as'=>'admin-deleteevent']);
        Route::get('admin-editevent/{id}',['uses'=>'EventController@edit','as'=>'admin-editevent']);
        Route::post('admin-updateevent/{id}',['uses'=>'EventController@update','as'=>'admin-updateevent']);
        Route::get('admin-viewevent/{id}',['uses'=>'EventController@view','as'=>'admin-viewevent']);

        Route::get('admin-inquiry',['uses' =>'InquiryController@index', 'as'=> 'admin-inquiry']);
        Route::get('admin-inquiry-list-datatable',['uses'=>'InquiryController@inquiry_list','as'=>"admin-inquiry-list-datatable"]);
        Route::get('admin-editinquiry/{id}',['uses' =>'InquiryController@edit', 'as'=> 'admin-editinquiry']);
        Route::get('admin-deleteinquiry',['uses' =>'InquiryController@delete', 'as'=> 'admin-deleteinquiry']);
        Route::post('admin-updateinquiry/{id}', ['uses' => 'InquiryController@update', 'as' => 'admin-updateinquiry']);
      
        Route::get('admin-slide',['uses' =>'SlideController@index', 'as'=> 'admin-slide']);
        Route::get('admin-slide-list-datatable',['uses'=>'SlideController@slide_list','as'=>"admin-slide-list-datatable"]);
        Route::get('admin-addslide',['uses'=>'SlideController@add','as'=>'admin-addslide']);
        Route::post('admin-addslide',['uses'=>'SlideController@post_add','as'=>'admin-addslide']);
        Route::get('admin-editslide/{id}',['uses' =>'SlideController@edit', 'as'=> 'admin-editslide']);
        Route::get('admin-deleteslide',['uses' =>'SlideController@delete', 'as'=> 'admin-deleteslide']);
        Route::post('admin-updateslide/{id}', ['uses' => 'SlideController@update', 'as' => 'admin-updateslide']);

        Route::get('admin-subscriber',['uses'=>'SubscriberController@index','as'=>'admin-subscriber']);
        Route::get('admin-subscriber-list-datatable',['uses'=>'SubscriberController@subscriber_list','as'=>'admin-subscriber-list-datatable']);
        Route::get('admin-editsubscriber',['uses'=>'SubscriberController@index','as'=>'admin-editsubscriber']);
        Route::get('admin-deletesubscriber',['uses'=>'SubscriberController@index','as'=>'admin-deletesubscriber']);
        // Route::get('admin-subscriber',['uses'=>'SubscriberController@index','as'=>'admin-subscriber']);
        Route::get('admin-updatesubscriber/{id}',['uses' =>'SubscriberController@get_new_students', 'as'=> 'admin-updatesubscriber']);
        
        // contact us 
        Route::get('admin-contact', ['uses' => 'ContactController@index', 'as' => 'admin-contact']);
        Route::get('admin-viewcontact/{id}', ['uses' => 'ContactController@view', 'as' => 'admin-viewcontact']);
        Route::post('send-reply/{id}', ['uses' => 'ContactController@send_reply', 'as' => 'send-reply']);
    
        Route::get('admin-gallery', ['uses' => 'ContactController@gallery', 'as' => 'admin-gallery']);
        Route::post('add-gallery', ['uses' => 'ContactController@add_gallery', 'as' => 'add-gallery']);
        Route::post('admin-gallery-list', ['uses' => 'ContactController@image_list', 'as' => 'admin-gallery-list']);
        Route::get('delete-image/{id}',['uses' => 'ContactController@delete_gallery', 'as' => 'delete-image']);
        ///////////////////////////
        Route::get('new-students',['uses' =>'StudentController@index', 'as'=> 'new-students']);
        Route::get('create-student',['uses' =>'StudentController@create_student', 'as'=> 'create-student']);
        Route::post('create-student',['uses' =>'StudentController@post_new_student', 'as'=> 'create-student']);
        
        Route::get('manage-students',['uses'=>'StudentController@manage_student', 'as'=>'manage-students']);
        Route::get('update-student/{id}',['uses' =>'StudentController@update_student', 'as'=> 'update-student']);
        Route::post('update-student/{id}',['uses' =>'StudentController@post_update_student', 'as'=> 'update-student']);
        Route::get('delete-student/{id}',['uses'=>'StudentController@delete_student', 'as'=>'delete-student']);
        Route::get('view-student/{id}',['uses'=>'StudentController@view_student', 'as'=>'view-student']);
        
        Route::get('admin-users', ['uses' => 'UserController@creator_index', 'as' => 'admin-users']);
        // Route::match(['get','post','delete'],'admin-create-user',['uses'=>'UserController@create_user', 'as'=>'admin-create-user']);
        // Route::get('admin-inquiry', ['uses' => 'StudentController@get_inquiries', 'as' => 'admin-inquiry']);
        // Route::get('admin-updateinquiry/{id}', ['uses' => 'StudentController@update_inquiry', 'as' => 'admin-updateinquiry']);
        // Route::post('admin-updateinquiry/{id}', ['uses' => 'StudentController@post_inquiries', 'as' => 'admin-updateinquiry']);
        Route::view('/add','admin::school.user');
        // Super admin
      
        Route::get('add_user',['uses'=>'UserController@users', 'as'=>'add_user' ]);
        Route::post('add_user',['uses'=>'UserController@users', 'as'=>'add_user' ]);
        Route::get('admin-myprofile', ['uses' => 'MyprofileController@get_myprofile', 'as' => 'admin-myprofile']);
        Route::post('admin-myprofile', ['uses' => 'MyprofileController@post_myprofile', 'as' => 'admin-myprofile']);

        Route::get('admin-cms', ['uses' => 'CmsController@index', 'as' => 'admin-cms']);
        Route::get('admin-viewcms/{id}', ['uses' => 'CmsController@view', 'as' => 'admin-viewcms']);
        Route::get('admin-createcms', ['uses' => 'CmsController@create', 'as' => 'admin-createcms']);
        Route::post('admin-createcms', ['uses' => 'CmsController@create_post', 'as' => 'admin-createcms']);
        Route::get('admin-updatecms/{id}', ['uses' => 'CmsController@get_update', 'as' => 'admin-updatecms']);
        Route::post('admin-updatecms/{id}', ['uses' => 'CmsController@post_update', 'as' => 'admin-updatecms']);
        Route::get('admin-deletecms/{id}', ['uses' => 'CmsController@delete_cms', 'as' => 'admin-deletecms']);

        // Route::get('admin-contact', ['uses' => 'ContactController@index', 'as' => 'admin-contact']);
        // Route::get('admin-viewcontact/{id}', ['uses' => 'ContactController@view', 'as' => 'admin-viewcontact']);
        // Route::post('send-reply/{id}', ['uses' => 'ContactController@send_reply', 'as' => 'send-reply']);

        // Route::get('admin-emails', ['uses' => 'EmailController@index', 'as' => 'admin-emails']);
        // Route::get('admin-viewemail/{id}', ['uses' => 'EmailController@view', 'as' => 'admin-viewemail']);
        // Route::get('admin-updateemail/{id}', ['uses' => 'EmailController@get_update', 'as' => 'admin-updateemail']);
        // Route::post('admin-updateemail/{id}', ['uses' => 'EmailController@post_update', 'as' => 'admin-updateemail']);

        // Route::get('admin-faqs', ['uses' => 'FaqController@index', 'as' => 'admin-faqs']);
        // Route::get('admin-createfaq', ['uses' => 'FaqController@get_create', 'as' => 'admin-createfaq']);
        // Route::post('admin-createfaq', ['uses' => 'FaqController@post_create', 'as' => 'admin-createfaq']);
        // Route::get('admin-viewfaq/{id}', ['uses' => 'FaqController@view', 'as' => 'admin-viewfaq']);
        // Route::get('admin-updatefaq/{id}', ['uses' => 'FaqController@get_update', 'as' => 'admin-updatefaq']);
        // Route::post('admin-updatefaq/{id}', ['uses' => 'FaqController@post_update', 'as' => 'admin-updatefaq']);
        // Route::get('admin-deletefaq', ['uses' => 'FaqController@delete', 'as' => 'admin-deletefaq']);

        Route::get('admin-blog',['uses'=>'BlogController@index','as'=>'admin-blog']);
        Route::get('admin-blog-list-datatable',['uses'=>'BlogController@blog_list','as'=>"admin-blog-list-datatable"]);
        Route::get('admin-addblog',['uses'=>'BlogController@add','as'=>'admin-addblog']);
        Route::post('admin-blogpost',['uses'=>'BlogController@post_add','as'=>'admin-blogpost']);
        Route::get('admin-deleteblog',['uses'=>'BlogController@delete_blog','as'=>'admin-deleteblog']);
        Route::get('admin-editblog/{id}',['uses'=>'BlogController@edit','as'=>'admin-editblog']);
        Route::post('admin-updateblog/{id}',['uses'=>'BlogController@update','as'=>'admin-updateblog']);
        Route::get('admin-viewblog/{id}',['uses'=>'BlogController@view','as'=>'admin-viewblog']);

        // Route::get('admin-user',['uses'=>'UserController@index','as'=>'admin-user']);
        // Route::get('admin-adduser',['uses'=>'UserController@add','as'=>'admin-adduser']);
        // Route::post('admin-adduser',['uses'=>'UserController@post_add','as'=>'admin-adduser']);
        // Route::get('admin-subscriptionplan',['uses'=>'SubscrptionController@index','as'=>'admin-subscriptionplan']);
        // Route::get('admin-plan-list-datatable',['uses'=>'SubscrptionController@plan_list','as'=>"admin-plan-list-datatable"]);
        // Route::get('admin-addsunscriptionplan',['uses'=>'SubscrptionController@add','as'=>'admin-addsunscriptionplan']);
        // Route::get('admin-editsunscriptionplan/{id}',['uses'=>'SubscrptionController@edit','as'=>'admin-editsunscriptionplan']);
        // Route::post('admin-editsunscriptionplan/{id}',['uses'=>'SubscrptionController@update','as'=>'admin-editsunscriptionplan']);
       
        
    });
 
});
