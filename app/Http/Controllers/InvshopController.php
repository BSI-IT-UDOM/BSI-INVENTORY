<?php

namespace App\Http\Controllers;

use App\Models\Invshop;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvshopController extends Controller
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
     * @param  \App\Models\Invshop  $invshop
     * @return \Illuminate\Http\Response
     */
    public function show(Invshop $invshop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invshop  $invshop
     * @return \Illuminate\Http\Response
     */
    public function edit(Invshop $invshop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invshop  $invshop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invshop $invshop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invshop  $invshop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invshop $invshop)
    {
        //
    }
}
