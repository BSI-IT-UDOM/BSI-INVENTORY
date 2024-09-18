<?php

namespace App\Http\Controllers;

use App\Models\Addon;
use App\Models\UOM;
use App\Models\User;
use App\Models\Material;
use App\Models\Module;
use App\Models\InvRole;
use App\Models\Invshop;
use App\Models\Setting;
use App\Models\Currency;
use App\Models\Menu;
use App\Models\SysModule;
use App\Models\ExpenseCate;
use App\Models\InvLocation;
use App\Models\IngredientRe;
use App\Models\MenuGroup;
use Illuminate\Http\Request;
use App\Models\IngredientQty;
use App\Models\MaterialCategory;
use App\Models\invMenuCate;
use App\Models\MenuIngredients;
use App\Http\Controllers\Controller;
use App\Models\InvOwner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
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
        $materialCate = MaterialCategory::all();
        $menuCate = invMenuCate::all();
        $user = User::all();
        $uom = UOM::all();
        $material = Material::all();
        $menuIngredients = MenuIngredients::all()->groupBy('Menu_id');
        $invMenu = Menu::paginate(12);
        $shop = Invshop::paginate(2);
        $shop_se =Invshop::all();
        $role = InvRole::all();
        $module = SysModule::all();
        $moduleInf = Module::all();
        $location = InvLocation::all();
        $group = MenuGroup::all();
        $expense = ExpenseCate::all();
        $ingredientQty = IngredientQty::all();
        $currency = Currency::all();

        return view('setting', compact('material','materialCate','menuCate','user','invMenu','shop','role','module','moduleInf','uom','shop_se','location','group','expense','menuIngredients','ingredientQty','currency')); 

    }

    public function shop ()
    {
        $shop = Invshop::all();
        $shop = Invshop::paginate(2);
        $shop_se =Invshop::all();
        return view('setting.shop', compact('shop','shop_se'));
    }
    public function ShopOperation(Request $request)
    {
        $shop = Auth::user()->invShop->O_id;
        // Validate the input data
        $validatedData = $request->validate([
            'S_name' => ['required', 'string', 'max:255'],
            'S_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the file upload if a logo is provided
        $logoPath = null;
        if ($request->hasFile('S_logo') && $request->file('S_logo')->isValid()) {
            $logo = $request->file('S_logo');
            $logoPath = $logo->store('logos', 'public'); // Store under 'public/storage/logos'
        }
        // Create the shop record in the database
      
        Invshop::create([
            'S_name' => $validatedData['S_name'],
            'O_id' => $shop, // Assuming this is intentionally left empty
            'S_logo' => $logoPath,
        ]);
    
        // Redirect or return a response
        return redirect()->back()->with('success', 'Shop created successfully!');
    }

    public function location ()
    {
        $location = InvLocation::all();
        $location = InvLocation::paginate(2);
        return view('setting.location', compact('location', 'location'));
    }

    public function upddatelocation(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'L_address' => ['required', 'string', 'max:255'],
            'S_id' => 'required|integer',
        ]);
    
        // Create the location record in the database
        InvLocation::create([
            'L_address' => $validatedData['L_address'],
            'L_name' => '', // Assuming this is optional or default
            'L_contact' => '', // Assuming this is optional or default
            'S_id' => $validatedData['S_id'], // Removed extra '$'
        ]);
    
        // Redirect or return a response
        return redirect()->back()->with('success', 'Location created successfully!');
    }
    
    public function createUser(Request $request) {
        $data = $request->validate([
            'U_name' => ['required', 'string', 'max:255'],
            'sys_name' => ['required', 'string', 'max:255'],
            'U_contact' => ['required', 'string', 'max:255'],
            'R_id' => 'required|integer',
            'S_id' => 'required|integer',
            'L_id' => 'required|integer',
            'password' => ['required', 'string', 'min:8'], 
            'U_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
    
        $photoPath = null;
        if ($request->hasFile('U_photo')) {
            $photo = $request->file('U_photo');
            if ($photo->isValid()) {
                $photoPath = $photo->store('user_photos', 'public');
            };
        
        // Create the user
        User::create([
            'U_name' => $data['U_name'],
            'R_id' => $data['R_id'],
            'U_contact' => $data['U_contact'],
            'sys_name' => $data['sys_name'],
            'password' => Hash::make($data['password']), // Hash and save the password
            'S_id' => $data['S_id'],
            'L_id' => $data['L_id'],
            'U_photo' =>$photoPath, // This can now be null if no file is uploaded
            'status' => 'Active', // Set the status as needed
        ]);
    }
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'User created successfully!');
    }
    
    public function viewUser(Request $request) {
        $user = User::all();
        $role = InvRole::all();
        $location = InvLocation::all();
        $shop_se =Invshop::all();
        
        
        return view('setting.user', compact('user', 'role', 'location', 'shop_se'));
    }

    
    public function category(Request $request){
        // Validate the input data
        $validatedData = $request->validate([
            'Material_Cate_Khname' => ['required', 'string', 'max:255'],
            'Material_Cate_Engname' => ['nullable', 'string', 'max:255'], // Add validation rule for English name
        ]);
    
        // Create the item category record in the database
        MaterialCategory::create([
            'Material_Cate_Khname' => $validatedData['Material_Cate_Khname'],
            'Material_Cate_Engname' => $request->input('Material_Cate_Engname'), // Use request input directly
            'Material_Cate_type' => '',
            'status' => 'Active',
        ]);
    
        // Redirect or return a response
        return redirect()->back()->with('success', 'Category created successfully!');
    }
    
    public function menu_cate(Request $request){
        $validatedData = $request->validate([
            'Cate_Khname' => ['required', 'string', 'max:255'],
            'Cate_Engname' => ['required', 'string', 'max:255'], // Add validation rule for English name
            'MenuGr_id' => 'required|integer',
        ]);
        
        // Create the item category record in the database
        invMenuCate::create([
            'Cate_Khname' => $validatedData['Cate_Khname'],
            'Cate_Engname' =>  $validatedData['Cate_Engname'], // Use request input directly
            'MenuGr_id' => $validatedData['MenuGr_id'],
            'status' => 'Active',
        ]);
    
        // Redirect or return a response
        return redirect()->back()->with('success', 'Category created successfully!');
    }
    public function expense_cate(Request $request){
        $validatedData = $request->validate([
            'IEC_Khname' => ['required', 'string', 'max:255'],
            'IEC_Engname' => ['required', 'string', 'max:255'], // Add validation rule for English name
      
        ]);
        
        // Create the item category record in the database
        ExpenseCate::create([
            'IEC_Khname' => $validatedData['IEC_Khname'],
            'IEC_Engname' =>  $validatedData['IEC_Engname'], // Use request input directly
            'status' => 'Active',
        ]);
    
        // Redirect or return a response
        return redirect()->back()->with('success', 'Category created successfully!');
    }

    public function updateIngredients(Request $request, $IPI_id)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'IIQ_id' => 'required|array',
            'IIQ_id.*' => 'required|integer', 
        ]);
    
        // Find all products by Pro_id
        $menu = IngredientRe::where('Menu_id', $request->Menu_id)->get();
    
        // Check if any products exist
        if ($menu->isEmpty()) {
            return redirect()->back()->with('error', 'No menu found with this ID.');
        }
    
        // Loop through each IIQ_id and update the corresponding products
        foreach ($menu as $key => $product) {
            // Check if the key exists in the IIQ_id array to avoid errors
            if (isset($validatedData['IIQ_id'][$key])) {
                $product->IIQ_id = $validatedData['IIQ_id'][$key];
                $product->save();
            }
        }
        return redirect()->back()->with('success', 'Menu updated successfully!');
    }
        public function toggleStatus(Request $request, $id)
    {
        $loggedInUserId = auth()->id();
        if ($loggedInUserId == $id) {
            return response()->json(['success' => false, 'message' => 'You cannot change your own status.'], 403);
        }
    
        $user = User::findOrFail($id);
        $user->status = $request->status;
        $user->save();
    
        return response()->json(['success' => true]);
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $S_id)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'S_name' => 'required|string|max:255',
            'S_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $shop = Invshop::findOrFail($S_id);
        $shop->S_name = $validatedData['S_name'];
        if ($request->hasFile('S_logo') && $request->file('S_logo')->isValid()) {
            // Delete the old image if it exists
            if ($shop->S_logo && Storage::disk('public')->exists($shop->S_logo)) {
                Storage::disk('public')->delete($shop->S_logo);
            }  
            $s_logo = $request->file('S_logo');
            $imagePath = $s_logo->store('logos', 'public');
            $shop->S_logo = $imagePath;
        }    
        // Save the updated shop record
        $shop->save();
    
        // Redirect or return a response
        return redirect()->back()->with('success', 'Shop updated successfully!');
    } 
    public function updateUser(Request $request, $U_id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'U_name' => 'required|string|max:255',
            'U_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'R_id' => 'required|integer',
            'sys_name' => 'required|string|max:255',
            'U_contact' => 'required|string|max:255',
            'password' => ['required', 'string', 'min:8'],
            'newpassword' => 'nullable|string|min:8', 
        ]);
    
        // Find the user record by ID
        $user = User::findOrFail($U_id);
        
     
        // Update user details
        $user->U_name = $validatedData['U_name'];
        $user->R_id = $validatedData['R_id'];
        $user->sys_name = $validatedData['sys_name'];
        $user->U_contact = $validatedData['U_contact'];
    
        // Handle password update
        if ($request->filled('newpassword')) {
            $user->password = bcrypt($request->input('newpassword'));
        }
    
        // Handle the image upload if a new image is provided
        if ($request->hasFile('U_photo') && $request->file('U_photo')->isValid()) {
            // Delete the old image if it exists
            if ($user->U_photo && Storage::disk('public')->exists($user->U_photo)) {
                Storage::disk('public')->delete($user->U_photo);
            }
    
            // Store the new image and update the U_photo field
            $photo = $request->file('U_photo');
            $imagePath = $photo->store('profile_pics', 'public');
            $user->U_photo = $imagePath;
        }
    
        // Save the updated user record
        $user->save();
    
        // Redirect or return a response
        return redirect()->back()->with('success', 'User updated successfully!');
    }
    
    public function createIng(Request $request){
        $validatedData = $request->validate([
            'Qty' => 'required|integer',
            'Material_id' => 'required|integer',
            'UOM_id' =>'required|integer',
            'IIQ_name' => ['required', 'string', 'max:255'],
      
        ]);        
        // Create the item category record in the database
        IngredientQty::create([
            'Qty' => $validatedData['Qty'],
            'Material_id' =>  $validatedData['Material_id'], 
            'UOM_id' => $validatedData['UOM_id'],
            'IIQ_name' =>  $validatedData['IIQ_name'], 
            'status' => 'Active',
        ]);   
        // Redirect or return a response
        return redirect()->back()->with('success', 'Category created successfully!');
    }

    public function addIng(Request $request){
        $validatedData = $request->validate([
            'Menu_id' => 'required|integer',
            'IIQ_id' => 'required|integer',
        ]);        
        // Create the item category record in the database
        IngredientRe::create([
            'Menu_id' => $validatedData['Menu_id'],
            'IIQ_id' =>  $validatedData['IIQ_id'], 
        ]);   
        // Redirect or return a response
        return redirect()->back()->with('success', 'Ingredient created successfully!');
    }

    public function uom(Request $request){
        $uom = UOM::all();
        return view('setting.uom', compact('uom'));
    }
    
    public function currency(Request $request){
        $currency = Currency::all();
        return view('setting.currency', compact('currency'));
    }


    public function payment (Request $request){
        return view('setting.payment-method');
    }

    public function size (Request $request){
        return view('setting.size');
    }

    public function module (Request $request){
        return view('setting.module');
    }
    
    public function addon (){
        $uom =UOM::all();
        $Addons = Addon::with('uom')->paginate(8); 
        return view('setting.add-on', compact('Addons','uom'));
    }

    public function createAddon(Request $request)
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
    
    public function Addonupdate(Request $request,$Addons_id)
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
    
    public function Addondestroy($Addons_id)
    {
        Addon::destroy($Addons_id);
        return redirect('add-on')->with('flash_message', 'Addon deleted!');
    }
    public function Addonsearch(Request $request)
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
    
    public function AddontoggleStatus(Request $request, $id)
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
    
    public function menu_group (Request $request){
        $groups = MenuGroup::all();
        return view('setting.menu-group', compact('groups'));
    }

    public function menuCat (Request $request){
        $group = MenuGroup::all();
        $menu_category = invMenuCate::all();
        return view('setting.menuCat', compact('menu_category', 'group'));
    }

    public function owner (Request $request){
        $invOwners = InvOwner::all();
        return view('setting.owner', compact('invOwners'));
    }

    public function role(){
        $roles = InvRole::all();
        return view('setting.role', compact('roles'));
    }


    public function materialCat (Request $request){
        $materialcat = MaterialCategory::all();
        return view('setting.materialCat', compact('materialcat'));
    }

    public function expenseCat (Request $request){
        $expenseCat = ExpenseCate::all();
        return view('setting.expenseCat', compact('expenseCat'));
    }

    public function login_logs (Request $request){
        return view('setting.login-logs');
    }

    public function operation_logs (Request $request){
        return view('setting.operation-logs');
    }

    public function material_group (Request $request){
        return view('setting.material-group');
    }

    public function ingredient ()
    {
        $menuIngredients = MenuIngredients::all()->groupBy('Menu_id');
        $invMenu = Menu::paginate(12);
        $material = Material::all();
        $uom = UOM::all();
        $ingredientQty = IngredientQty::all();

        return view('setting.menu', compact('menuIngredients', 'invMenu', 'material', 'uom', 'ingredientQty'));
    }
    
    //Operation on Menu Ingredient
    public function IngredientOperation (Request $request){
        $menuIngredients = MenuIngredients::all()->groupBy('Menu_id');
        $invMenu = Menu::paginate(12);
        $material = Material::all();
        $uom = UOM::all();
        $ingredientQty = IngredientQty::all();

        return view('setting.menu', compact('menuIngredients', 'invMenu', 'material', 'uom', 'ingredientQty'));
    }

}
