<?php

namespace App\Http\Controllers\Api;

use App\Enums\StatusGlobal;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DepartmentController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        return DepartmentResource::collection(
            Department::query()
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
        return DepartmentResource::collection(
            Department::query()
                ->latest()
                ->when($request->input('search'), function ($query) use ($request) {
                    return $query->searchAny(['name', 'description'], $request->input('search'));
                })
                ->whereStatus(StatusGlobal::ACTIVE->value)
                ->get()
        );
    }

    public function store(DepartmentRequest $request, Department $department): DepartmentResource
    {
        return DepartmentResource::make($department->create($request->validated()));
    }

    public function edit(Department $department): DepartmentResource
    {
        return DepartmentResource::make($department);
    }

    public function update(DepartmentRequest $request, Department $department): DepartmentResource
    {
        return DepartmentResource::make($department->updateOrCreate(['id' => $department->id], $request->validated()));
    }

    public function destroy(Department $department): \Illuminate\Http\Response
    {
        $department->delete();

        return response()->noContent();
    }

    public function restore(Department $department): \Illuminate\Http\Response
    {
        $department->restore();

        return response()->noContent();
    }

    public function forceDestroy(Department $department): \Illuminate\Http\Response
    {
        $department->forceDelete();

        return response()->noContent();
    }

    public function enabled(Department $department): bool
    {
        return $department->update([
            'status' => StatusGlobal::ACTIVE->value
        ]);
    }

    public function disabled(Department $department): bool
    {
        return $department->update([
            'status' => StatusGlobal::INACTIVE->value
        ]);
    }
}
