<?php

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

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(
    function () {
        Route::post('logout', [AuthController::class, 'logout']);

        Route::apiResource('mst_vendor', VendorController::class);
        Route::apiResource('test-api', TestApiController::class);
        Route::apiResource('adm_users', UserController::class);
        Route::apiResource('adm_roles', RolesController::class);
        Route::apiResource('adm_permissions', PermissionController::class);
        Route::apiResource('sys_logs', SystemLogController::class);
        Route::put('adm_profile/update', [ProfileController::class, 'update']);
    }
);
