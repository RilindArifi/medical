<?php

namespace App\Http\Controllers\Api;

use App\Enums\ExpenseStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseRequest;
use App\Http\Requests\LeaveRequest;
use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ExpenseController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        return ExpenseResource::collection(
            Expense::query()
                ->onlyTrashedOrNot($request->input('deleted'))
                ->latest()
                ->when($request->input('search'), function (Builder $query) use ($request) {
                    $query->whereHas('user', function ($query) use ($request) {
                        return $query->searchAny([ 'first_name','last_name', 'email'], $request->input('search'));
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
                ->when($request->input('paid_by'), function ($query) use ($request) {
                    return $query->wherePaidBy($request->input('paid_by'));
                })
                ->when($request->custom, function ($query) use ($request) {
                    if (count($request->custom) === 2) {
                        $startDate = $request->custom[0];
                        $endDate = $request->custom[1];

                        return $query->whereBetween('purchase_date', [$startDate, $endDate]);
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


    public function store(ExpenseRequest $request, Expense $expense): ExpenseResource
    {
        return ExpenseResource::make($expense->create($request->validated()));
    }

    public function edit(Expense $expense): ExpenseResource
    {
        return ExpenseResource::make($expense);
    }

    public function update(LeaveRequest $request, Expense $expense): ExpenseResource
    {
        return ExpenseResource::make($expense->updateOrCreate(['id' => $expense->id], $request->validated()));
    }

    public function destroy(Expense $expense): \Illuminate\Http\Response
    {
        $expense->delete();

        return response()->noContent();
    }

    public function restore(Expense $expense): \Illuminate\Http\Response
    {
        $expense->restore();

        return response()->noContent();
    }

    public function forceDestroy(Expense $expense): \Illuminate\Http\Response
    {
        $expense->forceDelete();

        return response()->noContent();
    }

    public function enabled(Expense $expense): bool
    {
        return $expense->update([
            'status' => ExpenseStatus::APPROVED->value
        ]);
    }

    public function disabled(Expense $expense): bool
    {
        return $expense->update([
            'status' => ExpenseStatus::REJECTED->value
        ]);
    }
}
