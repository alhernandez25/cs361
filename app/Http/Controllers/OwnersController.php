<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OwnersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('owners.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('owner-sign-up');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::insert('insert into owners(email, password) values(?,?)', [
            $request->get("email"), $request->get("password")]);

        $owner_id = DB::getPdo()->lastInsertId();

        DB::insert('insert into restaurants(owner_id, name, address_line_1, locality, administrative_area_level_1,
                  country, postal_code, latitude, longitude) values(?,?,?,?,?,?,?,?,?)', [
            $owner_id, $request->get("name"), $request->get("address_line_1"), $request->get("locality"), $request->get("administrative_area_level_1"),
            $request->get("country"), $request->get("postal_code"), $request->get("latitude"), $request->get("longitude")]);

        return view('owners.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
