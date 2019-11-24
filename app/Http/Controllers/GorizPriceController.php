<?php

namespace App\Http\Controllers;

use App\Models\GorizPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GorizPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.prices.goriz.index');
    }

    public function get(Request $request)
    {
        $prices = DB::table('goriz_prices')
            ->where([
                ['catalog_id', '=', $request->catalog_id],
            ])
            ->get()->sortBy('category_id');
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
        $price = GorizPrice::create($request->toArray());
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
        GorizPrice::destroy($id);
        return response($id);
    }
}
