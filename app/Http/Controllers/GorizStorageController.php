<?php

namespace App\Http\Controllers;

use App\Models\GorizActionsStorage;
use App\Models\GorizPartsStorage;
use App\Models\GorizStorage;
use Illuminate\Http\Request;

class GorizStorageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.storage.goriz.index');
    }

    public function getAll()
    {
        $gorizs = GorizStorage::with(['catalog', 'category'])->get();
        return response()->json($gorizs);
    }

    public function get($id)
    {
        $goriz = GorizStorage::with(['catalog', 'category'])->find($id);
        return response()->json($goriz);
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
        $item = GorizStorage::create($request->item);
        $new_item = $item->with(['catalog', 'category'])->find($item->id);
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
        return view('admin.storage.goriz.show', compact('id'));
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
        GorizStorage::find($id)->update($item);
        return response()->json(GorizStorage::with(['catalog', 'category'])->find($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        GorizStorage::destroy($id);
        return response($id);
    }
}
