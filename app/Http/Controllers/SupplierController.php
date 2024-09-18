<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupplierController extends Controller
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
        $supplier = Supplier::where('status', 'Active')->paginate(8);
        return view('supplier', compact('supplier'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function toggleStatus(Request $request, $id)
    {
        $material = Supplier::find($id);
        if (!$material) {
            return response()->json(['success' => false, 'message' => 'Material not found'], 404);
        }
        $newStatus = $request->input('status');
        $material->status = $newStatus;
        $material->save();
        return response()->json(['success' => true, 'status' => $newStatus]);
    }
    
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
            'Sup_name' => 'required|string|max:255',
            'Sup_contact' => 'required|string|max:255',
            'Sup_address' => 'required|string',
        ]);

        $supplier = new Supplier();
        $supplier->Sup_name = $validatedData['Sup_name'];
        $supplier->Sup_contact = $validatedData['Sup_contact'];
        $supplier->Sup_address = $validatedData['Sup_address'];
        $supplier->save();

        return redirect()->back()->with('success', 'Supplier added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Sup_id)
    {

        // Validate the request data
        $validatedData = $request->validate([
            'Sup_name' => 'required|string|max:255',
            'Sup_contact' => 'required|string|max:255',
            'Sup_address' => 'required|string',
        ], [
            'Sup_name.required' => 'Please input Supplier Name',
            'Sup_contact.required' => 'Please input Supplier Contact',
            'Sup_address.required' => 'Please input Supplier Address',
        ]);
    
        // Find the supplier by ID
        $supplier = Supplier::find($Sup_id);
 
    
        // Update the supplier data
        $supplier->Sup_name = $validatedData['Sup_name'];
        $supplier->Sup_contact = $validatedData['Sup_contact'];
        $supplier->Sup_address = $validatedData['Sup_address'];
    
        // Save the changes
        $supplier->save();
    
        return redirect('/supplier')->with('flash_message', 'Supplier Updated Successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function destroy($Sup_id)
    {

        Supplier::destroy($Sup_id);
        return redirect('supplier')->with('flash_message', 'suppliers deleted!');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $suppliers = Supplier::where('Sup_name', 'LIKE', "%{$searchTerm}%")->get();

        $output = '';
        foreach ($suppliers as $index => $data) {
            $rowClass = ($index % 2 === 0) ? 'bg-zinc-200' : 'bg-zinc-300';
            $borderClass = ($index === 0) ? 'border-t-4' : '';
        
            $output .= '
            <tr class="' . $rowClass . ' text-base ' . $borderClass . ' text-center border-white">
              <td class="py-3 px-4 border border-white">' . ($data->Sup_id ?? 'null') . '</td>
              <td class="py-3 px-4 border border-white">' . ($data->Sup_name ?? 'null') . '</td>
              <td class="py-3 px-4 border border-white">' . ($data->Sup_contact ?? 'null') . '</td>
              <td class="py-3 px-4 border border-white">' . ($data->Sup_address ?? 'null') . '</td>
              <td class="py-3 border border-white">
                <button class="relative bg-blue-500 hover:bg-blue-600 active:bg-blue-700 text-white py-2 px-4 rounded-md focus:outline-none transition duration-150 ease-in-out group" onclick="openEditPopup(' . $data->Sup_id . ', \'' . $data->Sup_name . '\', \'' . $data->Sup_contact . '\', \'' . $data->Sup_address . '\')">
                  <i class="fas fa-edit fa-xs"></i>
                  <span class="absolute left-1/2 transform -translate-x-1/2 bottom-full mb-1 px-2 py-1 text-xs text-white bg-gray-800 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-in-out">Edit</span>
                </button>
                <button class="relative bg-red-500 hover:bg-red-600 active:bg-red-700 text-white py-2 px-4 rounded-md focus:outline-none transition duration-150 ease-in-out group" onclick="if(confirm(\'Are you sure you want to delete?\')) { window.location.href=\'suppliers/destroy/' . $data->Sup_id . '\'; }">
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
