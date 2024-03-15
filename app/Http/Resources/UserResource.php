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
        /* @var $user User */

        $user = $this->resource;

        $data['id']          = $user->id;
        $data['name']        = $user->first_name . ' '. $user->last_name;
        $data['email']       = $user->email;
        $data['mobile']      = $user->mobile;
        $data['dob']         = $user->dob;
        $data['education']   = $user->education;
        $data['address']     = $user->address;
        $data['country']     = $user->country;
        $data['city']        = $user->city;
        $data['postal_code'] = $user->postal_code;
        $data['status']      = $user->status;
        $data['gender']      = $user->gender;

        return $data;
    }
}
