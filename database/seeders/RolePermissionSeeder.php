<?php

namespace Database\Seeders;

use App\Enums\RolesEnum;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        function createRolesAndPermissions($permissionsAdmin, $permissionsDoctor, $permissionsPatient): void
        {
            foreach ($permissionsAdmin as $permission) {
                app(Permission::class)->findOrCreate($permission, 'api');
            }

            Role::create(['name' => RolesEnum::ADMIN->value,'guard_name' => 'api'])->syncPermissions($permissionsAdmin);
            Role::create(['name' => RolesEnum::DOCTOR->value,'guard_name' => 'api'])->syncPermissions($permissionsDoctor);
            Role::create(['name' => RolesEnum::PATIENT->value,'guard_name' => 'api'])->syncPermissions($permissionsPatient);


            User::create([
                'first_name' => 'Rilind',
                'last_name' => 'Arifi',
                'email' => 'rilindarifi@gmail.com',
                'password' => '12345678'
            ])->assignRole(RolesEnum::ADMIN->value);

            User::create([
                'first_name' => 'Rinor',
                'last_name' => 'Arifi',
                'email' => 'rinorarifi@gmail.com',
                'password' => '12345678'
            ])->assignRole(RolesEnum::DOCTOR->value);
        }

        $permissionsAdmin = [
            'view dashboard',

            'view appointments',
            'create appointments',
            'edit appointments',
            'delete appointments',
            'restore appointments',
            'force-delete appointments',
            'enabled appointments',
            'disabled appointments',

            'view doctors',
            'create doctors',
            'edit doctors',
            'show doctors',
            'delete doctors',
            'restore doctors',
            'force-delete doctors',
            'enabled doctors',
            'disabled doctors',

            'view patients',
            'create patients',
            'edit patients',
            'show patients',
            'delete patients',
            'restore patients',
            'force-delete patients',
            'enabled patients',
            'disabled patients',

            'view staff',
            'create staff',
            'edit staff',
            'show staff',
            'delete staff',
            'restore staff',
            'force-delete staff',
            'enabled staff',
            'disabled staff',

            'view roles',
            'create roles',
            'edit roles',
            'delete roles',
            'restore roles',
            'force-delete roles',

            'view permissions',

            'view schedules',
            'create schedules',
            'edit schedules',
            'delete schedules',
            'restore schedules',
            'force-delete schedules',
            'enabled schedules',
            'disabled schedules',

            'view departments',
            'create departments',
            'edit departments',
            'delete departments',
            'restore departments',
            'force-delete departments',
            'enabled departments',
            'disabled departments',

            'view leaves',
            'create leaves',
            'edit leaves',
            'delete leaves',
            'restore leaves',
            'force-delete leaves',
            'enabled leaves',
            'disabled leaves',

            'view accounts',

            'view invoices',
            'create invoices',
            'edit invoices',
            'delete invoices',
            'restore invoices',
            'force-delete invoices',

            'view payments',
            'create payments',
            'edit payments',
            'delete payments',
            'restore payments',
            'force-delete payments',

            'view expenses',
            'create expenses',
            'edit expenses',
            'delete expenses',
            'restore expenses',
            'force-delete expenses',

            'view taxes',
            'create taxes',
            'edit taxes',
            'delete taxes',
            'restore taxes',
            'force-delete taxes',
            'enabled taxes',
            'disabled taxes',

            'view payroll',
            'view employee_salaries',
            'create employee_salaries',
            'edit employee_salaries',
            'delete employee_salaries',
            'restore employee_salaries',
            'force-delete employee_salaries',
            'enabled employee_salaries',
            'disabled employee_salaries',


            'view reports',

            'view expense-reports',
            'create expense-reports',
            'edit expense-reports',
            'delete expense-reports',
            'restore expense-reports',
            'force-delete expense-reports',

            'view invoice-reports',
            'create invoice-reports',
            'edit invoice-reports',
            'delete invoice-reports',
            'restore invoice-reports',
            'force-delete invoice-reports',

            'view activities',

            'manage settings'
        ];

        $permissionsDoctor = [
            'view dashboard',

            'view appointments',
            'create appointments',
            'edit appointments',
            'delete appointments',
            'force-delete appointments',

            'view patients',
            'create patients',
            'edit patients',
            'delete patients',
            'force-delete patients',

            'view schedules',
            'create schedules',
            'edit schedules',
            'delete schedules',
            'restore schedules',
            'force-delete schedules',
            'enabled schedules',
            'disabled schedules',

            'view departments',
            'create departments',
            'delete departments',
            'force-delete departments',

            'view leaves',
            'create leaves',
            'edit leaves',
            'delete leaves',
            'force-delete leaves',
        ];

        $permissionsPatient = [
            'view dashboard',

            'view appointments',
            'create appointments',
            'edit appointments',
            'delete appointments',
            'force-delete appointments',
        ];

        createRolesAndPermissions($permissionsAdmin, $permissionsDoctor, $permissionsPatient);
    }
}
