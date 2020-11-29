<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\UserLog;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserShowResource;

class UserController extends Controller
{

    public function index()
    {
        $users = User::paginate();
        return UserResource::collection($users);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'document_number' => 'required',
            'phone_number' => 'required',
            'country' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'document_number' => $request->document_number,
            'phone_number' => $request->phone_number,
            'country' => $request->country
        ]);

        return new UserResource($user);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return new UserShowResource($user);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'document_number' => 'required',
            'phone_number' => 'required',
            'country' => 'required'
        ]);
        
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'document_number' => $request->document_number,
            'phone_number' => $request->phone_number,
            'country' => $request->country
        ]);

        return new UserResource($user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return new UserResource($user);
    }
}
