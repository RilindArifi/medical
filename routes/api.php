<?php


use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\StaffController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\LeaveController;
use App\Http\Controllers\Api\LeaveTypeController;
use App\Http\Controllers\Api\TaxController;
use App\Http\Controllers\Api\EmployeeSalaryController;


Route::middleware(['auth:api'])->group(function () {
    Route::controller(AuthController::class)
        ->group(function () {
            Route::post('logout', 'logout');
            Route::post('refresh', 'refresh');
        });
    Route::controller(LeaveTypeController::class)
        ->prefix('leave_types')
        ->group(function () {
            Route::get('dropdown', 'dropdown');
        });

    Route::controller(SettingController::class)
        ->prefix('settings')
        ->group(function () {
            Route::get('/', 'index');
            Route::post('update', 'update')->middleware('can:manage settings');
            Route::post('update-single', 'updateSingle')->middleware('can:manage settings');
        });

    Route::get('user', function (Request $request) {
        return UserResource::make($request->user());
    });

    $controllers = [
        DepartmentController::class  => 'departments',
        DoctorController::class      => 'doctors',
        PatientController::class     => 'patients',
        StaffController::class       => 'staff',
        RoleController::class        => 'roles',
        PermissionController::class  => 'permissions',
        AppointmentController::class => 'appointments',
        ScheduleController::class    => 'schedules',
        LeaveController::class       => 'leaves',
        TaxController::class         => 'taxes',
        EmployeeSalaryController::class   => 'employee_salaries',
    ];

    foreach ($controllers as $controller => $prefix) {
        $trimmedPrefix = rtrim($prefix, 's');

        Route::controller($controller)
            ->prefix($prefix)
            ->group(function () use ($prefix, $trimmedPrefix) {
                Route::post('', 'index')->middleware("can:view {$prefix}");
                Route::get('dropdown', 'dropdown');
                Route::get("{{$trimmedPrefix}}/show", 'show')->middleware("can:show {$prefix}");
                Route::get("{{$trimmedPrefix}}/edit", 'edit')->middleware("can:edit {$prefix}");
                Route::post('store', 'store')->middleware("can:create {$prefix}");
                Route::put("{{$trimmedPrefix}}/update", 'update')->middleware("can:edit {$prefix}");
                Route::put("{{$trimmedPrefix}}/enabled", 'enabled')->middleware("can:enabled {$prefix}");
                Route::put("{{$trimmedPrefix}}/disabled", 'disabled')->middleware("can:disabled {$prefix}");
                Route::delete("{{$trimmedPrefix}}/delete", 'destroy')->withTrashed()->middleware("can:delete {$prefix}");
                Route::delete("{{$trimmedPrefix}}/force-delete", 'forceDestroy')->withTrashed()->middleware("can:force-delete {$prefix}");
                Route::post("{{$trimmedPrefix}}/restore", 'restore')->withTrashed()->middleware("can:restore {$prefix}");
            });
    }
});


Route::middleware(['guest'])->group(function () {
    Route::controller(AuthController::class)
        ->group(function () {
            Route::post('login', 'login');
            Route::post('register', 'register');
        });
});
