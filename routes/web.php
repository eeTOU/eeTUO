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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');

///  Login Route  ///

Route::get('/register','LoginController@index');

Route::get('/login','LoginController@login');

Route::post('/create','LoginController@create');

Route::post('/checkLogin', 'LoginController@checkLogin');

Route::get('/welcome', 'LoginController@protect');

Route::get('/logout', 'LoginController@logout');



Route::get('/studentLogin','LoginController@studentLogin');

Route::get('/studentWelcome', 'LoginController@studentProtect');

Route::post('/checkStudentLogin', 'LoginController@checkStudentLogin');
//Route::get('/submitLecture/{id}', 'LoginController@submitLecture');      //x
//Route::get('/courseRegDelete/{id}', 'LoginController@destroy');

//Route::resource('studentWelcome', 'LoginController');

///  Student Route  ///

Route::resource('student', 'StudentController');

Route::get('/student_create', 'StudentController@create');

Route::get('/studentIndex', 'StudentController@index');

Route::post('/studentCreate', 'StudentController@store');

///  Faculty Member Route  ///

Route::resource('facultyMember', 'FacultyMemberController');

Route::get('/facultyMemberIndex', 'FacultyMemberController@index');

///  Lecture  Route  ///

Route::resource('lecture', 'LectureController');

Route::get('/lectureIndex', 'LectureController@index');

Route::get('/lectureIndex/action', 'LectureController@action')->name('lectureIndex.action');

///  ClassRoom  Route  ///

Route::resource('classRoom', 'ClassRoomController');

Route::get('/classRoomIndex', 'ClassRoomController@index');

Route::get('/createClass', 'ClassRoomController@createClass');


///  CourseReg   Route  ///

Route::resource('courseReg', 'CourseRegController');

Route::get('/courseRegIndex', 'CourseRegController@index');

Route::get('/submitLecture/{id}', 'CourseRegController@submitLecture');

