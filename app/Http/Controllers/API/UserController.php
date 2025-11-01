<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function register(Request $request) { /* ... */ }
    public function login(Request $request) { /* ... */ }
    public function logout(Request $request) { /* ... */ }
    public function donorDonations($id) { /* ... */ }
}
