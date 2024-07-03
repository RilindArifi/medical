<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeSalaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /* @var $employeeSalary \App\Models\EmployeeSalary */

        $employeeSalary = $this->resource;

        $data['id']            = $employeeSalary->id;
        $data['user_id']       = $employeeSalary->user_id;
        $data['salary']        = $employeeSalary->salary;
        $data['salary_type']   = $employeeSalary->salary_type;
        $data['bonus']         = $employeeSalary->bonus;
        $data['status']        = $employeeSalary->status;
        $data['date_hired']    = $employeeSalary->date_hired;
        $data['salary_term']   = $employeeSalary->salary_term;
        $data['created_at']    = parse_date($employeeSalary->created_at);

        $data['user']          = UserResource::make($employeeSalary->user);

        return $data;
    }
}
