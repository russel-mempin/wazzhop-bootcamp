<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            "name" => ["required", "min:4", "alpha_num", "max:32", "unique:users"],
            "email" => "required|email|max:64|unique:users",
            "password" => "required|min:8|confirmed|max:64"
        ]);
        if($validator->fails()){
            return response()->json([
                'ok' => false,
                'message' => "Request didn't pass the validation!",
                'errors' => $validator->errors()
            ], 400);
        }
        $validated = $validator->validated();
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password'])
        ]);
        return response()->json([
            'ok' => true,
            'message' => "User has been created!",
            'data' => $user
        ], 400);
    }

    public function index() {
        return response()->json([
            'ok' => true, 
            'data' => User::all(), 
            'message' => 'Ready ta werk'
        ], 200);
    }

    public function update(Request $request, User $user){
        $validator = Validator::make($request->all(), [
            "name" => ["sometimes", "min:4", "alpha_num", "max:32", "unique:users"],
            "email" => "sometimes|email|max:64|unique:users",
            "password" => "sometimes|min:8|confirmed|max:64"
        ]);

        if($validator->fails()){
            return response()->json([
                'ok' => false,
                'message' => "Request didn't pass the validation!",
                'errors' => $validator->errors()
            ], 400);
        }
        $validated = $validator->validated();
        if(isset($validated['password'])){
            $validated['password'] = bcrypt($validated['password']);
        }
        $user->update($validated);
        return response()->json([
            'ok' => true,
            'data' => $user,
            'message' => 'User has been updated.'
        ]);
    }

    // $validated = $validator->safe()->only("name", "email", "password");

    public function destroy(User $user) {
        $user->delete();
        return response()->json([
            'ok' => true,
            'data' => User::all(),
            'message' => 'Our ally has fallen'
        ]);
    }
}