<?php

namespace App\Http\Controllers\Api;

use App\Enums\StatusGlobal;
use App\Http\Controllers\Controller;
use App\Http\Resources\LeaveTypeResource;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LeaveTypeController extends Controller
{
    public function dropdown(Request $request): AnonymousResourceCollection
    {
        return LeaveTypeResource::collection(
            LeaveType::query()
                ->when($request->input('search'), function ($query) use ($request) {
                    return $query->searchAny(['name'], $request->input('search'));
                })
                ->whereStatus(StatusGlobal::ACTIVE->value)
                ->get()
        );
    }

}
