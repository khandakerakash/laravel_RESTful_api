<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\ApiController;
use App\Mail\CreateUserEmail;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return $this->showAll($users, 200);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [

            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:6|confirmed'
        ];

        $this->validate($request, $rules);

        $user = User::create(

            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'verified' => User::USER_UNVERIFIED,
                'verification_token' => User::generateVerifiedToken(),
                'admin' => User::REGULAR_USER
            ]
        );

        Mail::to($user)->send(new CreateUserEmail($user));

        return $this->showOne($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
//        $rules = [
//
//            'email' => 'email|unique:users,email.'.$user->id,
//            'password' => 'min:6|max:6|confirmed'
//
//        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return $this->showOne($user, 204);
    }

    public function verify($token)
    {
        $user = User::where('verification_token', $token)->get()->first();

        $user->verified = User::USER_VERIFIED;
        $user->verification_token = null;
        $user->save();
        return $this->showOne($user, 200);
    }
}
