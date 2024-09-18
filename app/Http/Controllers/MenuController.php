<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\invMenuCate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
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
    $MenuCate = invMenuCate::all();

    // Get sorting parameters or default to 'Menu_id' and 'asc'
    $sortColumn = $request->input('sortColumn', 'Menu_id');
    $sortOrder = $request->input('sortOrder', 'asc');

    // Validate sort column and order
    $validColumns = ['Menu_name_eng', 'Menu_name_kh', 'Menu_id', 'Cate_Khname'];
    $sortColumn = in_array($sortColumn, $validColumns) ? $sortColumn : 'Menu_id';
    $sortOrder = $sortOrder === 'desc' ? 'desc' : 'asc';

    // Get search parameters
    $searchTerm = $request->input('search', '');

    // Build the query
    $query = Menu::with('menuCategory')
        ->where(function ($query) use ($searchTerm) {
            $query->where('Menu_name_eng', 'like', "%{$searchTerm}%")
                ->orWhere('Menu_name_kh', 'like', "%{$searchTerm}%")
                ->orWhereHas('menuCategory', function ($query) use ($searchTerm) {
                    $query->where('Cate_Khname', 'like', "%{$searchTerm}%");
                });
        });

    // Apply sorting based on the column
    if ($sortColumn === 'Cate_Khname') {
        $query->join('menu_categories', 'menus.category_id', '=', 'menu_categories.id')
            ->orderBy('menu_categories.Cate_Khname', $sortOrder);
    } else {
        $query->orderBy($sortColumn, $sortOrder);
    }

    // Paginate results
    $menus = $query->paginate(8); // Adjust pagination as needed

    return view('menu', compact('menus', 'MenuCate', 'sortColumn', 'sortOrder', 'searchTerm'));
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
            $menu = Menu::find($id);
            if (!$menu) {
                return response()->json(['success' => false, 'message' => 'menu not found'], 404);
            }
            $newStatus = $request->input('status');
            $menu->status = $newStatus;
            $menu->save();
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
            'Menu_name_eng' => 'required|string|max:255',
            'Menu_name_kh' => 'nullable|string|max:255',
            'Menu_Cate_id' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('items', 'public');
            $validatedData['image'] = $imagePath;
        }

        Menu::create($validatedData);

        // Redirect or return response
        return redirect()->back()->with('success', 'menu added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$Menu_id)
    {
        $validatedData = $request->validate([
            'Menu_name_eng' => 'required|string|max:255',
            'Menu_name_kh' => 'required|string|max:255',
            'Menu_Cate_id' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'Material_Khname.required' => 'Please input Supplier Name',
            'Material_Engname.required' => 'Please input Supplier Contact',
            'Menu_Cate_id.required' => 'Please input Supplier Address',
        ]);
    
        // Find the supplier by ID
        $menus = Menu::find($Menu_id);
 
    
        // Update the supplier data
        $menus->Menu_name_eng = $validatedData['Menu_name_eng'];
        $menus->Menu_name_kh = $validatedData['Menu_name_kh'];
        $menus->Menu_Cate_id = $validatedData['Menu_Cate_id'];
    // Handle the image upload
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($menus->image) {
            Storage::disk('public')->delete($menus->image);
        }

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('materials', $imageName, 'public');
        $menus->image = $imagePath;
    }
        

    
        // Save the changes
        $menus->save();
    
        return redirect('/menu')->with('flash_message', 'Menu Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function destroy( $Menu_id)
    {
        Menu::destroy($Menu_id);
        return redirect('menu')->with('flash_message', 'menus deleted!');
    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $suppliers = Menu::where('Menu_name_eng', 'LIKE', "%{$searchTerm}%")->paginate(8); 

        $output = '';
        foreach ($suppliers as $index => $data) {
            $rowClass = ($index % 2 === 0) ? 'bg-zinc-200' : 'bg-zinc-300';
            $borderClass = ($index === 0) ? 'border-t-4' : '';
        
            $output .= '
            <tr class="' . $rowClass . ' text-base ' . $borderClass . ' text-center border-white">
              <td class="py-3 px-4 border border-white">' . ($data->Menu_id ?? 'null') . '</td>
              <td class="py-3 px-4 border border-white">' . ($data->Menu_name_eng ?? 'null') . '</td>
              <td class="py-3 px-4 border border-white">' . ($data->Menu_name_kh ?? 'null') . '</td>
              <td class="py-3 px-4 border border-white">' . ($data->menuCategory->Cate_Khname ?? 'null' ) . '</td>
              <td class="flex items-center justify-center py-3 px-4 border border-white">' . ( $data->image ?? 'null') . '</td>
              <td class="py-3 border border-white">
                <button class="relative bg-blue-500 hover:bg-blue-600 active:bg-blue-700 text-white py-2 px-4 rounded-md focus:outline-none transition duration-150 ease-in-out group" onclick="openEditPopup(' . $data->Sup_id . ', \'' . $data->Sup_name . '\', \'' . $data->Sup_contact . '\', \'' . $data->Sup_address . '\')">
                  <i class="fas fa-edit fa-xs"></i>
                  <span class="absolute left-1/2 transform -translate-x-1/2 bottom-full mb-1 px-2 py-1 text-xs text-white bg-gray-800 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-in-out">Edit</span>
                </button>
                <button class="relative bg-red-500 hover:bg-red-600 active:bg-red-700 text-white py-2 px-4 rounded-md focus:outline-none transition duration-150 ease-in-out group" 
                        onclick="if(confirm(\'Are you sure you want to delete?\')) window.location.href=\'menus/destroy/' . $data->Menu_id . '\';">
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
