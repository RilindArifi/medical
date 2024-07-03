<?php

namespace App\Http\Resources;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /* @var $department Department */

        $department = $this->resource;

        $data['id']              = $department->id;
        $data['name']            = $department->name;
        $data['description']     = $department->description;
        $data['date']            = $department->date;
        $data['status']          = $department->status;


        return $data;
    }
}
