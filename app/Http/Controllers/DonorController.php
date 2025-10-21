<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonorController extends Controller
{
    public function show($id)
    {
        $donor = \App\Models\User::where('id', $id)->where('role', 'donor')->firstOrFail();
        return view('donor.show', compact('donor'));
    }
}
