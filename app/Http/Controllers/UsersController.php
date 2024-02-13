<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sign-up');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::insert('insert into users(username, email, password, address_line_1, locality, administrative_area_level_1,
                  country, postal_code, latitude, longitude) values(?,?,?,?,?,?,?,?,?,?)', [
                    $request->get("username"), $request->get("email"), $request->get("password"),
                    $request->get("address_line_1"), $request->get("locality"), $request->get("administrative_area_level_1"),
                    $request->get("country"), $request->get("postal_code"), $request->get("latitude"), $request->get("longitude")]);
        return view('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
