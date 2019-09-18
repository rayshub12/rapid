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
Route::get('/', 'HomeController@index');

// Admin Login Route
Route::match(['get', 'post'], '/admin', 'AdminController@adminLogin')->name('login');
Route::get('/admin/dashboard', 'AdminController@dashboard');

Auth::routes();
Route::group(['middleware' => 'auth'], function (){
    
    // Dashboard  Routes
    Route::get('/admin/dashboard', 'AdminController@dashboard');
    
    // Homepage Banner Routes
    Route::get('/admin/banner', 'BannerController@banners');
    Route::match(['get','post'], '/admin/banner/add', 'BannerController@addBanner');
    Route::match(['get','post'], '/admin/banner/{id}/edit', 'BannerController@editBanner');
    Route::match(['get','post'], '/admin/banner/{id}/delete', 'BannerController@deleteBanner');
    Route::match(['get','post'], '/admin/banner/{id}/enable', 'BannerController@enableBanner');
    Route::match(['get','post'], '/admin/banner/{id}/disable', 'BannerController@disableBanner');
    
    // Page Module Routes
    Route::get('/admin/pages', 'PageController@pagesAll');
    Route::match(['get', 'post'], '/admin/pages/add', 'PageController@newPage');
    Route::match(['get', 'post'], '/admin/page/publish/{id}', 'PageController@publishPage');
    Route::match(['get', 'post'], '/admin/page/draft/{id}', 'PageController@draftPage');
    Route::match(['get', 'post'], '/admin/page/{id}/edit', 'PageController@editPage');
    Route::match(['get', 'post'], '/admin/page/{id}/update', 'PageController@updatePage');
    Route::match(['get', 'post'], '/admin/page/{id}/delete', 'PageController@deletePage');

    // Page Category Module Routes
    Route::get('/admin/page_categories', 'PageCategoryController@categoryAll');
    Route::match(['get', 'post'], '/admin/new-page_category', 'PageCategoryController@newCategory');
    Route::match(['get', 'post'], '/admin/page_category/{id}/enable', 'PageCategoryController@enableCategory');
    Route::match(['get', 'post'], '/admin/page_category/{id}/disable', 'PageCategoryController@disableCategory');
    Route::match(['get', 'post'], '/admin/page_category/{id}/edit', 'PageCategoryController@editCategory');
    Route::match(['get', 'post'], '/admin/page_category/{id}/delete', 'PageCategoryController@deleteCategory');
    
    // Posts Module Routes
    Route::get('/admin/post', 'PostController@postsAll');
    Route::match(['get', 'post'], '/admin/post/add', 'PostController@newPost');
    Route::match(['get', 'post'], '/admin/post/publish/{id}', 'PostController@publishPost');
    Route::match(['get', 'post'], '/admin/post/draft/{id}', 'PostController@draftPost');
    Route::match(['get', 'post'], '/admin/post/{id}/edit', 'PostController@editPost');
    Route::match(['get', 'post'], '/admin/post/{id}/delete', 'PostController@deletePost');

    // Posts Category Module Routes
    Route::get('/admin/post_category', 'PostCategoryController@categoryAll');
    Route::match(['get', 'post'], '/admin/post_category/add', 'PostCategoryController@newCategory');
    Route::match(['get', 'post'], '/admin/post_category/{id}/enable', 'PostCategoryController@enableCategory');
    Route::match(['get', 'post'], '/admin/post_category/{id}/disable', 'PostCategoryController@disableCategory');
    Route::match(['get', 'post'], '/admin/post_category/{id}/edit', 'PostCategoryController@editCategory');
    Route::match(['get', 'post'], '/admin/post_category/{id}/delete', 'PostCategoryController@deleteCategory');

    // Property Type Routes
    Route::get('/admin/prop_type', 'PropertyController@propertyTypes');
    Route::match(['get', 'post'], '/admin/prop_type/add', 'PropertyController@addPropertyType');
    Route::match(['get','post'], '/admin/ptenable/{id}', 'PropertyController@enablePropertyType');
    Route::match(['get','post'], '/admin/ptdisable/{id}', 'PropertyController@disablePropertyType');

    // Property Routes [Add, View, Delete, Update]
    Route::get('/admin/property', 'PropertyController@allProperty');
    Route::match(['get', 'post'], '/admin/property/add', 'PropertyController@addProperty');
    Route::match(['get', 'post'], '/admin/property/{id}/edit', 'PropertyController@editProperty');
    Route::match(['get', 'post'], '/admin/property/{id}/delete', 'PropertyController@deleteProperty');
    Route::match(['get', 'post'], '/admin/property/add/check_slug', 'PropertyController@checkSlug');

    // Delete Property Image
    Route::match(['get', 'post'], '/admin/property-image/{id}/delete', 'PropertyController@deletePropertyImage');
    Route::match(['get', 'post'], '/admin/floor-plan-image/{id}/delete', 'PropertyController@deleteFloorPlanImage');

    // Amenities (Add, Edit, Delete, View)
    Route::get('/admin/amenities', 'PropertyController@allAmenity');
    Route::match(['get', 'post'], '/admin/amenities/add', 'PropertyController@addAmenity');
    Route::match(['get','post'], '/admin/amenable/{id}', 'PropertyController@enableAmenity');
    Route::match(['get','post'], '/admin/amdisable/{id}', 'PropertyController@disableAmenity');
    Route::match(['get','post'], '/admin/amenity/{id}/edit', 'PropertyController@editAmenity');
    Route::match(['get','post'], '/admin/amenity/{id}/delete', 'PropertyController@deleteAmenity');

    // Get City List
    Route::get('/admin/get-city-list', 'PropertyController@getCityList');
    Route::get('/admin/property/21/edit/get-city-list', 'PropertyController@getCityList');
    
    // Testimonial Routes
    Route::get('/admin/testimonials', 'TestimonialController@testimonialAll');
    Route::match(['get', 'post'], '/admin/new-testimonial', 'TestimonialController@addTestimonial');
    Route::match(['get', 'post'], '/admin/testimonial/{id}/edit', 'TestimonialController@editTestimonials');
    Route::match(['get', 'post'], '/admin/testimonial/{id}/delete', 'TestimonialController@deleteTestimonials');
    Route::match(['get', 'post'], '/admin/testimonial/{id}/enable', 'TestimonialController@enableTestimonials');
    Route::match(['get', 'post'], '/admin/testimonial/{id}/disable', 'TestimonialController@disableTestimonials');

    // Subscribers Route
    Route::get('/admin/subscribers', 'HomeController@subscriberList');

    // Manage Team Members
    Route::match(['get', 'post'], '/admin/team_member', 'TeamController@allTeamMember');
    Route::match(['get', 'post'], '/admin/team_member/add', 'TeamController@addTeamMember');

});

    // View Single Property
    // Route::match(['get', 'post'], '/properties/{url}', 'HomeController@singleProperty');
        
    // contact Page
    Route::get('/contact-us', function(){
        return view('contact-us');
    });
    Route::post('/contact-form', 'HomeController@contactQuery');
    
     // career Page
    Route::post('/career-form', 'HomeController@careerQuery');

    // Property Category Page
    // Route::match(['get','post'],'/property/off-plan', 'HomeController@propertyOffPlan');
    Route::match(['get','post'],'/properties/for/{url}/{type}', 'HomeController@propertyCategory');
    Route::match(['get','post'],'/property/for/category/{type}', 'HomeController@propertyInCategory');

    // Property for Route (Buy/Rent/OFF Plan)
    // Route::get('/property-for/{url}/{id}', 'HomeController@offPlan');
    Route::match(['get','post'],'/properties/for/{url}', 'HomeController@propertyFor');

    // Property Based on City
    Route::get('/property/in/{community}', 'HomeController@cityProperty');

    // Blog Page
    Route::get('/blog', 'PostController@blogPage');

    // Single Post Details Page Route
    Route::get('/blog/{url}', 'PostController@singlePost');

    // CMS Page Page Route
    Route::get('page/{url}', 'PageController@singlePage');

    // List Your Property Route
    Route::match(['get','post'], '/list-your-property', 'PropertyController@listYourProperty');
    Route::match(['get','post'], '/list-your-property-2', 'PropertyController@listYourProperty2');

    // City List according State on List Your Property Page
    Route::get('/list-your-property/get-city-list', 'PropertyController@getCityList');

    // Subscribers Route
    Route::match(['get', 'post'], '/subscribe-now', 'HomeController@subscribe');

    // Homepage search
    Route::get('/search', 'HomeController@search')->name('autocomplete.search');
    Route::match(['get','post'],'/search-result', 'HomeController@searchresult');

    // Consume API Data
    Route::match(['get','post'], '/api-data', 'PropertyController@apiData');
    Route::match(['get', 'post'], '/properties/{rfid}', 'HomeController@singleProperty');
    Route::match(['get', 'post'], '/properties/off-plan/{id}', 'HomeController@singleOffPlan');
    
    //api to local
    Route::match(['get', 'post'], '/request_api', 'HomeController@req_api');

    // Get Location
    Route::match(['get','post'], '/admin/add-property/get-location', 'PropertyController@getLocation');

    Route::get('/logout', 'AdminController@logout');