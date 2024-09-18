<?php

namespace App\Http\Controllers;

use App\Models\Profit_Lose;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Sale;

class Profit_LoseController extends Controller
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
        $totalExpense = Profit_Lose::where('type', 'Expense')
            ->where('Currency_id', 1)
            ->sum('price');
        $totalExpenseReal = Profit_Lose::where('type', 'Expense')
            ->where('Currency_id', 2)
            ->sum('price');
        $totalIncome = Profit_Lose::where('type', 'Income')
            ->where('Currency_id', 1)
            ->sum('price');
        $totalIncomeReal = Profit_Lose::where('type', 'Income')
            ->where('Currency_id', 2)
            ->sum('price');
        $countTotalSale = Sale::count();
        $countTotalOrder = Order::count();
        return view('profit_lose', compact('totalExpense','totalExpenseReal','totalIncome','totalIncomeReal','countTotalSale','countTotalOrder')); 
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
     * @param  \App\Models\Profit_Lose  $profit_Lose
     * @return \Illuminate\Http\Response
     */
    public function show(Profit_Lose $profit_Lose)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profit_Lose  $profit_Lose
     * @return \Illuminate\Http\Response
     */
    public function edit(Profit_Lose $profit_Lose)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profit_Lose  $Profit_Lose
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profit_Lose $profit_Lose)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profit_Lose  $profit_Lose
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profit_Lose $profit_Lose)
    {
        //
    }
}
