<?php

namespace App\Http\Controllers\Api;

use App\Enums\RolesEnum;
use App\Enums\StatusGlobal;
use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequest;
use App\Http\Resources\DepartmentResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\PatientService;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return UserResource::collection(
            User::query()
                ->onlyTrashedOrNot($request->input('deleted'))
                ->latest()
                ->role(RolesEnum::PATIENT->value)
                ->when($request->input('search'), function ($query) use ($request) {
                    return $query->searchAny(['first_name', 'email','last_name'], $request->input('search'));
                })
                ->when($request->input('status'), function ($query) use ($request) {
                    return $query->whereStatus($request->input('status'));
                })
                ->when($request->filled(['sort.prop', 'sort.order']), fn(Builder $builder) => $builder
                    ->orderBy($request->input('sort.prop'), $request->input('sort.order') == 'descend' ? 'desc' : 'asc')
                )
                ->paginate($request->integer('per_page'))
                ->withQueryString());
    }

    public function dropdown(Request $request): AnonymousResourceCollection
    {
        return UserResource::collection(
            User::query()
                ->role(RolesEnum::PATIENT->value)
                ->whereStatus(StatusGlobal::ACTIVE->value)
                ->when($request->input('search'), function ($query) use ($request) {
                    return $query->searchAny(['first_name', 'email','last_name'], $request->input('search'));
                })
                ->get()
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show(User $patient): UserResource
    {
        return UserResource::make($patient);
    }

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    private function saveData(PatientRequest $request, PatientService $patientService, User $patient): UserResource
    {
        return UserResource::make(
            $patientService
                ->setData($request->all())
                ->setModel($patient)
                ->updateOrCreate()
        );
    }


    /**
     * Store a newly created resource in storage.
     * @throws \Throwable
     */
    public function store(PatientRequest $request, PatientService $patientService, User $patient): UserResource
    {
        return UserResource::make(DB::transaction(function () use ($request, $patientService, $patient) {
            return $this->saveData($request, $patientService, $patient);
        }));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $patient): UserResource
    {
        return UserResource::make($patient);
    }

    /**
     * Update the specified resource in storage.
     * @throws \Throwable
     */
    public function update(PatientRequest $request, PatientService $patientService, User $patient): UserResource
    {
        return UserResource::make(DB::transaction(function () use ($request, $patientService, $patient) {
            return $this->saveData($request, $patientService, $patient);
        }));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $patient): \Illuminate\Http\Response
    {
        $patient->delete();

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function restore(User $patient): \Illuminate\Http\Response
    {
        $patient->restore();

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function forceDestroy(User $patient): \Illuminate\Http\Response
    {
        $patient->forceDelete();

        return response()->noContent();
    }

    public function enabled(User $patient): bool
    {
        return $patient->update([
            'status' => StatusGlobal::ACTIVE->value
        ]);
    }

    public function disabled(User $patient): bool
    {
        return $patient->update([
            'status' => StatusGlobal::INACTIVE->value
        ]);
    }
}
