<?php

namespace App\Services;

use App\Enums\RolesEnum;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class AppointmentService extends ModelService
{
    public Model|Appointment $model;

    public array $data = [
        'first_name'    => null,
        'last_name'     => null,
        'email'         => null,
        'mobile'        => null,
        'dob'           => null,
        'gender'        => null,
        'password'      => null,

        'date'          => null,
        'from'          => null,
        'to'            => null,
        'doctor_id'     => null,
        'patient_id'    => null,
        'treatment'     => null,
        'notes'         => null,
        'image'         => null,
    ];

    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function updateOrCreate(): Appointment|Model
    {
        if(!data_get($this->data,'patient_id')) {
            $patient = User::create([
                'first_name'           => data_get($this->data, 'first_name'),
                'last_name'            => data_get($this->data, 'last_name'),
                'email'                => data_get($this->data, 'email'),
                'mobile'               => data_get($this->data, 'mobile'),
                'dob'                  => data_get($this->data, 'dob'),
                'gender'               => data_get($this->data, 'gender'),
                'password'             => data_get($this->data, 'password')
            ])->assignRole(RolesEnum::PATIENT->value);
        }

        $this->model->updateOrCreate(['id' => $this->model->id],[
            'date'           =>  data_get($this->data, 'date'),
            'from'           =>  data_get($this->data, 'from'),
            'to'             =>  data_get($this->data, 'to'),
            'doctor_id'      =>  data_get($this->data, 'doctor_id'),
            'patient_id'     =>  data_get($this->data, 'patient_id') ?? $patient->id,
            'treatment'      =>  data_get($this->data, 'treatment'),
            'notes'          =>  data_get($this->data, 'notes'),
        ]);


        if($avatar = data_get($this->data, 'image')) {
            $this->model->clearMediaCollection('image');
            $this->model->addMediaFromRequest($avatar)
                ->toMediaCollection('image');
        }

        return $this->model;
    }
}
