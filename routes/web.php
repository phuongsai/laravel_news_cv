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

Auth::routes();

// Socialite Login

Route::get('/redirect/{driver}', 'SocialAuthController@redirect')->name('social.redirect');
Route::get('/callback/{driver}', 'SocialAuthController@callback')->name('social.callback');

// Guest mode

Route::group(['namespace' => 'Guest'], function () {
    Route::get('/', 'HomePageController')->name('home');
    Route::get('/all-posts', 'PostController@index')->name('post.index');
    Route::get('/post/{slug}', 'PostController@details')->name('post.details');
    Route::get('/category/{slug}', 'PostController@postByCategory')->name('category.posts');
    Route::get('/tag/{slug}', 'PostController@postByTag')->name('tag.posts');
    Route::get('/profile/{username}', 'ProfileController')->name('author.profile');
    Route::post('/search', 'SearchController@search')->name('guest.search');
    Route::post('subscriber', 'SubscriberController@store')->name('subscriber.store');
});

// Auth user

Route::group(['middleware' => ['auth']], function () {
    Route::get('settings', 'SettingsController@index')->name('settings');
    Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
    Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');

    Route::resource('posts', 'PostController', ['as' => 'auth', 'prefix' => 'auth']);
    Route::post('posts/{post}/review', 'PostController@requestReview')->name('auth.posts.review');
    Route::post('/upload', 'UploadImageController')->name('upload.image');
});

// Author mode

Route::group(['as' => 'author.', 'prefix' => 'author', 'namespace' => 'Author', 'middleware' => ['auth', 'author']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
});

// Admin mode

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::resource('tag', 'TagController');
    Route::resource('category', 'CategoryController');
    Route::resource('post', 'PostController')->only(['approve', 'show', 'destroy', 'update', 'pending']);
    // Route::resource('post', 'PostController')->except(['create', 'index', 'edit']);

    Route::group(['as' => 'post.'], function () {
        Route::get('/pending/post', ['as' => 'pending', 'uses' => 'PostController@pending']);
        Route::put('/post/{id}/approve', ['as' => 'approve', 'uses' => 'PostController@approval']);
    });

    Route::get('authors', 'AuthorController@index')->name('author.index');
    Route::delete('authors/{id}', 'AuthorController@destroy')->name('author.destroy');
    Route::put('authors/{id}', 'AuthorController@restore')->name('author.restore');

    Route::get('/subscriber', 'SubscriberController@index')->name('subscriber.index');
    Route::delete('/subscriber/{subscriber}', 'SubscriberController@destroy')->name('subscriber.destroy');
    Route::put('/subscriber/{subscriber}', 'SubscriberController@restore')->name('subscriber.restore');
});

Route::view('about', 'guest.about')->name('about');

// View::composer('layouts.frontend.partial.sidebar', SideBarComposer::class);
