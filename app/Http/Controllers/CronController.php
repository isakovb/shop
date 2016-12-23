<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Models\Category;
use App\Models\Product;
use App\Models\Property;
use App\Models\Value;
use Illuminate\Http\Request;
use DB;

class CronController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dictionary()
    {
        $categories = Category::select('name')->distinct()->get()->toArray();
        $products = Product::select('name')->distinct()->get()->toArray();
        $merge = array_merge($categories,$products);
        $dictionaries = [];
        foreach($merge as $m) $dictionaries[] = $m['name'];
        $dictionaries = array_unique($dictionaries);
        foreach($dictionaries as $d){
          $dictionary = new Dictionary;
          if($dictionary->where('name', $d)->first() == null){
          $dictionary->name = $d;
          $dictionary->save();
          }
        }
        return response()->json(array('result' => 'success'), 200);
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
        //
    }
}
