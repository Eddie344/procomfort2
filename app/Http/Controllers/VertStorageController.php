<?php

namespace App\Http\Controllers;

use App\Models\VertActionsStorage;
use App\Models\VertPartsStorage;
use App\Models\VertStorage;
use Illuminate\Http\Request;

class VertStorageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $verts = VertStorage::with(['catalog', 'category'])->filter()->paginate('10');
        return view('admin.storage.vert.index', compact('verts'));
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
        VertStorage::create($request->all());
        return redirect('admin/storage/vert')->with(['status' => 'Предмет успешно добавлен в склад!', 'color' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vert = VertStorage::find($id);
        $parts = VertPartsStorage::with(['type', 'status', 'provider', 'vertStorage'])->where('vert_storage_id', $id)->get();
        $actions = VertActionsStorage::index($id)->filter()->paginate('10');
        return view('admin.storage.vert.show', compact('vert', 'parts', 'actions'));
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
        VertStorage::destroy($id);
        return redirect('admin/storage/vert')->with(['status' => 'Предмет успешно удалён!', 'color' => 'danger']);
    }
}
