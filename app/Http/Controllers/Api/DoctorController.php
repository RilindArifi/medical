<?php

namespace App\Http\Controllers\Api;

use App\Enums\RolesEnum;
use App\Enums\StatusGlobal;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\DoctorService;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return UserResource::collection(
            User::query()
                ->role(RolesEnum::DOCTOR->value)
                ->latest()
                ->when($request->input('search'), function ($query) use ($request) {
                    return $query->searchAny([ 'first_name', 'last_name', 'email', 'mobile' ], $request->input('search'));
                })
                ->when($request->input('status'), function ($query) use ($request) {
                    return $query->whereStatus($request->input('status'));
                })
                ->when($request->filled(['sort.prop', 'sort.order']), fn(Builder $builder) => $builder
                    ->orderBy($request->input('sort.prop'), $request->input('sort.order') == 'descend' ? 'desc' : 'asc')
                )
                ->onlyTrashedOrNot($request->input('deleted'))
                ->paginate($request->integer('per_page'))
                ->withQueryString());
    }

    public function show(User $doctor): UserResource
    {
        return UserResource::make($doctor);
    }

    public function dropdown(Request $request): AnonymousResourceCollection
    {
        return UserResource::collection(
            User::query()
                ->role(RolesEnum::DOCTOR->value)
                ->when($request->input('search'), function ($query) use ($request) {
                    return $query->searchAny(['first_name', 'email','last_name'], $request->input('search'));
                })
                ->whereStatus(StatusGlobal::ACTIVE->value)
                ->get()
        );
    }

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    private function saveData(DoctorRequest $request, DoctorService $doctorService, User $doctor): UserResource
    {
        return UserResource::make(
            $doctorService
                ->setData($request->all())
                ->setModel($doctor)
                ->updateOrCreate()
        );
    }


    /**
     * Store a newly created resource in storage.
     * @throws \Throwable
     */
    public function store(DoctorRequest $request, DoctorService $doctorService, User $doctor): UserResource
    {
        return UserResource::make(DB::transaction(function () use ($request, $doctorService, $doctor) {
            return $this->saveData($request, $doctorService, $doctor);
        }));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $doctor): UserResource
    {
        return UserResource::make($doctor);
    }

    /**
     * Update the specified resource in storage.
     * @throws \Throwable
     */
    public function update(DoctorRequest $request, DoctorService $doctorService, User $doctor): UserResource
    {
        return UserResource::make(DB::transaction(function () use ($request, $doctorService, $doctor) {
            return $this->saveData($request, $doctorService, $doctor);
        }));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $doctor): \Illuminate\Http\Response
    {
        $doctor->delete();

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function restore(User $doctor): \Illuminate\Http\Response
    {
        $doctor->restore();

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function forceDestroy(User $doctor): \Illuminate\Http\Response
    {
        $doctor->forceDelete();

        return response()->noContent();
    }

    public function enabled(User $doctor): bool
    {
        return $doctor->update([
            'status' => StatusGlobal::ACTIVE->value
        ]);
    }

    public function disabled(User $doctor): bool
    {
        return $doctor->update([
            'status' => StatusGlobal::INACTIVE->value
        ]);
    }
}
