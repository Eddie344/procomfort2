<?php

namespace App\Http\Controllers;

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
        $rolls = RollStorage::all();
        return view('admin.storage.roll.index', compact('rolls'));
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
        RollStorage::create($request->all());
        return redirect('admin/storage/roll')->with(['status' => 'Предмет успешно добавлен в склад!', 'color' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $roll = RollStorage::find($id);
        return view('admin.storage.roll_show', compact('roll'));
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
        //
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
        return redirect('admin/storage/roll')->with(['status' => 'Предмет успешно удалён!', 'color' => 'danger']);
    }
}
