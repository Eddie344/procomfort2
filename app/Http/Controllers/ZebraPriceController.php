<?php

namespace App\Http\Controllers;

use App\Models\ZebraPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ZebraPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.prices.zebra.index');
    }

    public function get(Request $request)
    {
        $prices = DB::table('zebra_prices')
            ->where([
                ['construction_id', '=', $request->construction_id],
                ['catalog_id', '=', $request->catalog_id],
                ['category_id', '=', $request->category_id],
            ])
            ->get()->groupBy('height')->map->keyBy('width');
        return response()->json($prices);
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
        //
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
    public function update(Request $request)
    {
        $array = $request->prices;
        $flattened = collect($array)->flatten(1)->toArray();
        Arr::except($flattened, ['id']);
        ZebraPrice::where([
            'construction_id' => $request->construction_id,
            'catalog_id' => $request->catalog_id,
            'category_id' => $request->category_id,
        ])->delete();
        ZebraPrice::insert($flattened);
        return response('OK');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
