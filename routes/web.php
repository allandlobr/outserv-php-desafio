<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'index'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('home', ['user' => Auth::getUser()]);
    })->name('home');

    Route::prefix('user-management')->controller(UserController::class)->group(function () {
        Route::get('/',  'index')
            ->name('user.management.index')
            ->middleware('can:view,App\Models\User');

        Route::middleware('can:create,App\Models\User')->group(function () {
            Route::get('/create','create')
                ->name('user.management.create');

            Route::post('/store', 'store')
                ->name('user.management.store');
        });

        Route::middleware('can:update,App\Models\User')->group(function () {
            Route::get('/{userUuid}/edit', 'edit')
                ->name('user.management.edit');

            Route::put('/{userUuid}/update','update')
                ->name('user.management.update');
        });

        Route::delete('/{userUuid}/delete', [UserController::class, 'delete'])
            ->name('user.management.delete')
            ->middleware('can:delete,App\Models\User');;
    });

    Route::prefix('profile-management')->controller(ProfileController::class)->group(function () {
        Route::get('/','index')
            ->name('profile.management.index')
            ->middleware('can:view,App\Models\Profile');

        Route::middleware('can:create,App\Models\Profile')->group(function () {
            Route::get('/create','create')
                ->name('profile.management.create');

            Route::post('/store', 'store')
                ->name('profile.management.store');
        });

        Route::middleware('can:update,App\Models\Profile')->group(function () {
            Route::get('/{profileUuid}/edit', 'edit')
                ->name('profile.management.edit');

            Route::put('/{profileUuid}/update', 'update')
                ->name('profile.management.update');
        });

        Route::delete('/{profileUuid}/delete','delete')
            ->name('profile.management.delete')
            ->middleware('can:delete,App\Models\Profile');
    });

    Route::prefix('permission-management')->controller(PermissionController::class)->group(function () {
        Route::get('/','index')
            ->name('permission.management.index')
            ->middleware('can:view,App\Models\Permission');

        Route::middleware('can:create,App\Models\Permission')->group(function () {
            Route::get('/create', 'create')
                ->name('permission.management.create');

            Route::post('/store','store')
                ->name('permission.management.store');
        });

        Route::middleware('can:update,App\Models\Permission')->group(function () {
            Route::get('/{permissionUuid}/edit', 'edit')
                ->name('permission.management.edit');

            Route::put('/{permissionUuid}/update', 'update')
                ->name('permission.management.update');
        });

        Route::delete('/{permissionUuid}/delete','delete')
            ->name('permission.management.delete')
            ->middleware('can:delete,App\Models\Permission');
    });
});

