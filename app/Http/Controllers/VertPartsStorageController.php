<?php

namespace App\Http\Controllers;

use App\Http\Services\VertActionsStorageService;
use App\Http\Services\VertPartsStorageService;
use App\Models\VertActionsStorage;
use App\Models\VertPartsStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VertPartsStorageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getAll(Request $request)
    {
        $parts = VertPartsStorage::with(['type', 'status', 'provider', 'vertStorage'])->where('vert_storage_id', $request->vert_storage_id)
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
        $item = VertPartsStorage::create($request->part);
        $new_item = $item->with(['type', 'status', 'provider', 'vertStorage'])->find($item->id);
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
        VertPartsStorage::find($id)->update($part);
        return response()->json(VertPartsStorage::with(['type', 'status', 'provider', 'vertStorage'])->find($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        VertPartsStorage::destroy($id);
        return response($id);
    }
}
