<?php

namespace App\Http\Controllers;

use App\Models\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;
use DB;

class Search extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $query = Input::get('query');
        $query = substr($query, 0, 64);
        $query = preg_replace('/[^\p{L}0-9 ]/iu','',$query);
        $queryModel = new Query;

        if(!empty($query)){
            $queries = $queryModel->where('query','LIKE','%'.$query.'%');   
            $exact_match = $queryModel->where('query','LIKE', $query);
        }

        $data = $queries->get()->toArray();
        $exact = $exact_match->get()->toArray();
        if(count($exact) < 1){
            $queryModel->query = $query;
            $queryModel->save();
        }else{
            $exact = reset($exact);
            $queryModel->where('id', $exact['id'])
                       ->update(['weight' => DB::raw($exact['weight']+1)]);
        }

        return response()->json(array('data' => $data), 200);
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
