<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $currentUser = $request->user();

        if ($currentUser->id !== $user->id && $currentUser->role < 3) {
            return redirect()->route('home')
                             ->with(['danger' => __('Access denied')]);
        }

        return view('Users.edit', [
            'title' => __( 'Edit user\'s profile'),
            'user' => $user,
        ]);
    }

    public function editMyProfile(Request $request)
    {
        $user = $request->user();
            
        return view('Users.edit', [
            'title' => __( 'Edit my profile'),
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $currentUser = $request->user();

        if ($currentUser->id !== $user->id && $currentUser->role < 3) {
            return redirect()->route('home')
                             ->with(['danger' => __('Access denied')]);
        }

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'nickname' => 'required|string|min:2|max:255|unique:users,nickname,' . $user->id,
        ]);

        $user->name = $request->input('name');
        $user->nickname = $request->input('nickname');
        $user->email = $request->input('email');

        $user->update();

        return redirect()->route('home')
                         ->with(['success' => __('Data updated successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
