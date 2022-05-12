<?php
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\HomeController;

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


Route::get('/', function(){
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::group(['middleware'=>['auth', 'verified']], function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/profile/{id}',[ProfileController::class, 'show'])->name('profile');
    Route::post('/update-info',[ProfileController::class, 'edit'])->name('update-info');
    Route::post('/upload',[ProfileController::class, 'upload'])->name('upload');
    Route::get('/profile/{id}/saved-photos',[PictureController::class, 'getSavedPhotos'])->name('saved-photos');
    Route::get('/profile/{id}/my-photos',[PictureController::class, 'getMyPhotos'])->name('my-photos');
    Route::post('/view',[PictureController::class, 'view'])->name('view');
    Route::post('/pictures',[PictureController::class, 'getAllPicture'])->name('pictures');
    Route::post('/share',[PictureController::class, 'share'])->name('share');
    Route::post('/like',[PictureController::class, 'like'])->name('like');
    Route::post('/delete',[PictureController::class, 'delete'])->name('delete');
    Route::post('/add-comment',[PictureController::class, 'addComment'])->name('add-comment');
    Route::post('/delete-comment', [PictureController::class, 'deleteComment'])->name('delete-comment');
    Route::post('/privacy',[PictureController::class, 'privacy'])->name('privacy');
    Route::get('/notification',[PictureController::class, 'notification'])->name('notification');

});

