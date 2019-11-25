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

    public function get()
    {
        $rolls = RollStorage::with(['catalog', 'category', 'picture'])->get();
        return response()->json($rolls);
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
        $roll = RollStorage::find($id);
        $parts = RollPartsStorage::with(['type', 'status', 'provider', 'rollStorage'])->where('roll_storage_id', $id)->orderBy('type_id')->get();
        $actions = RollActionsStorage::index($id)->filter()->paginate('10');
        return view('admin.storage.roll.show', compact('roll', 'parts', 'actions'));
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
        $roll = RollStorage::find($id);
        $roll->update($request->all());
        return redirect(route('roll.show', ['id' => $id]))->with('status', 'Изменения сохранены!');
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
