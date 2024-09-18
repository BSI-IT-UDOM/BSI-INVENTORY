<?php

namespace App\Http\Controllers;

use App\Models\UOM;
use App\Models\Addon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddonController extends Controller
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
        $uom =UOM::all();
        $Addons = Addon::with('uom')->paginate(8); 
        return view('add-on', compact('Addons','uom')); 
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
        $validatedData = $request->validate([
            'Addons_name' => 'required|string|max:255',
            'Percentage' => 'nullable|string|max:255',
            'Qty' => 'required|integer',
            'UOM_id' => 'required|integer',

        ]);


        Addon::create($validatedData);

        // Redirect or return response
        return redirect()->back()->with('success', 'Product added successfully!');
    }
    
    public function toggleStatus(Request $request, $id)
    {
        $material = Addon::find($id);
        if (!$material) {
            return response()->json(['success' => false, 'message' => 'Material not found'], 404);
        }
        $newStatus = $request->input('status');
        $material->status = $newStatus;
        $material->save();
        return response()->json(['success' => true, 'status' => $newStatus]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Addons  $addons
     * @return \Illuminate\Http\Response
     */
    public function show(Addons $addons)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Addons  $addons
     * @return \Illuminate\Http\Response
     */
    public function edit(Addon $addons)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Addons  $addons
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$Addons_id)
    {
           // Validate the request data
           $validatedData = $request->validate([
            'Addons_name' => 'required|string|max:255',
            'Percentage' => 'required|string|max:255',
            'Qty' => 'required|integer',
            'UOM_id' => 'required|integer',
        ], [
            'Addons_name.required' => 'Please input Add-on Name',
            'Percentage.required' => 'Please input Add-on Percentage',
            'Qty.required' => 'Please input Add-on Qty',
            'UOM_id.required' => 'Please input Unit of Measure',
        ]);
    
        // Find the supplier by ID
        $addons = Addons::find($Addons_id);
 
        // Update the supplier data
        $addons->Addons_name = $validatedData['Addons_name'];
        $addons->Percentage = $validatedData['Percentage'];
        $addons->Qty = $validatedData['Qty'];
        $addons->UOM_id = $validatedData['UOM_id'];
    
        // Save the changes
        $addons->save();
    
        return redirect('/add-on')->with('flash_message', 'Add-on Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Addon  $addons
     * @return \Illuminate\Http\Response
     */
    public function destroy($Addons_id)
    {
        Addon::destroy($Addons_id);
        return redirect('add-on')->with('flash_message', 'Addon deleted!');
    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $suppliers = Addon::where('Addons_name', 'LIKE', "%{$searchTerm}%")->paginate(8); 

        $output = '';
        foreach ($suppliers as $index => $data) {
            $rowClass = ($index % 2 === 0) ? 'bg-zinc-200' : 'bg-zinc-300';
            $borderClass = ($index === 0) ? 'border-t-4' : '';
        
            $output .= '
            <tr class="' . $rowClass . ' text-base ' . $borderClass . ' text-center border-white">
              <td class="py-3 px-4 border border-white">' . ($data->Addons_id ?? 'null') . '</td>
              <td class="py-3 px-4 border border-white">' . ($data->Addons_name ?? 'null') . '</td>
              <td class="py-3 px-4 border border-white">' . ($data->Percentage ?? 'null') . '</td>
              <td class="py-3 px-4 border border-white">' . ($data->Qty ?? 'null' ) . '</td>
              <td class="py-3 px-4 border border-white">' . ( $data->uom->UOM_name ?? 'null') . '</td>
              <td class="py-3 border border-white">
                <button class="relative bg-blue-500 hover:bg-blue-600 active:bg-blue-700 text-white py-2 px-4 rounded-md focus:outline-none transition duration-150 ease-in-out group" onclick="openEditPopup(' . $data->Sup_id . ', \'' . $data->Sup_name . '\', \'' . $data->Sup_contact . '\', \'' . $data->Sup_address . '\')">
                  <i class="fas fa-edit fa-xs"></i>
                  <span class="absolute left-1/2 transform -translate-x-1/2 bottom-full mb-1 px-2 py-1 text-xs text-white bg-gray-800 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-in-out">Edit</span>
                </button>
                <button class="relative bg-red-500 hover:bg-red-600 active:bg-red-700 text-white py-2 px-4 rounded-md focus:outline-none transition duration-150 ease-in-out group" 
                        onclick="if(confirm(\'Are you sure you want to delete?\')) window.location.href=\'add-ons/destroy/' . $data->Addons_id . '\';">
                <i class="fas fa-trash-alt fa-xs"></i>
                <span class="absolute left-1/2 transform -translate-x-1/2 bottom-full mb-1 px-2 py-1 text-xs text-white bg-gray-800 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-in-out">Delete</span>
                </button>
                <button class="relative bg-green-500 hover:bg-green-600 active:bg-green-700 text-white py-2 px-4 rounded-md focus:outline-none transition duration-150 ease-in-out group">
                    <i class="fas fa-toggle-on fa-xs"></i>
                    <span class="absolute left-1/2 transform -translate-x-1/2 bottom-full mb-1 px-2 py-1 text-xs text-white bg-gray-800 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-in-out">Active</span>
                </button>
              </td>
            </tr>';
        }
        return response()->json(['html' => $output]);
    }
}
