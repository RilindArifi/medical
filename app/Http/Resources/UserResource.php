<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /* @var $doctor User */

        $user = $this->resource;

        $data['id']            = $user->id;
        $data['department_id'] = $user->department_id;
        $data['first_name']    = $user->first_name;
        $data['last_name']     = $user->last_name;
        $data['name']          = $user->first_name . ' '. $user->last_name;
        $data['email']         = $user->email;
        $data['dob']           = $user->dob;
        $data['mobile']        = $user->mobile;
        $data['education']     = $user->education;
        $data['gender']        = $user->gender;
        $data['address']       = $user->address;
        $data['country']       = $user->country;
        $data['city']          = $user->city;
        $data['postal_code']   = $user->postal_code;
        $data['status']        = $user->status;
        $data['created_at']    = $user->created_at?->toDateString();
        $data['avatar']        = $user->getFirstMediaUrl('avatar') ?: null;


        $data['department']          = DepartmentResource::make($user->department);

        $data['role']                = $user->getRoleNames();
        $data['permissions']         = PermissionResource::collection($user->getAllPermissions());
        $data['permissions_user']    = PermissionResource::collection($user->getDirectPermissions());

        return $data;
    }
}
