<?php

namespace App\Http\Controllers;

use App\Models\InvRole;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvRoleController extends Controller
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
        // $invRole = InvRole::all();
        // dd($invRole); 
        // return view('auth.register', compact('invRole'));
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
     * @param  \App\Models\InvRole  $invRole
     * @return \Illuminate\Http\Response
     */
    public function show(InvRole $invRole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InvRole  $invRole
     * @return \Illuminate\Http\Response
     */
    public function edit(InvRole $invRole)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InvRole  $invRole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvRole $invRole)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InvRole  $invRole
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvRole $invRole)
    {
        //
    }
}
