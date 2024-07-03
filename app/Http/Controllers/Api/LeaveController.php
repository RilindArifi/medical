<?php

namespace App\Http\Controllers\Api;

use App\Enums\LeaveStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\LeaveRequest;
use App\Http\Resources\LeaveResource;
use App\Models\Leave;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LeaveController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        return LeaveResource::collection(
            Leave::query()
                ->with('user','leave_type')
                ->onlyTrashedOrNot($request->input('deleted'))
                ->latest()
                ->when($request->input('search'), function (Builder $query) use ($request) {
                    $query->whereHas('user', function ($query) use ($request) {
                        return $query->searchAny([ 'first_name','last_name', 'email'], $request->input('search'));
                    })->orWhereHas('leave_type', function ($query) use ($request) {
                        return $query->searchAny(['name'], $request->input('search'));
                    });
                })
                ->when($request->input('staff_id'), function (Builder $query) use ($request) {
                    $query->whereHas('user', function ($query) use ($request) {
                        return $query->whereId($request->input('staff_id'));
                    });
                })
                ->when($request->input('leave_type_id'), function (Builder $query) use ($request) {
                    $query->whereHas('leave_type', function ($query) use ($request) {
                        return $query->whereId($request->input('leave_type_id'));
                    });
                })
                ->when($request->input('status'), function ($query) use ($request) {
                    return $query->whereStatus($request->input('status'));
                })
                ->when($request->custom, function ($query) use ($request) {
                    if (count($request->custom) === 2) {
                        $startDate = $request->custom[0];
                        $endDate = $request->custom[1];

                        return $query->whereBetween('from', [$startDate, $endDate]);
                    }
                    return $query;
                })
                ->when($request->filled(['sort.prop', 'sort.order']), fn(Builder $builder) => $builder
                    ->orderBy($request->input('sort.prop'), $request->input('sort.order') == 'descend' ? 'desc' : 'asc')
                )
                ->paginate($request->integer('per_page'))
                ->withQueryString()
        );
    }


    public function store(LeaveRequest $request, Leave $leave): LeaveResource
    {
        return LeaveResource::make($leave->create($request->validated()));
    }

    public function edit(Leave $leave): LeaveResource
    {
        return LeaveResource::make($leave);
    }

    public function update(LeaveRequest $request, Leave $leave): LeaveResource
    {
        return LeaveResource::make($leave->updateOrCreate(['id' => $leave->id], $request->validated()));
    }

    public function destroy(Leave $leave): \Illuminate\Http\Response
    {
        $leave->delete();

        return response()->noContent();
    }

    public function restore(Leave $leave): \Illuminate\Http\Response
    {
        $leave->restore();

        return response()->noContent();
    }

    public function forceDestroy(Leave $leave): \Illuminate\Http\Response
    {
        $leave->forceDelete();

        return response()->noContent();
    }

    public function enabled(Leave $leave): bool
    {
        return $leave->update([
            'status' => LeaveStatus::APPROVED->value
        ]);
    }

    public function disabled(Leave $leave): bool
    {
        return $leave->update([
            'status' => LeaveStatus::REJECTED->value
        ]);
    }
}
