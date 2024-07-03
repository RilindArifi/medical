<?php

namespace App\Http\Controllers\Api;

use App\Enums\RolesEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use DB;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RoleController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        return RoleResource::collection(
            Role::query()
                ->onlyTrashedOrNot($request->input('deleted'))
                ->when($request->input('search'), function ($query) use ($request) {
                    return $query->searchAny(['name'], $request->input('search'));
                })
                ->when($request->filled(['sort.prop', 'sort.order']), fn(Builder $builder) => $builder
                    ->orderBy($request->input('sort.prop'), $request->input('sort.order') == 'descend' ? 'desc' : 'asc')
                )
                ->paginate($request->integer('per_page'))
                ->withQueryString());
    }
    public function dropdown(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return RoleResource::collection(
            Role::query()
                ->latest()
                ->when($request->input('search'), function ($query) use ($request) {
                    return $query->searchAny(['name'], $request->input('search'));
                })
                ->get()
        );
    }


    /**
     * @throws \Exception
     */
    private function saveData(RoleRequest $request, Role $role): RoleResource
    {
        if ($role->name !== $request->name) {
            $this->roleNotChanged($role);
        }
        $role = $role->updateOrCreate(['id' => $role->id], [ 'name' => $request->name, 'guard_name' => 'api']);

        $role->syncPermissions($request->input('permissions'));
        return RoleResource::make($role);
    }


    /**
     * @throws \Throwable
     */
    public function store(RoleRequest $request, Role $role): RoleResource
    {
        return RoleResource::make(DB::transaction(function () use ($request, $role) {
            return $this->saveData($request, $role);
        }));
    }


    public function edit(Role $role): RoleResource
    {
        return RoleResource::make($role);
    }


    /**
     * @throws \Throwable
     */
    public function update(RoleRequest $request, Role $role): RoleResource
    {
        return RoleResource::make(DB::transaction(function () use ($request, $role) {
            return $this->saveData($request, $role);
        }));
    }

    /**
     * Remove the specified resource from storage.
     * @throws \Exception
     */
    public function destroy(Role $role): \Illuminate\Http\Response
    {
        $this->roleNotChanged($role);
        $role->delete();

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function restore(Role $role): \Illuminate\Http\Response
    {
        $role->restore();

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function forceDestroy(Role $role): \Illuminate\Http\Response
    {
        $role->forceDelete();

        return response()->noContent();
    }

    private function roleNotChanged($role): void
    {
        $restrictedRoles = [
            RolesEnum::ADMIN->value,
            RolesEnum::DOCTOR->value,
            RolesEnum::PATIENT->value
        ];

        if (in_array($role->name, $restrictedRoles, true)) {
            throw new \Exception('The role is restricted and cannot be changed.');
        }

    }
}
