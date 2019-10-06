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
    //phpinfo();
    return view('mainPage');
});
Route::get('/manage', function(\Illuminate\Http\Request $request){
    return view('manageData');
})->name('manage')->middleware('logged');

//VIEWS
Route::get('/register', 'HomeController@register')->name('register');
Route::get('/login', 'HomeController@login')->name('login');
Route::get('/logout', 'UserController@logout')->name('logout');
Route::get('/profile', 'HomeController@index')->name('profile')->middleware('logged');
Route::post('/getUserSession', 'UserController@getUserSession')->name('getUserSession')->middleware('logged');
Route::post('/hasNoUsers', 'UserController@hasNoUsers')->name('hasNoUsers');
Route::post('/updateFacultyInfo','DataController@updateFacultyInfo')->name('updateFacultyInfo')->middleware('logged');
Route::post('/getFacultyInfo','DataController@getFacultyInfo')->name('getFacultyInfo')->middleware('logged');
Route::post('/updateTheme','UserController@updateTheme')->name('updateTheme')->middleware('logged');

Route::get('/settings', 'HomeController@settings')->name('settings')->middleware('logged');
//END_VIEWS

//DATA VIEWS

Route::get('/manageData', function(\Illuminate\Http\Request $request){
    return view('manageData');
})->name('manageData')->middleware('logged');

Route::get('/manageDepartments', function(\Illuminate\Http\Request $request){
    return view('manage.departments');
})->name('manageDepartments')->middleware('logged');

Route::get('/manageSpecialities', function(\Illuminate\Http\Request $request){
    return view('manage.specialities');
})->name('manageSpecialities')->middleware('logged');

Route::get('/manageSubjects', function(\Illuminate\Http\Request $request){
    return view('manage.subjects');
})->name('manageSubjects')->middleware('logged');

Route::get('/manageGroups', function(\Illuminate\Http\Request $request){
    return view('manage.groups');
})->name('manageGroups')->middleware('logged');

Route::get('/manageStudents', function(\Illuminate\Http\Request $request){
    return view('manage.students');
})->name('manageStudents')->middleware('logged');

//END DATA VIEWS

//API_METHODS


Route::post('/registerUser', 'UserController@createUser')->name('registerUser');

Route::post('/loginUser', 'UserController@loginUser')->name('loginUser');

Route::post('/updatePassword', 'UserController@updatePassword')->name('updatePassword')->middleware('logged');

Route::post('/removeUser', 'UserController@removeUser')->name('removeUser')->middleware('logged');



Route::get('/getDepartments', 'DataController@getDepartmentData')->name('getDepartments')->middleware('logged');
Route::post('/createDepartment', 'DataController@createDepartment')->name('createDepartment')->middleware('logged');
Route::post('/deleteDepartments', 'DataController@deleteDepartments')->name('deleteDepartments')->middleware('logged');
Route::post('/editDepartment', 'DataController@editDepartment')->name('editDepartment')->middleware('logged');

Route::get('/getSpecialities', 'DataController@getSpecialityData')->name('getSpecialities')->middleware('logged');
Route::post('/createSpeciality', 'DataController@createSpeciality')->name('createSpeciality')->middleware('logged');
Route::post('/deleteSpecialities', 'DataController@deleteSpecialities')->name('deleteSpecialities')->middleware('logged');
Route::post('/editSpeciality', 'DataController@editSpeciality')->name('editSpeciality')->middleware('logged');

Route::get('/getSubjects', 'DataController@getSubjectData')->name('getSubjects')->middleware('logged');
Route::post('/createSubject', 'DataController@createSubject')->name('createSubject')->middleware('logged');
Route::post('/deleteSubjects', 'DataController@deleteSubjects')->name('deleteSubjects')->middleware('logged');
Route::post('/editSubject', 'DataController@editSubject')->name('editSubject')->middleware('logged');

Route::get('/getGroups', 'DataController@getGroupData')->name('getGroups')->middleware('logged');
Route::post('/createGroup', 'DataController@createGroup')->name('createGroup')->middleware('logged');
Route::post('/deleteGroups', 'DataController@deleteGroups')->name('deleteGroups')->middleware('logged');
Route::post('/editGroup', 'DataController@editGroup')->name('editGroup')->middleware('logged');

Route::get('/getStudents', 'DataController@getStudentData')->name('getStudents')->middleware('logged');
Route::post('/createStudent', 'DataController@createStudent')->name('createStudent')->middleware('logged');
Route::post('/deleteStudents', 'DataController@deleteStudents')->name('deleteStudents')->middleware('logged');
Route::post('/editStudent', 'DataController@editStudent')->name('editStudent')->middleware('logged');



//END_API_METHODS
Route::get('/generate/zajavaIspit', 'GeneratorController@getZajavaIspit')->name('getZajavaIspit')->middleware('logged');
Route::get('/generate/zvedenaVidomist', 'GeneratorController@getZvedenaVidomist')->name('getZvedenaVidomist')->middleware('logged');
Route::get('/generate/vpiskaOzinok', 'GeneratorController@getVpiskaOzinok')->name('getVpiskaOzinok')->middleware('logged');
Route::get('/generate/vidomistMod1', 'GeneratorController@getVidomistMod1')->name('getVidomistMod1')->middleware('logged');
Route::get('/generate/vidomistMod2', 'GeneratorController@getVidomistMod2')->name('getVidomistMod2')->middleware('logged');
Route::get('/generate/vidomistKr', 'GeneratorController@getVidomistKr')->name('getVidomistKr')->middleware('logged');
Route::post('/generate/xlsx', 'GeneratorController@generateXLSX')->name('generateXLSX')->middleware('logged');
Route::get('/getSubjectsByGroup/{id}', 'DataController@getSubjectsByGroup')->name('getSubjectsByGroup')->middleware('logged');
Route::get('/getStudentsByGroup/{id}', 'DataController@getStudentsByGroup')->name('getStudentsByGroup')->middleware('logged');


//TEST ROUTES
//Route::get('/checkSession', function(\Illuminate\Http\Request $request){
//    dd($request->session()->all());
//});
//Route::get('/test', function(){
//    dd(Carbon::now()->format('d/m/Y H:i:s'));
//});
Route::get('/t', 'DataController@getF');
//END TEST ROUTES
