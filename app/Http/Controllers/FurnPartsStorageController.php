<?php

namespace App\Http\Controllers;

use App\Http\Services\FurnActionsStorageService;
use App\Http\Services\FurnPartsStorageService;
use App\Models\FurnActionsStorage;
use App\Models\FurnPartsStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FurnPartsStorageController extends Controller
{
    public function index()
    {
        //
    }

    public function getAll(Request $request)
    {
        $parts = FurnPartsStorage::with(['type', 'status', 'provider', 'furnStorage'])->where('furn_storage_id', $request->furn_storage_id)
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
        $item = FurnPartsStorage::create($request->part);
        $new_item = $item->with(['type', 'status', 'provider', 'furnStorage'])->find($item->id);
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
        FurnPartsStorage::find($id)->update($part);
        return response()->json(FurnPartsStorage::with(['type', 'status', 'provider', 'furnStorage'])->find($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FurnPartsStorage::destroy($id);
        return response($id);
    }
}
