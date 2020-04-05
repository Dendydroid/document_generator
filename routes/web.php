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
})->name('manage')->middleware('logged')->middleware('notTeacher');

//VIEWS
Route::get('/register', 'HomeController@register')->name('register')->middleware('notTeacher');
Route::get('/login', 'HomeController@login')->name('login')->middleware('notTeacher');
Route::get('/logout', 'UserController@logout')->name('logout')->middleware('logged');
Route::get('/profile', 'HomeController@index')->name('profile')->middleware('logged');
Route::post('/getUserSession', 'UserController@getUserSession')->name('getUserSession')->middleware('logged');
Route::post('/hasNoUsers', 'UserController@hasNoUsers')->name('hasNoUsers');
Route::post('/updateFacultyInfo','DataController@updateFacultyInfo')->name('updateFacultyInfo')->middleware('logged')->middleware('notTeacher');
Route::post('/getFacultyInfo','DataController@getFacultyInfo')->name('getFacultyInfo')->middleware('logged');
Route::post('/updateTheme','UserController@updateTheme')->name('updateTheme')->middleware('logged');
Route::post('/uploadCsv', 'DataController@uploadCsv')->name('uploadCsv')->middleware('logged')->middleware('isAdmin');

Route::get('/settings', 'HomeController@settings')->name('settings')->middleware('logged');
Route::get('/settingsAdmin', 'HomeController@settingsAdmin')->name('settingsAdmin')->middleware('logged')->middleware('isAdmin');
Route::get('/settingsUsers', 'HomeController@settingsUsers')->name('settingsUsers')->middleware('logged')->middleware('isAdmin');
Route::get('/profile', 'HomeController@profile')->name('profile')->middleware('logged');
Route::post('/clearDB', 'DataController@clearDB')->name('clearDB')->middleware('logged')->middleware('isAdmin');
//END_VIEWS

//DATA VIEWS

Route::get('/manageData', function(\Illuminate\Http\Request $request){
    return view('manageData');
})->name('manageData')->middleware('logged')->middleware('notTeacher');

Route::get('/manageDepartments', function(\Illuminate\Http\Request $request){
    return view('manage.departments');
})->name('manageDepartments')->middleware('logged')->middleware('notTeacher');

Route::get('/manageSpecialities', function(\Illuminate\Http\Request $request){
    return view('manage.specialities');
})->name('manageSpecialities')->middleware('logged')->middleware('notTeacher');

Route::get('/manageSubjects', function(\Illuminate\Http\Request $request){
    return view('manage.subjects');
})->name('manageSubjects')->middleware('logged')->middleware('notTeacher');

Route::get('/manageGroups', function(\Illuminate\Http\Request $request){
    return view('manage.groups');
})->name('manageGroups')->middleware('logged')->middleware('notTeacher');

Route::get('/manageStudents', function(\Illuminate\Http\Request $request){
    return view('manage.students');
})->name('manageStudents')->middleware('logged')->middleware('notTeacher');

Route::post('/specialitySubjects', 'DataController@specialitySubjects')->name('specialitySubjects')->middleware('logged');

//END DATA VIEWS

//API_METHODS




Route::post('/registerUser', 'UserController@createUser')->name('registerUser');

Route::post('/loginUser', 'UserController@loginUser')->name('loginUser');

Route::post('/updatePassword', 'UserController@updatePassword')->name('updatePassword')->middleware('logged');
Route::post('/updateProfileData', 'UserController@updateProfileData')->name('updateProfileData')->middleware('logged');

Route::post('/removeUser', 'UserController@removeUser')->name('removeUser')->middleware('logged')->middleware('isAdmin');



Route::get('/getDepartments', 'DataController@getDepartmentData')->name('getDepartments')->middleware('logged');
Route::post('/createDepartment', 'DataController@createDepartment')->name('createDepartment')->middleware('logged')->middleware('notTeacher');
Route::post('/deleteDepartments', 'DataController@deleteDepartments')->name('deleteDepartments')->middleware('logged')->middleware('notTeacher');
Route::post('/editDepartment', 'DataController@editDepartment')->name('editDepartment')->middleware('logged')->middleware('notTeacher');

Route::get('/getSpecialities', 'DataController@getSpecialityData')->name('getSpecialities')->middleware('logged');
Route::post('/createSpeciality', 'DataController@createSpeciality')->name('createSpeciality')->middleware('logged')->middleware('notTeacher');
Route::post('/deleteSpecialities', 'DataController@deleteSpecialities')->name('deleteSpecialities')->middleware('logged')->middleware('notTeacher');
Route::post('/editSpeciality', 'DataController@editSpeciality')->name('editSpeciality')->middleware('logged')->middleware('notTeacher');

