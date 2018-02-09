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

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'ExamController@index')->name('index');
Route::get('/home', 'ExamController@index')->name('home.index');



// Route::get('/exam', 'ExamController@index')->name('exam.index');
// Route::get('/exam/create', 'ExamController@create')->name('exam.create');
// Route::post('/exam/store', 'ExamController@store')->name('exam.store');
// Route::get('/exam/{id}', 'ExamController@show')->name('exam.show');
// Route::get('/exam/{id}/edit', 'ExamController@edit')->name('exam.edit');
// Route::patch('/exam/{id}', 'ExamController@update')->name('exam.update');
// Route::delete('/exam/{id}', 'ExamController@destroy')->name('exam.destroy');

//Route::resource('exam' , 'ExamController');
// Route::get('/exam/create', function () {
//     return view('exam.create');
// })->name('exam.create');

//Route::get('/exam/create', 'ExamController@create')->name('exam.create');
Route::get('/exam', 'ExamController@index')->name('exam.index');
Route::get('/exam/create', 'ExamController@create')->name('exam.create');
Route::post('/exam', 'ExamController@store')->name('exam.store');
Route::get('/exam/{id}', 'ExamController@show')->name('exam.show');
//參數驗證
//Route::get('/exam/{id}', 'ExamController@show')->name('exam.show')->where('id', '[0-9]+');
//如果同一個參數要限制格式，且有好幾個 Route 要用，則可用 Route::pattern() 方式來統一宣告（記得放最上面）
//Route::pattern('id' , '[0-9]+');

// 建立題目
Route::post('/topic', 'TopicController@store')->name('topic.store');
//修改測驗
Route::get('/exam/{id}/edit', 'ExamController@edit')->name('exam.edit');
Route::patch('/exam/{id}', 'ExamController@update')->name('exam.update');

//修改題目
Route::get('/topic/{id}/edit', 'TopicController@edit')->name('topic.edit');
//更新題目
Route::patch('/topic/{id}', 'TopicController@update')->name('topic.update');
//刪除題目
Route::delete('/topic/{id}', 'TopicController@destroy')->name('topic.destroy');

//刪除測驗
Route::delete('/exam/{id}', 'ExamController@destroy')->name('exam.destroy');

//新增測驗
Route::post('/test', 'TestController@store')->name('test.store');
//顯示測驗結果
Route::get('/test/{id}', 'TestController@show')->name('test.show');






