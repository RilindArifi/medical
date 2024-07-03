<?php

namespace App\Services;

use App\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class StaffService extends ModelService
{
    public Model|User $model;

    public array $data = [
        'first_name'    => null,
        'last_name'     => null,
        'department_id' => null,
        'email'         => null,
        'mobile'        => null,
        'dob'           => null,
        'education'     => null,
        'address'       => null,
        'country'       => null,
        'city'          => null,
        'postal_code'   => null,
        'status'        => null,
        'gender'        => null,
        'password'      => null,
        'avatar'        => null,
        'role'             => [],
        'permissions_user' => []
    ];

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function updateOrCreate(): User
    {
        $staff = $this->updateOrStore();

        if($avatar = data_get($this->data, 'avatar')) {
            $staff->clearMediaCollection('avatar');
            $staff->addMediaFromRequest($avatar)
                ->toMediaCollection('avatar');
        }

        $staff->syncRoles(data_get($this->data, 'role'));

        $this->syncPermissions();

        return $this->model;
    }

    public function syncPermissions(): void
    {
        $currentPermissions = $this->model->permissions()->pluck('name')->toArray();

        \Log::info(data_get($this->data, 'permissions_user'));

        $this->model->syncPermissions(collect(data_get($this->data, 'permissions_user')));

        $newPermissions = $this->model->permissions()->pluck('name')->toArray();

        if ($currentPermissions != $newPermissions) {
            //send Notification
        }
    }
}
