<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Material;
use Illuminate\Http\Request;
use App\Models\MaterialCategory;
use App\Http\Controllers\Controller;

class MaterialController extends Controller
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
    public function index(Request $request)
{
    // Retrieve sorting parameters from the request or set default values
    $sortColumn = $request->input('sortColumn', 'Item_id'); // Default sorting column
    $sortOrder = $request->input('sortOrder', 'asc'); // Default sorting order

    // Validate column names to prevent SQL injection
    $validColumns = ['Material_id', 'Material_Khname', 'Material_Engname', 'Material_Category', 'Expiry_date'];
    if (!in_array($sortColumn, $validColumns)) {
        $sortColumn = 'Material_id'; // Default column if invalid
    }

    // Fetch categories
    $categories = MaterialCategory::all();

    // Fetch items with sorting
    $material = Material::with('materialCategory')
        ->orderBy($sortColumn, $sortOrder)
        ->paginate(8);

    // Pass variables to the view
    return view('material', compact('material', 'categories', 'sortColumn', 'sortOrder'));
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
// Toggle status method
    public function toggleStatus(Request $request, $id)
    {
        $material = Material::find($id);
        if (!$material) {
            return response()->json(['success' => false, 'message' => 'Material not found'], 404);
        }
        $newStatus = $request->input('status');
        $material->status = $newStatus;
        $material->save();
        return response()->json(['success' => true, 'status' => $newStatus]);
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
            'Material_Khname' => 'required|string|max:255',
            'Material_Engname' => 'nullable|string|max:255',
            'Material_Cate_id' => 'required|integer',
            'Expiry_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('material', 'public');
            $validatedData['image'] = $imagePath;
        }

        Material::create($validatedData);

        // Redirect or return response
        return redirect()->back()->with('success', 'Material added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\Models\Items  $items
 * @return \Illuminate\Http\Response
 */
public function update(Request $request, $id)
{
    $request->validate([
        'Material_Khname' => 'required|string|max:255',
        'Material_Engname' => 'required|string|max:255',
        'Material_Cate_id' => 'required|integer',
        'Expiry_date' => 'nullable|date',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $material = Material::findOrFail($id);
    $material->Material_Khname = $request->input('Material_Khname');
    $material->Material_Engname = $request->input('Material_Engname');
    $material->Material_Cate_id = $request->input('Material_Cate_id');
    $material->Expiry_date = $request->input('Expiry_date');

    // Handle the image upload
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($material->image) {
            Storage::disk('public')->delete($material->image);
        }

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('materials', $imageName, 'public');
        $material->image = $imagePath;
    }
    $material->save();

    return redirect()->route('material')->with('success', 'Material updated successfully.');  
}

    
    
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function destroy($Material_id)
    {
        Material::destroy($Material_id);
        return redirect('material')->with('flash_message', 'material deleted!');
    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $materials = Material::where('Material_Khname', 'LIKE', "%{$searchTerm}%")->get();

        $output = '';
        foreach ($materials as $index => $data) {
            $rowClass = ($index % 2 === 0) ? 'bg-zinc-200' : 'bg-zinc-300';
            $borderClass = ($index === 0) ? 'border-t-4' : '';
        
            $output .= '
            <tr class="' . $rowClass . ' text-base ' . $borderClass . ' text-center border-white">
              <td class="py-3 px-4 border border-white">' . ($data->Material_id ?? 'null') . '</td>
              <td class="py-3 px-4 border border-white">' . ($data->Material_Khname ?? 'null') . '</td>
              <td class="py-3 px-4 border border-white">' . ($data->Material_Engname ?? 'null') . '</td>
              <td class="py-3 px-4 border border-white">' . ($data->MaterialCategory->Material_Cate_Khname ?? 'null') . '</td>
              <td class="py-3 px-4 border border-white">' . ($data->Expiry_date ?? 'null') . '</td>
              <td class="flex items-center justify-center py-3 px-4 border border-white">' . ($data->image ?? 'null') . '</td>
              <td class="py-3 border border-white">
                <button class="relative bg-blue-500 hover:bg-blue-600 active:bg-blue-700 text-white py-2 px-4 rounded-md focus:outline-none transition duration-150 ease-in-out group editButton">
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
