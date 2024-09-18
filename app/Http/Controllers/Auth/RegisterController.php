<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\InvRole;
use App\Models\Invshop;
use App\Models\InvOwner;
use Illuminate\Http\Request;
use App\Models\InvLocation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // dd($data);
        return Validator::make($data, [

            'U_name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'sys_name' => ['required', 'string', 'max:255'],
            'U_contact' => ['required', 'string', 'max:255'],
            'R_id' => ['required', 'string', 'max:255'],
            'U_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            
            //inventory shop``
            'S_name' => ['required', 'string', 'max:255'],
            'S_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            //owner 
            'O_name' => ['required', 'string', 'max:255'],
            'O_email' => ['required', 'string', 'email', 'max:255'],            
            'O_contact' => ['required', 'string', 'max:255'],
            'O_address' => ['required', 'string', 'max:255'],
            //Location
            'L_name' => ['required', 'string', 'max:255'],
            'L_address' => ['required', 'string', 'max:255'],
            'L_contact' => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Handle S_logo (Shop Logo)
        $logoPath = null;
        if (isset($data['S_logo']) && $data['S_logo']->isValid()) {
            $logo = $data['S_logo'];
            $logoPath = $logo->store('logos', 'public'); // Store under 'public/storage/logos'
        }
        
        // Create InvOwner
        $owner = InvOwner::create([
            'O_name' => $data['O_name'],
            'O_email' => $data['O_email'],
            'O_contact' => $data['O_contact'],
            'O_address' => $data['O_address'],
        ]);
    
        // Create Invshop
        $invshop = Invshop::create([
            'S_name' => $data['S_name'],
            'O_id' => $owner->O_id, 
            'S_logo' => $logoPath,
        ]);
    
        // Create InvLocation
        $InvLocation = InvLocation::create([
            'S_id' => $invshop->S_id,
            'L_name' => $data['L_name'],
            'L_address' => $data['L_address'],
            'L_contact' => $data['L_contact'],
            'status' => '',
        ]);
    
        // Handle U_photo (User Photo)
        $photoPath = null;
        if (isset($data['U_photo']) && $data['U_photo']->isValid()) {
            $photo = $data['U_photo'];
            $photoPath = $photo->store('user_photos', 'public'); // Store under 'public/storage/user_photos'
        }
    
        // Create User
        $user = User::create([
            'U_name' => $data['U_name'],
            'R_id' => $data['R_id'],
            'U_contact' => $data['U_contact'],
            'sys_name' => $data['sys_name'],
            'password' => Hash::make($data['password']),
            'S_id' => $invshop->S_id,
            'L_id'=> $InvLocation->L_id,
            'U_photo' => $photoPath, // Save the photo path if available
            'status' => '',
        ]);
    
        return $user;
    }
    
    public function showRegistrationForm()
    {
        $invRole = InvRole::all(); 
        return view('auth.register', compact('invRole')); 
    }
    public function update(Request $request, $U_id)
    {
      dd('11111');
    }
    
}
