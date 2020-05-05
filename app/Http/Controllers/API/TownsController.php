<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Town as TownResource;

class TownsController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(new TownResource($request->user()->town->load('buildingLevels', 'buildingLevels.building')));
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
