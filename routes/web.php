<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\MailVerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/post/detail/{id}', [HomeController::class, 'show'])->name('show');

//start mail sending

Route::get('/mail/verify', function () {
    return view('auth.verify-email');
})->name('verification.notice');

// ->middleware(['auth', 'signed'])

Route::get('/email/verify/{id}/{hash}', [MailVerificationController::class, 'verify'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('success', 'Verification link sent!');
})->middleware(['throttle:6,1'])->name('verification.send');

//end mail sending

Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('showLogin');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::prefix('register')->name('register.')->group(function () {
        Route::get('info', [AuthController::class, 'showForm'])->name('info');
        Route::post('info', [AuthController::class, 'info']);

        Route::get('confirm', [AuthController::class, 'showConfirm'])->name('confirm');
        Route::post('confirm', [AuthController::class, 'confirm']);

        Route::get('complete', [AuthController::class, 'showComplete'])->name('complete');
    });

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
});

Route::middleware(['auth:web', 'role:user', 'verified'])->prefix('user')->name('user.')->group(function () {
    Route::get('/profile', [UserController::class, 'index'])->name('profile');
    Route::post('/profile', [UserController::class, 'update'])->name('update');
    Route::post('/upload/avatar', [UploadController::class, 'store'])->name('upload.avatar');

    Route::prefix('post')->name('post.')->group(function () {
        Route::get('/list', [PostController::class, 'index'])->name('index');
        Route::get('/list/{id}', [PostController::class, 'show'])->name('show');
        Route::delete('/list/{id}', [PostController::class, 'destroy'])->name('destroy');
        Route::get('/edit/{id}', [PostController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [PostController::class, 'update'])->name('update');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/create', [PostController::class, 'store'])->name('store');
    });
});

Route::middleware(['auth:web', 'role:admin', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('/upload/image', [UploadController::class, 'store'])->name('upload.image');

    Route::prefix('post')->name('post.')->group(function () {
        Route::get('/list', [AdminPostController::class, 'index'])->name('index');
        Route::get('/list/{id}', [AdminPostController::class, 'show'])->name('show');
        Route::delete('/list/{id}', [AdminPostController::class, 'destroy'])->name('destroy');
        Route::get('/edit/{id}', [AdminPostController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [AdminPostController::class, 'update'])->name('update');
    });
});


Route::get('/redis-test', function () {
    try {
        $redis = Redis::connection();
        $redis->set('test_key', 'test_value');
        $value = Redis::get('test_key');
        return 'Redis is working! Retrieved value: ' . $value;
    } catch (\Exception $e) {
        return 'Redis is not working: ' . $e->getMessage();
    }
});
