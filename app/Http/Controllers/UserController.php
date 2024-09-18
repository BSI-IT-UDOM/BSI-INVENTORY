<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(Request $request, $userId)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'U_name' => 'required|string|max:255',
            'U_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Find the user by ID
        $user = User::find($userId);
    
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
    
        // Update only the provided fields
        $user->U_name = $validatedData['U_name'];
    
        // Handle photo upload
        if ($request->hasFile('U_photo')) {
            $photo = $request->file('U_photo');
            $photoPath = $photo->store('user_photos', 'public'); // Store under 'public/storage/user_photos'
            $user->U_photo = $photoPath;
        }
    
        // Save the updated user
        $user->save();
    
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
    

}
