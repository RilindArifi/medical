<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /* @var \App\Models\Schedule $schedule */

        $schedule = $this->resource;

        $data['id']            = $schedule->id;
        $data['doctor_id']     = $schedule->doctor_id;
        $data['available_days']   = json_decode($schedule->available_days);
        $data['available_time']   = $schedule->from . ' - ' . $schedule->to;
        $data['from']             = $schedule->from;
        $data['to']               = $schedule->to;
        $data['notes']         = $schedule->notes;
        $data['status']        = $schedule->status;

        if($schedule->relationLoaded('doctor')) {
            $data['doctor'] = UserResource::make($schedule->doctor);
        }

        return $data;
    }
}
