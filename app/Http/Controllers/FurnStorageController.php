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
        $furns = FurnStorage::filter()->paginate(10);
        return view('admin.storage.furn.index', compact('furns'));
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
        FurnStorage::create($request->all());
        return redirect('admin/storage/furn')->with(['status' => 'Предмет успешно добавлен в склад!', 'color' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $furn = FurnStorage::find($id);
        $parts = FurnPartsStorage::with(['type', 'status', 'provider', 'furnStorage'])->where('furn_storage_id', $id)->get();
        $actions = FurnActionsStorage::index($id)->filter()->paginate('10');
        return view('admin.storage.furn.show', compact('furn', 'parts', 'actions'));
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
        $furn = FurnStorage::find($id);
        $furn->update($request->all());
        return redirect(route('furn.show', ['id' => $id]))->with('status', 'Изменения сохранены!');
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
        return redirect('admin/storage/furn')->with(['status' => 'Предмет успешно удалён!', 'color' => 'danger']);
    }
}
