<?php
use App\Http\Livewire\Search;


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

/* 一番最初に表示されるページへ */
Route::get('/', 'WebController@index');

Route::get('users/mypage', 'UserController@mypage')->name('mypage');
Route::get('users/mypage/form', 'UserController@form')->name('mypage.form');
Route::get('users/mypage/edit', 'UserController@edit')->name('mypage.edit');
Route::get('users/mypage/history', 'UserController@history')->name('mypage.history');
Route::get('users/mypage/address/edit', 'UserController@edit_address')->name('mypage.edit_address');
Route::put('users/mypage', 'UserController@update')->name('mypage.update');
Route::delete('users/mypage/delete', 'UserController@destroy')->name('mypage.destroy');/* 退会機能 */

// 投稿ページを表示
Route::get('/create', 'FormController@postpage');
// 投稿をコントローラーに送信
Route::post('/newpostsend', 'FormController@savenew'); 
// 投稿一覧を表示する
Route::get('/', 'FormController@index');
// 投稿を個別に表示する。{id}はデータベースに保存されている投稿のIDの事*/
Route::get('/show/{id}', 'FormController@show')->name('form.show');
// 投稿を削除する
Route::delete('destroy/{id}', 'FormController@destroy')->name('form.destroy');

// 投稿へのコメントをコントローラーに送信
Route::post('/comentform', 'ComentController@comentform'); 
// コメントを編集する
Route::get('/coments/{id}/edit', 'ComentController@edit')->name('coment.edit');
// コメントを更新
Route::patch('/coments/', 'ComentController@update')->name('coment.update');
// コメントを削除する
Route::delete('destroy/{id}/coment', 'ComentController@destroy')->name('coment.destroy');

/* Googleへのリダイレクト処理 */
Route::prefix('login')->name('login.')->group(function () {
    Route::get('/{provider}', 'Auth\LoginController@redirectToProvider')->name('{provider}');
    Route::get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('{provider}.callback');
});
Route::prefix('register')->name('register.')->group(function () {
    Route::get('/{provider}', 'Auth\RegisterController@showProviderUserRegistrationForm')->name('{provider}');
    Route::post('/{provider}', 'Auth\RegisterController@registerProviderUser')->name('{provider}');
});

/* メールでの認証が済んでいない場合はメール送信画面へと遷移 */
Auth::routes(['verify' => true]);

/*
Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function() {
    Route::resource('users', 'Dashboard\UserController')->middleware('auth:admins');
});
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');