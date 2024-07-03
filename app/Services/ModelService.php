<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

abstract class ModelService
{
    public array $data = [];
    public Model $model;

    public static function make(): static
    {
        return new static(...func_get_args());
    }

    abstract public function updateOrCreate(): Model;

    public function setData(array $data = []): static
    {
        $this->data = array_merge($this->data, $data);
        return $this;
    }

    public function setModel(Model $model): static
    {
        $this->model = $model;
        return $this;
    }

    public function updateOrStore()
    {
        return $this->model->updateOrCreate(['id' => $this->model->id],[
            'first_name'           => data_get($this->data, 'first_name'),
            'last_name'            => data_get($this->data, 'last_name'),
            'department_id'        => data_get($this->data, 'department_id'),
            'email'                => data_get($this->data, 'email'),
            'mobile'               => data_get($this->data, 'mobile'),
            'dob'                  => data_get($this->data, 'dob'),
            'education'            => data_get($this->data, 'education'),
            'address'              => data_get($this->data, 'address'),
            'country'              => data_get($this->data, 'country'),
            'city'                 => data_get($this->data, 'city'),
            'postal_code'          => data_get($this->data, 'postal_code'),
            'status'               => data_get($this->data, 'status'),
            'gender'               => data_get($this->data, 'gender'),
            'password'              => data_get($this->data, 'password') ?? $this->model->password,
        ]);
    }
}
