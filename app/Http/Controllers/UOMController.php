<?php

namespace App\Http\Controllers;

use App\Models\UOM;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UOMController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UOM  $uOM
     * @return \Illuminate\Http\Response
     */
    public function show(UOM $uOM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UOM  $uOM
     * @return \Illuminate\Http\Response
     */
    public function edit(UOM $uOM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UOM  $uOM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UOM $uOM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UOM  $uOM
     * @return \Illuminate\Http\Response
     */
    public function destroy(UOM $uOM)
    {
        //
    }
}
