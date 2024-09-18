<?php

namespace App\Http\Controllers;

use App\Models\OrderInfor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderInforController extends Controller
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
     * @param  \App\Models\OrderInfor  $orderInfor
     * @return \Illuminate\Http\Response
     */
    public function show(OrderInfor $orderInfor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderInfor  $orderInfor
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderInfor $orderInfor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderInfor  $orderInfor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderInfor $orderInfor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderInfor  $orderInfor
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderInfor $orderInfor)
    {
        //
    }
}
