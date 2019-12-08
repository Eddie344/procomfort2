<?php

namespace App\Http\Controllers;

use App\Models\RollActionsStorage;
use App\Models\RollPartsStorage;
use App\Models\RollStorage;
use Illuminate\Http\Request;

class RollStorageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.storage.roll.index');
    }

    public function getAll()
    {
        $rolls = RollStorage::with(['catalog', 'category', 'picture'])->get();
        return response()->json($rolls);
    }

    public function get($id)
    {
        $roll = RollStorage::with(['catalog', 'category', 'picture'])->find($id);
        return response()->json($roll);
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
        $item = RollStorage::create($request->item);
        $new_item = $item->with(['catalog', 'category', 'picture'])->find($item->id);
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
        return view('admin.storage.roll.show', compact('id'));
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
        RollStorage::find($id)->update($item);
        return response()->json(RollStorage::with(['catalog', 'category', 'picture'])->find($id));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RollStorage::destroy($id);
        return response($id);
    }

}
