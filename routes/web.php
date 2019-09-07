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

use Carbon\Carbon;


Route::get('/', function (\Illuminate\Http\Request $request){
    return view('mainPage');
});
Route::get('/manage', function(\Illuminate\Http\Request $request){
    return view('manageData');
})->name('manage');

//VIEWS
Route::get('/registration', 'HomeController@registration')->name('registration');
Route::get('/login', 'HomeController@login')->name('login');
Route::get('/logout', 'UserController@logout')->name('logout');
Route::get('/profile', 'HomeController@index')->name('profile')->middleware('logged');



//END_VIEWS

//DATA VIEWS

Route::get('/manageData', function(\Illuminate\Http\Request $request){
    return view('manageData');
})->name('manageData')->middleware('logged');

Route::get('/manageFaculties', function(\Illuminate\Http\Request $request){
    return view('manage.faculties');
})->name('manageFaculties');

Route::get('/manageInstitutes', function(\Illuminate\Http\Request $request){
    return view('data.instituteData');
})->name('manageInstitutes')->middleware('logged');

Route::get('/manageGroups', function(\Illuminate\Http\Request $request){
    return view('data.groupData');
})->name('manageGroups')->middleware('logged');

Route::get('/manageStudents', function(\Illuminate\Http\Request $request){
    return view('data.studentData');
})->name('manageStudents')->middleware('logged');

//END DATA VIEWS

//API_METHODS


Route::post('/registerUser', 'UserController@createUser')->name('registerUser');

Route::post('/loginUser', 'UserController@loginUser')->name('loginUser');

Route::post('/updatePassword', 'UserController@updatePassword')->name('updatePassword')->middleware('logged');

Route::post('/removeUser', 'UserController@removeUser')->name('removeUser')->middleware('logged');

Route::get('/getFaculties', 'DataController@getFacultyData')->name('getFaculties');
Route::post('/getInstitutes', 'DataController@getInstitutesData')->name('getInstitutes')->middleware('logged');

Route::post('/createFaculty', 'DataController@createFaculty')->name('createFaculty')->middleware('logged');
Route::post('/deleteFaculty', 'DataController@deleteFaculty')->name('deleteFaculty')->middleware('logged');
Route::post('/editFaculty', 'DataController@editFaculty')->name('editFaculty')->middleware('logged');

Route::post('/createInstitute', 'DataController@createInstitute')->name('createInstitute')->middleware('logged');
Route::post('/deleteInstitute', 'DataController@deleteInstitute')->name('deleteInstitute')->middleware('logged');

//END_API_METHODS


//TEST ROUTES
//Route::get('/checkSession', function(\Illuminate\Http\Request $request){
//    dd($request->session()->all());
//});
//Route::get('/test', function(){
//    dd(Carbon::now()->format('d/m/Y H:i:s'));
//});
Route::get('/t', function(\Illuminate\Http\Request $request){
   return view('test');
});
//END TEST ROUTES
