<?php

namespace App\Http\Controllers\Api;

use App\Enums\RolesEnum;
use App\Enums\StatusGlobal;
use App\Http\Controllers\Controller;
use App\Http\Requests\StaffRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\DoctorService;
use App\Services\StaffService;
use DB;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class StaffController extends Controller
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
                ->when($request->input('search'), function ($query) use ($request) {
                    return $query->searchAny(['first_name', 'email','last_name'], $request->input('search'));
                })
                ->when($request->input('status'), function ($query) use ($request) {
                    return $query->whereStatus($request->input('status'));
                })
                ->when($request->filled(['sort.prop', 'sort.order']), fn(Builder $builder) => $builder
                    ->orderBy($request->input('sort.prop'), $request->input('sort.order') == 'descend' ? 'desc' : 'asc')
                )
                ->whereDoesntHave('roles', function (Builder $query) {
                    $query->where('name', RolesEnum::PATIENT->value);
                })
                ->paginate($request->integer('per_page'))
                ->withQueryString());
    }


    public function dropdown(Request $request): AnonymousResourceCollection
    {
        return UserResource::collection(
            User::query()
                ->when($request->input('search'), function ($query) use ($request) {
                    return $query->searchAny(['first_name', 'email','last_name'], $request->input('search'));
                })
                ->whereDoesntHave('roles', function (Builder $query) {
                    $query->where('name', RolesEnum::PATIENT->value);
                })
                ->whereStatus(StatusGlobal::ACTIVE->value)
                ->get()
        );
    }
    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    private function saveData(StaffRequest $request, StaffService $staffService, User $staff): UserResource
    {
        return UserResource::make(
            $staffService
                ->setData($request->all())
                ->setModel($staff)
                ->updateOrCreate()
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show(User $staff): UserResource
    {
        return UserResource::make($staff);
    }


    /**
     * Store a newly created resource in storage.
     * @throws \Throwable
     */
    public function store(StaffRequest $request, StaffService $staffService, User $staff): UserResource
    {
        return UserResource::make(DB::transaction(function () use ($request, $staffService, $staff) {
            return $this->saveData($request, $staffService, $staff);
        }));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $staff): UserResource
    {
        return UserResource::make($staff);
    }

    /**
     * Update the specified resource in storage.
     * @throws \Throwable
     */
    public function update(StaffRequest $request, StaffService $staffService, User $staff): UserResource
    {
        return UserResource::make(DB::transaction(function () use ($request, $staffService, $staff) {
            return $this->saveData($request, $staffService, $staff);
        }));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $staff): \Illuminate\Http\Response|Exception
    {
        if(!$staff->is($request->user())){
            $staff->delete();
            return response()->noContent();
        }
        throw new Exception('You cannot delete yourself!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function restore(User $staff): \Illuminate\Http\Response
    {
        $staff->restore();

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function forceDestroy(Request $request, User $staff): \Illuminate\Http\Response
    {
        if(!$staff->is($request->user())){
            $staff->forceDelete();
            return response()->noContent();
        }
        throw new Exception('You cannot delete yourself!');
    }

    public function enabled(User $staff): bool
    {
        return $staff->update([
            'status' => StatusGlobal::ACTIVE->value
        ]);
    }

    public function disabled(User $staff): bool
    {
        return $staff->update([
            'status' => StatusGlobal::INACTIVE->value
        ]);
    }
}
