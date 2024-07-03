<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(setting()->all());
    }

    public function update(Request $request): JsonResource
    {
        setting()->set(['working_days' => $request->input('working_days')]);
        setting()->set(['holidays' => $request->input('holidays')]);
        setting()->set('working_hours', $request->input('working_hours'));

        setting()->save();

        return JsonResource::make(setting()->all());
    }

    public function updateSingle(Request $request): \Illuminate\Http\Response
    {
        $request->validate(['key' => 'required', 'value' => 'required']);

        setting()->set($request->input('key'), $request->input('value'));

        setting()->save();

        return response()->noContent();
    }
}
