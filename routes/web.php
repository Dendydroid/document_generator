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

Route::get('/manageSpecialities', function(\Illuminate\Http\Request $request){
    return view('manage.specialities');
})->name('manageSpecialities');

Route::get('/manageSubjects', function(\Illuminate\Http\Request $request){
    return view('manage.subjects');
})->name('manageSubjects');

Route::get('/manageGroups', function(\Illuminate\Http\Request $request){
    return view('manage.groups');
})->name('manageGroups');

Route::get('/manageStudents', function(\Illuminate\Http\Request $request){
    return view('manage.students');
})->name('manageStudents');

//END DATA VIEWS

//API_METHODS


Route::post('/registerUser', 'UserController@createUser')->name('registerUser');

Route::post('/loginUser', 'UserController@loginUser')->name('loginUser');

Route::post('/updatePassword', 'UserController@updatePassword')->name('updatePassword')->middleware('logged');

Route::post('/removeUser', 'UserController@removeUser')->name('removeUser')->middleware('logged');



Route::get('/getFaculties', 'DataController@getFacultyData')->name('getFaculties');
Route::post('/createFaculty', 'DataController@createFaculty')->name('createFaculty');
Route::post('/deleteFaculties', 'DataController@deleteFaculties')->name('deleteFaculties');
Route::post('/editFaculty', 'DataController@editFaculty')->name('editFaculty');

Route::get('/getSpecialities', 'DataController@getSpecialityData')->name('getSpecialities');
Route::post('/createSpeciality', 'DataController@createSpeciality')->name('createSpeciality');
Route::post('/deleteSpecialities', 'DataController@deleteSpecialities')->name('deleteSpecialities');
Route::post('/editSpeciality', 'DataController@editSpeciality')->name('editSpeciality');

Route::get('/getSubjects', 'DataController@getSubjectData')->name('getSubjects');
Route::post('/createSubject', 'DataController@createSubject')->name('createSubject');
Route::post('/deleteSubjects', 'DataController@deleteSubjects')->name('deleteSubjects');
Route::post('/editSubject', 'DataController@editSubject')->name('editSubject');

Route::get('/getGroups', 'DataController@getGroupData')->name('getGroups');
Route::post('/createGroup', 'DataController@createGroup')->name('createGroup');
Route::post('/deleteGroups', 'DataController@deleteGroups')->name('deleteGroups');
Route::post('/editGroup', 'DataController@editGroup')->name('editGroup');

Route::get('/getStudents', 'DataController@getStudentData')->name('getStudents');
Route::post('/createStudent', 'DataController@createStudent')->name('createStudent');
Route::post('/deleteStudents', 'DataController@deleteStudents')->name('deleteStudents');
Route::post('/editStudent', 'DataController@editStudent')->name('editStudent');



//END_API_METHODS
Route::get('/generate/zajavaIspit', 'GeneratorController@getZajavaIspit')->name('getZajavaIspit');
Route::get('/generate/zvedenaVidomist', 'GeneratorController@getZvedenaVidomist')->name('getZvedenaVidomist');
Route::get('/generate/vpiskaOzinok', 'GeneratorController@getVpiskaOzinok')->name('getVpiskaOzinok');
Route::get('/generate/vidomistMod1', 'GeneratorController@getVidomistMod1')->name('getVidomistMod1');
Route::get('/generate/vidomistMod2', 'GeneratorController@getVidomistMod2')->name('getVidomistMod2');
Route::get('/generate/vidomistKr', 'GeneratorController@getVidomistKr')->name('getVidomistKr');
Route::post('/generate/xlsx', 'GeneratorController@generateXLSX')->name('generateXLSX');
Route::get('/getSubjectsByGroup/{id}', 'DataController@getSubjectsByGroup')->name('getSubjectsByGroup');



//TEST ROUTES
//Route::get('/checkSession', function(\Illuminate\Http\Request $request){
//    dd($request->session()->all());
//});
//Route::get('/test', function(){
//    dd(Carbon::now()->format('d/m/Y H:i:s'));
//});
Route::get('/t', 'DataController@getF');
//END TEST ROUTES
