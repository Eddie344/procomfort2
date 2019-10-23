<?php

namespace App\Http\Controllers;

use App\Models\RollActionsStorage;
use App\Models\RollPartsStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RollPartsStorageController extends Controller
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
        RollPartsStorage::create($request->all());
        $action = new RollActionsStorage;
        $action -> roll_storage_id = $request->roll_storage_id;
        $action -> type_id = 1;
        $action -> user_id = Auth::id();
        $action -> reason = $request->reason;
        $action -> width = $request->width;
        $action -> lenght = $request->lenght;
        $action->save();
        return redirect(route('roll.show', ['id' => $request->roll_storage_id]))->with(['part_status' => 'Партия успешно добавлена!', 'part_color' => 'success']);
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
        $part = RollPartsStorage::find($id);
        $part->lenght = $part->lenght - $request->lenght;
        $part->save();

        $roll_plus = new RollPartsStorage;
        $roll_plus->roll_storage_id = $request->roll_storage_id;
        $roll_plus->price = $request->price;
        $roll_plus->provider_id = $request->provider;
        $roll_plus->status_id = 1;
        $roll_plus->type_id = 2;
        $roll_plus->width = $part->width - $request->width;
        $roll_plus->lenght = $request->lenght;
        $roll_plus->save();

        $action = new RollActionsStorage;
        $action -> roll_storage_id = $request->roll_storage_id;
        $action -> type_id = 2;
        $action -> user_id = Auth::id();
        $action -> reason = $request->reason;
        $action -> width = $request->width;
        $action -> lenght = $request->lenght;
        $action->save();
        return redirect(route('roll.show', ['id' => $request->roll_storage_id]))->with(['part_status' => 'Изменения сохранены!', 'part_color' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $action = new RollActionsStorage;
        $action -> roll_storage_id = $request->roll_storage_id;
        $action -> type_id = 2;
        $action -> user_id = Auth::id();
        $action -> reason = $request->reason;
        $action -> width = $request->width;
        $action -> lenght = $request->lenght;
        $action->save();
        RollPartsStorage::destroy($id);
        return redirect(route('roll.show', ['id' => $request->roll_storage_id]))->with(['part_status' => 'Предмет успешно удален!', 'part_color' => 'danger']);
    }
}
