<?php

namespace App\Http\Controllers\Api;

use App\Enums\StatusGlobal;
use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;
use App\Http\Resources\ScheduleResource;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ScheduleController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        return ScheduleResource::collection(
            Schedule::query()
                ->with('doctor')
                ->onlyTrashedOrNot($request->input('deleted'))
                ->latest()
                ->when($request->input('search'), function ($query) use ($request) {
                    return $query->searchAny([ 'name', 'description'], $request->input('search'));
                })
                ->when($request->input('status'), function ($query) use ($request) {
                    return $query->whereStatus($request->input('status'));
                })
                ->when($request->filled(['sort.prop', 'sort.order']), fn(Builder $builder) => $builder
                    ->orderBy($request->input('sort.prop'), $request->input('sort.order') == 'descend' ? 'desc' : 'asc')
                )
                ->paginate($request->integer('per_page'))
                ->withQueryString()
        );
    }

    public function dropdown(Request $request): AnonymousResourceCollection
    {
        return ScheduleResource::collection(
            Schedule::query()
                ->latest()
                ->when($request->input('search'), function ($query) use ($request) {
                    return $query->searchAny(['name', 'description'], $request->input('search'));
                })
                ->whereStatus(StatusGlobal::ACTIVE->value)
                ->get()
        );
    }

    public function saveData(ScheduleRequest $request, Schedule $schedule): ScheduleResource
    {
        $validatedData = $request->validated();

        if (isset($validatedData['available_days'])) {
            $validatedData['available_days'] = json_encode($validatedData['available_days']);
        }

        return ScheduleResource::make($schedule->updateOrCreate(['id' => $schedule->id], $validatedData));
    }

    public function store(ScheduleRequest $request, Schedule $schedule): ScheduleResource
    {
        return ScheduleResource::make(
            $this->saveData($request, $schedule)
        );
    }

    public function edit(Schedule $schedule): ScheduleResource
    {
        return ScheduleResource::make($schedule);
    }

    public function update(ScheduleRequest $request, Schedule $schedule): ScheduleResource
    {
        return ScheduleResource::make(
            $this->saveData($request, $schedule)
        );
    }

    public function destroy(Schedule $schedule): \Illuminate\Http\Response
    {
        $schedule->delete();

        return response()->noContent();
    }

    public function restore(Schedule $schedule): \Illuminate\Http\Response
    {
        $schedule->restore();

        return response()->noContent();
    }

    public function forceDestroy(Schedule $schedule): \Illuminate\Http\Response
    {
        $schedule->forceDelete();

        return response()->noContent();
    }

    public function enabled(Schedule $schedule): bool
    {
        return $schedule->update([
            'status' => StatusGlobal::ACTIVE->value
        ]);
    }

    public function disabled(Schedule $schedule): bool
    {
        return $schedule->update([
            'status' => StatusGlobal::INACTIVE->value
        ]);
    }
}
