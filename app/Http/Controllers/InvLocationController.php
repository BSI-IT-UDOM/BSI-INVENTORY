<?php

namespace App\Http\Controllers;

use App\Models\InvLocation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvLocationController extends Controller
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
     * @param  \App\Models\InvLocation  $invLocation
     * @return \Illuminate\Http\Response
     */
    public function show(InvLocation $invLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InvLocation  $invLocation
     * @return \Illuminate\Http\Response
     */
    public function edit(InvLocation $invLocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InvLocation  $invLocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvLocation $invLocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InvLocation  $invLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvLocation $invLocation)
    {
        //
    }
}
