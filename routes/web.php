<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('', 'HomeController@index')->name('home')->middleware(['XSS']);

Route::group(['middleware' => [
    'auth',
    'XSS',    ]
    ], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::resource('products','ProductController');
    Route::resource('permissions','PermissionController');


});
Route::get('Permission', 'PermissionController@index')->name('permission.index')->middleware(['XSS']);
Route::get('profile', 'UserController@profile')->name('profile')->middleware(['XSS']);
Route::post('edit-profile', 'UserController@editprofile')->name('update.account')->middleware(['XSS']);
Route::post('change-password', 'UserController@updatePassword')->name('update.password')->middleware(['XSS']);
Route::get('lastlogin', 'UserController@lastLogin')->name('lastlogin')->middleware(['XSS']);

Route::resource('event', 'EventController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('event/getuser', 'EventController@getuser')->name('event.getuser')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('setting', 'SettingController');
Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ], function (){

        Route::resource('setting', 'SettingController');
    Route::post('email-settings', 'SettingController@saveEmailSettings')->name('email.settings');
    Route::get('test-mail', 'SettingController@testMail')->name('test.mail');

}
);

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ], function (){
    Route::get('change-language/{lang}', 'LanguageController@changeLanquage')->name('change.language');
    Route::get('manage-language/{lang}', 'LanguageController@manageLanguage')->name('manage.language');
    Route::post('store-language-data/{lang}', 'LanguageController@storeLanguageData')->name('store.language.data');
    Route::get('create-language', 'LanguageController@createLanguage')->name('create.language');
    Route::post('store-language', 'LanguageController@storeLanguage')->name('store.language');
    Route::delete('/lang/{lang}', 'LanguageController@destroyLang')->name('lang.destroy');
}
);

Route::resource('branch', 'BranchController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('jobcategory', 'JobcategoryController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('department', 'DepartmentController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('designation', 'DesignationController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('jobstage', 'JobstageController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('jobstage/order', 'JobstageController@order')->name('job.stage.order')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('job', 'JobController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('job/requirement/{code}/{lang}', 'JobController@jobRequirement')->name('job.requirement');

Route::resource('job-application', 'JobapplicationController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('job-application/candidate', 'JobapplicationController@candidate')->name('job.application.candidate')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('job-application/order', 'JobapplicationController@order')->name('job.application.order')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('job-application/getByJob', 'JobapplicationController@getByJob')->name('get.job.application')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('job-application/{id}/rating', 'JobApplicationController@rating')->name('job.application.rating')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('job-application/stage/change', 'JobApplicationController@stageChange')->name('job.application.stage.change')->middleware(
    [
        'auth',
        'XSS',
    ]
);
