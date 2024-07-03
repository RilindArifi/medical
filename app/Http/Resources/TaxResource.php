<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaxResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /* @var $tax \App\Models\Tax */

        $tax = $this->resource;

        $data['id']        = $tax->id;
        $data['name']        = $tax->name;
        $data['percentage']  = $tax->percentage;
        $data['status']      = $tax->status;
        $data['information'] = $tax->information;

        return $data;
    }
}
