<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /* @var \App\Models\Appointment $appointment */

        $appointment       = $this->resource;

        $data['id']           = $appointment->id;
        $data['doctor_id']    = $appointment->doctor_id;
        $data['patient_id']   = $appointment->patient_id;
        $data['date']         = $appointment->date;
        $data['from']         = $appointment->from;
        $data['to']           = $appointment->to;
        $data['treatment']    = $appointment->treatment;
        $data['notes']        = $appointment->notes;
        $data['status']       = $appointment->status;

        $data['patient']      = UserResource::make($appointment->patient);
        $data['doctor']       = UserResource::make($appointment->doctor);

        return $data;
    }
}
