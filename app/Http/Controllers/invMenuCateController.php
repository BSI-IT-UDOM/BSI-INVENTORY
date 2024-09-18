<?php

namespace App\Http\Controllers;

use App\Models\invMenuCate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class invMenuCateController extends Controller
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
     * @param  \App\Models\invMenuCate $invMenuCate
     * @return \Illuminate\Http\Response
     */
    public function show(invMenuCate $invMenuCate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invMenuCate $invMenuCate
     * @return \Illuminate\Http\Response
     */
    public function edit(invMenuCate $invMenuCate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invMenuCate $invMenuCate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invMenuCate $invMenuCate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invMenuCate $invMenuCate
     * @return \Illuminate\Http\Response
     */
    public function destroy(invMenuCate $invMenuCate)
    {
        //
    }
}
