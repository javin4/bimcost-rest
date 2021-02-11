<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Element\PElementTyp;

class PElementTypController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $PElementDefs = PElementTyp::with(['PComponents'=> 
            function($query){
            $query->select('*')->orderBy('kennung');
//            $query->select('name','kennung','p_component_id')->orderBy('kennung');
           }])
    
        ->select('kennung','name','id','ehp_override','ehp_override_flag','ehp_result')
        ->orderBy('kennung')
        ->get();
         
/*
        $PElementDefs = DB::table('p_components')
        ->join('p_typ_components','p_components.id','=','p_typ_components.p_component_id')
        ->join('p_elementtyps','p_typ_components.p_component_id','=','p_elementtyps.id')
        ->get();
  */      
        return response()->json($PElementDefs, 200);
    }
    
    public function computeEhp($id) {
        $PElementTyp = PElementTyp::findorfail($id);
        $result = $PElementTyp->ehp_result();
        return response()->json($id . ':computed value: '. $result, 200);
    }


    public function index2(){  //get all Typs with Elements
        $PElementDefs = PElementTyp::with(['PElement'=> 
            function($query){
            $query->select('p_elementtyp_id','id');
           }])
        ->select('kennung','name','id')
        ->orderBy('kennung')
        ->get();
  
        return response()->json($PElementDefs, 200);
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
     * @param  \App\Models\Element\PElementTyp  $pElementTyp
     * @return \Illuminate\Http\Response
     */
    public function show(PElementTyp $pElementTyp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Element\PElementTyp  $pElementTyp
     * @return \Illuminate\Http\Response
     */
    public function edit(PElementTyp $pElementTyp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Element\PElementTyp  $pElementTyp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PElementTyp $pElementTyp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Element\PElementTyp  $pElementTyp
     * @return \Illuminate\Http\Response
     */
    public function destroy(PElementTyp $pElementTyp)
    {
        //
    }
}
