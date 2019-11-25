<?php

namespace App\Http\Controllers;

use App\Models\AddPrice;
use Illuminate\Http\Request;

class AddPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.prices.add.index');
    }

    public function get(Request $request)
    {
        $prices = AddPrice::where([
            ['product_type_id', '=', $request->product_type_id],
        ])->get();
        return response()->json($prices);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $price = AddPrice::create($request->toArray());
        return response($price->id);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        AddPrice::find($id)->update($request->toArray());
        return response('Ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AddPrice::destroy($id);
        return response($id);
    }
}
