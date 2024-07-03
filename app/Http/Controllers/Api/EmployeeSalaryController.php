<?php

namespace App\Http\Controllers\Api;

use App\Enums\RolesEnum;
use App\Enums\StatusGlobal;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeSalaryRequest;
use App\Http\Resources\EmployeeSalaryResource;
use App\Models\EmployeeSalary;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class EmployeeSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return EmployeeSalaryResource::collection(
            EmployeeSalary::query()
                ->latest()
                ->when($request->input('search'), function (Builder $query) use ($request) {
                    $query->whereHas('user', function ($query) use ($request) {
                        return $query->searchAny([ 'first_name','last_name', 'email'], $request->input('search'));
                    });
                })
                ->when($request->input('role'), function (Builder $query) use ($request) {
                    $query->whereHas('user', function ($query) use ($request) {
                        return $query->role($request->input('role'));
                    });
                })
                ->when($request->input('staff_id'), function (Builder $query) use ($request) {
                    $query->whereHas('user', function ($query) use ($request) {
                        return $query->whereId($request->input('staff_id'));
                    });
                })
                ->when($request->input('status'), function ($query) use ($request) {
                    return $query->whereStatus($request->input('status'));
                })
                ->when($request->filled(['sort.prop', 'sort.order']), fn(Builder $builder) => $builder
                    ->orderBy($request->input('sort.prop'), $request->input('sort.order') == 'descend' ? 'desc' : 'asc')
                )
                ->when($request->custom, function ($query) use ($request) {
                    if (count($request->custom) === 2) {
                        $startDate = $request->custom[0];
                        $endDate = $request->custom[1];

                        return $query->whereBetween('created_at', [$startDate, $endDate]);
                    }
                    return $query;
                })
                ->onlyTrashedOrNot($request->input('deleted'))
                ->paginate($request->integer('per_page'))
                ->withQueryString());
    }

    public function show(EmployeeSalary $employee_salarie): EmployeeSalaryResource
    {
        return EmployeeSalaryResource::make($employee_salarie);
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Throwable
     */
    public function store(EmployeeSalaryRequest $request, EmployeeSalary $employee_salarie): EmployeeSalaryResource
    {
        return EmployeeSalaryResource::make($employee_salarie->create($request->validated()));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmployeeSalary $employee_salarie): EmployeeSalaryResource
    {
        return EmployeeSalaryResource::make($employee_salarie);
    }

    /**
     * Update the specified resource in storage.
     * @throws \Throwable
     */
    public function update(EmployeeSalaryRequest $request,  EmployeeSalary $employee_salarie): EmployeeSalaryResource
    {
        return EmployeeSalaryResource::make($employee_salarie->updateOrCreate(['id' => $employee_salarie->id],$request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeSalary $employee_salarie): \Illuminate\Http\Response
    {
        $employee_salarie->delete();

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function restore(EmployeeSalary $employee_salarie): \Illuminate\Http\Response
    {
        $employee_salarie->restore();

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function forceDestroy(EmployeeSalary $employee_salarie): \Illuminate\Http\Response
    {
        $employee_salarie->forceDelete();

        return response()->noContent();
    }

    public function enabled(EmployeeSalary $employee_salarie): bool
    {
        return $employee_salarie->update([
            'status' => StatusGlobal::ACTIVE->value
        ]);
    }

    public function disabled(EmployeeSalary $employee_salarie): bool
    {
        return $employee_salarie->update([
            'status' => StatusGlobal::INACTIVE->value
        ]);
    }
}
