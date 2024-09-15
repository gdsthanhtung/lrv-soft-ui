<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;

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

$prefixAdmin = Config::get('gds.route.prefix_admin', 'admin');

// Route::get('/', function () {
//     return view('welcome',['pathViewTemplate' => "admin.templates."]);
// })->name('/');

Route::prefix($prefixAdmin)->middleware('auth')->group(function () {

    Route::get('/', [HomeController::class, 'home']);

	Route::get('dashboard', function () {
		return view('modules.dashboard.index');
	})->name('dashboard');

    $prefix = Config::get('gds.route.user.prefix', 'user');
    $ctrl   = Config::get('gds.route.user.ctrl', 'user');
    Route::prefix($prefix)->group(function () use ($ctrl) {
        Route::controller(UserController::class)->group(function () use ($ctrl) {
            Route::get('/', 'show')->name($ctrl);
            Route::get('/form/{id?}', 'form')->where(['id' => '[0-9]+'])->name($ctrl.'/form');
            Route::get('/delete/{id}', 'delete')->where(['id' => '[0-9]+'])->name($ctrl.'/delete');
            Route::get('/change-status/{id}/{status}', 'change_status')->where(['id' => '[0-9]+', 'status' => '[a-z]+'])->name($ctrl.'/change-status');
            Route::get('/change-level/{id}/{level}', 'change_level')->where(['id' => '[0-9]+', 'level' => '[a-z]+'])->name($ctrl.'/change-level');
            Route::post('/save', 'save')->name($ctrl.'/save');
        });
    });

	Route::get('user-management', function () {
		return view('laravel-examples/user-management');
	})->name('user-management');

	Route::get('tables', function () {
		return view('tables');
	})->name('tables');

    Route::get('/logout', [SessionsController::class, 'destroy']);
    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');