Route::get('/getSubjects', 'DataController@getSubjectData')->name('getSubjects')->middleware('logged');
Route::post('/createSubject', 'DataController@createSubject')->name('createSubject')->middleware('logged')->middleware('notTeacher');
Route::post('/deleteSubjects', 'DataController@deleteSubjects')->name('deleteSubjects')->middleware('logged')->middleware('notTeacher');
Route::post('/editSubject', 'DataController@editSubject')->name('editSubject')->middleware('logged')->middleware('notTeacher');

Route::get('/getGroups', 'DataController@getGroupData')->name('getGroups')->middleware('logged');
Route::post('/createGroup', 'DataController@createGroup')->name('createGroup')->middleware('logged')->middleware('notTeacher');
Route::post('/deleteGroups', 'DataController@deleteGroups')->name('deleteGroups')->middleware('logged')->middleware('notTeacher');
Route::post('/editGroup', 'DataController@editGroup')->name('editGroup')->middleware('logged')->middleware('notTeacher');

Route::get('/getStudents', 'DataController@getStudentData')->name('getStudents')->middleware('logged');
Route::post('/createStudent', 'DataController@createStudent')->name('createStudent')->middleware('logged')->middleware('notTeacher');
Route::post('/deleteStudents', 'DataController@deleteStudents')->name('deleteStudents')->middleware('logged')->middleware('notTeacher');
Route::post('/editStudent', 'DataController@editStudent')->name('editStudent')->middleware('logged')->middleware('notTeacher');

Route::get('/getOpp', 'DataController@getOpp')->name('getOpp')->middleware('logged');


//END_API_METHODS
Route::get('/generate/zajavaIspit', 'GeneratorController@getZajavaIspit')->name('getZajavaIspit')->middleware('logged')->middleware('notTeacher');
Route::get('/generate/zvedenaVidomist', 'GeneratorController@getZvedenaVidomist')->name('getZvedenaVidomist')->middleware('logged')->middleware('notTeacher');
Route::get('/generate/vpiskaOzinok', 'GeneratorController@getVpiskaOzinok')->name('getVpiskaOzinok')->middleware('logged')->middleware('notTeacher');
Route::get('/generate/vidomistMod1', 'GeneratorController@getVidomistMod1')->name('getVidomistMod1')->middleware('logged')->middleware('notTeacher');
Route::get('/generate/vidomistMod2', 'GeneratorController@getVidomistMod2')->name('getVidomistMod2')->middleware('logged')->middleware('notTeacher');
Route::get('/generate/vidomistKr', 'GeneratorController@getVidomistKr')->name('getVidomistKr')->middleware('logged')->middleware('notTeacher');
Route::post('/generate/xlsx', 'GeneratorController@generateXLSX')->name('generateXLSX')->middleware('logged')->middleware('notTeacher');
Route::get('/getSubjectsByGroup/{id}', 'DataController@getSubjectsByGroup')->name('getSubjectsByGroup')->middleware('logged')->middleware('notTeacher');
Route::get('/getStudentsByGroup/{id}', 'DataController@getStudentsByGroup')->name('getStudentsByGroup')->middleware('logged');


Route::get('/generate/teacherVidomist', 'GeneratorController@getTeacherVidomist')->name('getTeacherVidomist')->middleware('logged');

Route::post('/getTeacherSubjects', "UserController@getTeacherSubjects")->middleware('logged');
Route::post('/getTeacherSubjectsList', "UserController@getTeacherSubjectsList")->middleware('logged');
Route::post('/getAllowedSubjects', "UserController@getAllowedSubjects")->middleware('logged')->name('allowedSubjects');
Route::post('/getAllowedSubjectsAdmin', "UserController@getAllowedSubjectsAdmin")->middleware('logged')->name('allowedSubjectsAdmin')->middleware('isAdmin');

Route::get('/getUsers', 'UserController@getUsers')->name('getUsers')->middleware('logged')->middleware('isAdmin');
Route::post('/deleteUsers', 'UserController@deleteUsers')->name('deleteUsers')->middleware('logged')->middleware('isAdmin');

Route::post('/saveGroupDisciplineMarks', 'DataController@saveGroupDisciplineMarks')->middleware('logged')->middleware("isAllowed");
Route::post('/saveTeacherToken', 'DataController@createTeacherToken')->middleware('logged')->middleware('isAdmin');
Route::post('/removeAllTokens', 'DataController@removeAllTokens')->middleware('logged')->middleware('isAdmin');
Route::get('/getDisciplineMarksByGroup/{id}', 'DataController@getDisciplineMarksByGroup')->middleware('logged')->middleware('notTeacher');

//TEST ROUTES
//Route::get('/checkSession', function(\Illuminate\Http\Request $request){
//    dd($request->session()->all());
//});
//Route::get('/test', function(){
//    dd(Carbon::now()->format('d/m/Y H:i:s'));
//});
//Route::get('/t', 'UserController@getSession');
//END TEST ROUTES
