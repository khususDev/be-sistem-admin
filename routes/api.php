<?php

use App\Http\Controllers\Api\Administration\AppSettingController;
use App\Http\Controllers\Api\Administration\BackupController;
use App\Http\Controllers\Api\Master\VendorController;
use App\Http\Controllers\Api\TestApiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Administration\UserController;
use App\Http\Controllers\Api\Administration\RolesController;
use App\Http\Controllers\Api\Administration\PermissionController;
use App\Http\Controllers\Api\Administration\SystemLogController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\ProfileController;
use App\Http\Controllers\Api\Administration\MediaController;

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(
    function () {
        Route::post('logout', [AuthController::class, 'logout']);

        Route::apiResource('adm_users', UserController::class);
        Route::apiResource('adm_roles', RolesController::class);
        Route::apiResource('adm_permissions', PermissionController::class);
        Route::apiResource('sys_logs', SystemLogController::class);
        Route::put('adm_profile/update', [ProfileController::class, 'update']);

        Route::post('media/upload', [MediaController::class, 'upload']);

        Route::get('database/backups', [BackupController::class, 'index']);
        Route::post('database/backup', [BackupController::class, 'store']);
        Route::get('database/backup/download/{filename}', [BackupController::class, 'download']);
        Route::delete('database/backup/{filename}', [BackupController::class, 'destroy']);

        Route::get('app_settings', [AppSettingController::class, 'index']);
        Route::put('app_settings', [AppSettingController::class, 'update']);
    }
);
