<?php

Route::get('/', function () {
    return view('welcome');
})->name('home');

//signup n verify
Route::get('signup', 'RegisterController@signup')->name('signup');
Route::post('signup', 'RegisterController@signup_store')->name('signup.store');
Route::get('verify/{token}/{id}', 'RegisterController@verification')->name('verification');

//attempt login
Route::get('login', 'LoginController@login')->name('login');
Route::post('login', 'LoginController@login_store')->name('login.store');
Route::get('logout', 'LoginController@logout')->name('logout');

//route for user
Route::group(['middleware' => ['sentinel', 'sentinel.role']], function(){
  //status = 1, user hanya bisa melengkapi profil..
  Route::get('profile/update', 'UserController@edit_profile')->name('profile.edit');
  Route::post('profile/update', 'UserController@update')->name('profile.update');

  Route::group(['middleware' => 'checkstatus'], function(){
  //status = 2, user bisa mengupdate profil dan melamar pekerjaan..
      Route::get('profile/show', 'UserController@show_profile')->name('profile.show');
      Route::get('profile/show-notif', 'UserController@show_notification')->name('show.notif');
      Route::get('job/{slug}', 'JobController@show')->name('job.show');
      Route::post('job/{id}', 'JobController@store')->name('job.store');
  });

  Route::group(['middleware' => 'statusclear'], function(){
  //status = 3, user bisa mengupdate profil, tidak bisa melamar pekerjaan lagi, tetapi bisa reupload cv jika status job masih unread..
      Route::get('profile/show', 'UserController@show_profile')->name('profile.show');
      Route::get('profile/show-notif', 'UserController@show_notification')->name('show.notif');
      Route::put('job/reupload-cv', 'JobController@reupload')->name('job.reupload');
  });

  //route for admin
  Route::get('admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
  //manage job_request
  Route::get('admin/application-unread', 'AdminController@application_unread')->name('application.unread');
  Route::get('admin/application-accepted', 'AdminController@application_accepted')->name('application.accepted');
  Route::get('admin/application-rejected', 'AdminController@application_rejected')->name('application.rejected');
  Route::get('admin/application-rejected/{id}', 'AdminController@reject')->name('application.reject');
  Route::delete('admin/application-rejected/{id}', 'AdminController@destroy')->name('application.delete');
  Route::get('admin/application-accepted/{id}', 'AdminController@application_show')->name('application.show');
  //manage user
  Route::get('admin/user-list', 'AdminController@show_user')->name('show.user');
  Route::get('admin/block/{id}', 'AdminController@block')->name('block.user');
  Route::get('admin/unblock/{id}', 'AdminController@unblock')->name('unblock.user');
  Route::get('admin/blocked-user', 'AdminController@show_blocked')->name('show.blocked');
  Route::delete('admin/delete/user/{id}', 'AdminController@destroy_user')->name('delete.user');
  //manage job
  Route::get('admin/new-job', 'AdminController@new_job')->name('new.job');
  Route::get('admin/job-list', 'AdminController@job_list')->name('job.list');
  Route::post('admin/new-job', 'AdminController@create_job')->name('create.job');
  Route::delete('admin/delete/job/{id}', 'AdminController@destroy_job')->name('delete.job');
});
