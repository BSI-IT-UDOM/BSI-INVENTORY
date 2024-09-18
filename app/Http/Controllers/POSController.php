<?php

namespace App\Http\Controllers;

use App\Models\POS;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use App\Models\Addon;

class POSController extends Controller
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
        $menus = Menu::all();
        $addons = Addon::all();
        return view('pos', compact('menus','addons'));
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
    // Validate the request
    $validated = $request->validate([
        'shop' => 'required',
        'location' => 'required',
        'menuid' => 'required',
        'menuname' => 'required',
        'addon_id' => 'required',
        'addon_name' => 'required',
        'quantity' => 'required|integer|min:1',
        'price' => 'required|numeric|min:0',
        'currency' => 'required',
        'date' => 'required|date',
    ]);
     
    // Prepare data for API request
    $currency = $request->input('currency') == 'KHR' ? 'Riel(s)' : $request->input('currency');
   
    $apiData = [
        'shop_name' => $request->input('shop'), // Dynamically getting shop name
        'location_Name' => $request->input('location'), // Dynamically getting location name
        'Khmer_name' => '', // Add Khmer name if applicable
        'Eng_name' => $request->input('menuname'),
        'addons' => $request->input('addon_name') ?? '', // Set empty if no addon
        'qty' => $request->input('quantity'),
        'price' => $request->input('price'),
        'date' => $request->input('date'),
        'currency' => $currency,
    ];
    // Send data to API
    $response = Http::withoutVerifying()->post('https://api.bsi.com.kh/inventorybsi', $apiData);
    if ($response->successful()) {
        // Use validated data to construct the success message
        return redirect()->back()->with('success', $request->input('menuname') . ' was sold out ' . $request->input('quantity') . ' glass(s) with a price of $' . $request->input('price') . ' ' . $currency);
    } else {
        return back()->with('error', 'Failed to submit data.');
    }
}

    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\POS  $pOS
     * @return \Illuminate\Http\Response
     */
    public function show(POS $pOS)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\POS  $pOS
     * @return \Illuminate\Http\Response
     */
    public function edit(POS $pOS)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\POS  $pOS
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, POS $pOS)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\POS  $pOS
     * @return \Illuminate\Http\Response
     */
    public function destroy(POS $pOS)
    {
        //
    }
}
