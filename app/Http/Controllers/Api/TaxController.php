<?php

namespace App\Http\Controllers\Api;

use App\Enums\StatusGlobal;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaxRequest;
use App\Http\Resources\TaxResource;
use App\Models\Tax;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaxController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        return TaxResource::collection(
            Tax::query()
                ->onlyTrashedOrNot($request->input('deleted'))
                ->latest()
                ->when($request->input('search'), function ($query) use ($request) {
                    return $query->searchAny(['name'], $request->input('search'));
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
        return TaxResource::collection(
            Tax::query()
                ->latest()
                ->when($request->input('search'), function ($query) use ($request) {
                    return $query->searchAny(['name'], $request->input('search'));
                })
                ->whereStatus(StatusGlobal::ACTIVE->value)
                ->get()
        );
    }

    public function store(TaxRequest $request, Tax $taxe): TaxResource
    {
        return TaxResource::make($taxe->create($request->validated()));
    }

    public function edit(Tax $taxe): TaxResource
    {
        return TaxResource::make($taxe);
    }

    public function update(TaxRequest $request, Tax $taxe): TaxResource
    {
        return TaxResource::make($taxe->updateOrCreate(['id' => $taxe->id], $request->validated()));
    }

    public function destroy(Tax $taxe): \Illuminate\Http\Response
    {
        $taxe->delete();

        return response()->noContent();
    }

    public function restore(Tax $taxe): \Illuminate\Http\Response
    {
        $taxe->restore();

        return response()->noContent();
    }

    public function forceDestroy(Tax $taxe): \Illuminate\Http\Response
    {
        $taxe->forceDelete();

        return response()->noContent();
    }

    public function enabled(Tax $taxe): bool
    {
        return $taxe->update([
            'status' => StatusGlobal::ACTIVE->value
        ]);
    }

    public function disabled(Tax $taxe): bool
    {
        return $taxe->update([
            'status' => StatusGlobal::INACTIVE->value
        ]);
    }
}
