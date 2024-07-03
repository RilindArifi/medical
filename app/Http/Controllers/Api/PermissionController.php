<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $modules = ['Dashboard','Appointments','Doctors','Schedules','Patients','Staff','Roles','Permissions','Departments','Leaves','Accounts','Invoices','Payments','Expenses','Payroll','Employee_salaries','Reports','Activities','Settings'];

        $data = [];

        foreach ($modules as $filter) {
            $permissions = Permission::where('name', 'like', '%' . $filter . '%')->get();

            $data[] = [
                'title' => $filter,
                'children' => $permissions->map(function ($permission) {
                    return [
                        'title' => $permission->name,
                        'key' => $permission->name,
                    ];
                }),
            ];
        }

        return response()->json($data);
    }
}
