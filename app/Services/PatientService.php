<?php

namespace App\Services;

use App\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class PatientService extends ModelService
{
    public Model|User $model;

    public array $data = [
        'first_name'    => null,
        'last_name'     => null,
        'email'         => null,
        'mobile'        => null,
        'dob'           => null,
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
        $patient = $this->updateOrStore()->assignRole(RolesEnum::PATIENT->value);

        if($avatar = data_get($this->data, 'avatar')) {
            $patient->clearMediaCollection('avatar');
            $patient->addMediaFromRequest($avatar)
                ->toMediaCollection('avatar');
        }

        return $patient;
    }
}
