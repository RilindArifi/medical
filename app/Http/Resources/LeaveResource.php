<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaveResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /* @var \App\Models\Leave $leave */

        $leave = $this->resource;

        $data['id'] = $leave->id;
        $data['user_id'] = $leave->user_id;
        $data['leave_type_id'] = $leave->leave_type_id;
        $data['days'] = $leave->days;
        $data['from'] = $leave->from;
        $data['to'] = $leave->to;
        $data['hours'] = $leave->hours;
        $data['duration'] = $leave->duration;
        $data['reason'] = $leave->reason;
        $data['status'] = $leave->status;

        if($leave->relationLoaded('user')) {
            $data['user'] = UserResource::make($leave->user);
        }

        if($leave->relationLoaded('leave_type')) {
            $data['leave_type'] = $leave->leave_type;
        }

        return $data;
    }
}
