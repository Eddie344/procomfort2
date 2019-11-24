<?php

namespace App\Http\Controllers;

use App\Models\VertPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VertPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.prices.vert.index');
    }

    public function get(Request $request)
    {
        $prices = VertPrice::where([
            ['catalog_id', '=', $request->catalog_id],
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
        $price = VertPrice::create($request->toArray());
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
        VertPrice::find($id)->update($request->toArray());
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
        VertPrice::destroy($id);
        return response($id);
    }
}
