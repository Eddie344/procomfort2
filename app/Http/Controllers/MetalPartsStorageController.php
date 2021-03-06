<?php

namespace App\Http\Controllers;

use App\Http\Services\MetalActionsStorageService;
use App\Http\Services\MetalPartsStorageService;
use App\Models\MetalActionsStorage;
use App\Models\MetalPartsStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MetalPartsStorageController extends Controller
{
    public function index()
    {
        //
    }

    public function getAll(Request $request)
    {
        $parts = MetalPartsStorage::with(['type', 'status', 'provider', 'metalStorage'])->where('metal_storage_id', $request->metal_storage_id)
            ->get()
            ->sortByDesc('created_at')
            ->values()
            ->all();
        return response()->json($parts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = MetalPartsStorage::create($request->part);
        $new_item = $item->with(['type', 'status', 'provider', 'metalStorage'])->find($item->id);
        return response()->json($new_item);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $part = $request->part;
        MetalPartsStorage::find($id)->update($part);
        return response()->json(MetalPartsStorage::with(['type', 'status', 'provider', 'metalStorage'])->find($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MetalPartsStorage::destroy($id);
        return response($id);
    }
}
