<?php

namespace App\Services;

use App\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class DoctorService extends ModelService
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
        'avatar'        => null
    ];

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function updateOrCreate(): User
    {
        $doctor = $this->updateOrStore()->assignRole(RolesEnum::DOCTOR->value);

        if($avatar = data_get($this->data, 'avatar')) {
            $doctor->clearMediaCollection('avatar');
            $doctor->addMediaFromRequest($avatar)
                ->toMediaCollection('avatar');
        }

        return $doctor;
    }
}
