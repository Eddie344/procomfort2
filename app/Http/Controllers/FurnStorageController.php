<?php

namespace App\Http\Controllers;

use App\Models\FurnActionsStorage;
use App\Models\FurnPartsStorage;
use App\Models\FurnStorage;
use Illuminate\Http\Request;

class FurnStorageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.storage.furn.index');
    }

    public function getAll()
    {
        $furns = FurnStorage::all();
        return response()->json($furns);
    }

    public function get($id)
    {
        $furn = FurnStorage::find($id);
        return response()->json($furn);
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
        $item = FurnStorage::create($request->item);
        $new_item = $item->find($item->id);
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
        return view('admin.storage.furn.show', compact('id'));
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
        $item = $request->item;
        FurnStorage::find($id)->update($item);
        return response()->json(FurnStorage::find($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FurnStorage::destroy($id);
        return response($id);
    }
}
