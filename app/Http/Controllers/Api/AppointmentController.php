<?php

namespace App\Http\Controllers\Api;

use App\Enums\AppointmentStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Services\AppointmentService;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class AppointmentController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        return AppointmentResource::collection(
            Appointment::query()
                ->latest()
                ->onlyTrashedOrNot($request->input('deleted'))
                ->when($request->input('search'), function (Builder $builder) use ($request) {
                    $builder->whereHas('patient',function ($query) use ($request) {
                        $query->searchAny([ 'first_name', 'last_name', 'email', 'mobile' ], $request->input('search'));
                    });
                })
                ->when($request->filled(['sort.prop', 'sort.order']), fn(Builder $builder) => $builder
                    ->orderBy($request->input('sort.prop'), $request->input('sort.order') == 'descend' ? 'desc' : 'asc')
                )
                ->paginate($request->integer('per_page'))
                ->withQueryString());
    }
    public function dropdown(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return AppointmentResource::collection(
            Appointment::query()
                ->latest()
                ->when($request->input('search'), function ($query) use ($request) {
                    return $query->searchAny(['name'], $request->input('search'));
                })
                ->get()
        );
    }


    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    private function saveData(AppointmentRequest $request, Appointment $appointment): AppointmentResource
    {
        return AppointmentResource::make(
            (new AppointmentService())
                ->setData($request->all())
                ->setModel($appointment)
                ->updateOrCreate()
        );
    }


    /**
     * @throws \Throwable
     */
    public function store(AppointmentRequest $request, Appointment $appointment): AppointmentResource
    {
        return AppointmentResource::make(DB::transaction(function () use ($request, $appointment) {
            return $this->saveData($request, $appointment);
        }));
    }


    public function edit(Appointment $appointment): AppointmentResource
    {
        return AppointmentResource::make($appointment);
    }


    /**
     * @throws \Throwable
     */
    public function update(AppointmentRequest $request, Appointment $appointment): AppointmentResource
    {
        return AppointmentResource::make(DB::transaction(function () use ($request, $appointment) {
            return $this->saveData($request, $appointment);
        }));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment): \Illuminate\Http\Response
    {
        $appointment->delete();

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function restore(Appointment $appointment): \Illuminate\Http\Response
    {
        $appointment->restore();

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function forceDestroy(Appointment $appointment): \Illuminate\Http\Response
    {
        $appointment->forceDelete();

        return response()->noContent();
    }

    public function enabled(Appointment $appointment): bool
    {
        return $appointment->update([
            'status' => AppointmentStatus::APPROVED->value
        ]);
    }

    public function disabled(Appointment $appointment): bool
    {
        return $appointment->update([
            'status' => AppointmentStatus::REJECTED->value
        ]);
    }
}
