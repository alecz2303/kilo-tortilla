<?php

use TCG\Voyager\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrController;


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

Route::get('/', function () {
    $posts = Post::all();
    return view('home', compact('posts'));
});

Route::get('post/{slug}', function($slug){
    $post = Post::where('slug', '=', $slug)->firstOrFail();
	return view('post', compact('post'));
});

Route::get('/qrcode', [App\Http\Controllers\QrController::class, 'index'])->name('home.index');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

