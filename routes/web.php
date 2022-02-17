<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ProfileSettingsController;
use App\Http\Controllers\FeaturedController;
use App\Http\Controllers\TrendingController;
use App\Http\Controllers\WritersController;

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
    return view('index');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/authicate', [AuthController::class, 'authicate'])->name(
    'authicate'
);
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/registration', [AuthController::class, 'registration'])->name(
    'registration'
);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', [HomeController::class, 'home'])->name('home');

Route::get('/profile/{username}', [UserController::class, 'index'])->name(
    'profile'
);

Route::get('/profile/edit/{username}', [
    ProfileSettingsController::class,
    'index',
])->name('profile.settings');

Route::put('/profile/update/{username}', [
    ProfileSettingsController::class,
    'saveSetting',
])->name('profile.update');

Route::post('/profile/password/{username}', [
    ProfileSettingsController::class,
    'changePassword',
])->name('profile.password.update');

Route::resource('/article', ArticleController::class);

Route::post('/upload', [ImageController::class, 'upload'])->name('uplaod');
Route::post('/comment/{id}', [CommentController::class, 'addComment'])->name(
    'comment'
);
Route::post('/like/{id}', [LikeController::class, 'like'])->name('like');
Route::post('/follow', [FollowController::class, 'followUserRequest'])->name(
    'follow'
);

Route::get('/featured', [FeaturedController::class, 'index'])->name('featured');

Route::get('/trending', [TrendingController::class, 'index'])->name('trending');

// Route::get('/writers', [WritersController::class, 'index'])->name('writer');

// Route::get('/user/{id}', [UserController::class, 'show']);
