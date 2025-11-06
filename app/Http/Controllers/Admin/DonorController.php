<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class DonorController extends Controller
{
    public function index() {
        $donors = User::where('role', 'donor')->paginate(10);
        return view('admin.donors.index', compact('donors'));
    }

     public function create()
    {
        return view('admin.donors.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $request->merge(['role' => 'donor']);

        $x = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:donor'],
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'donor',
        ]);

        $user->assignRole($request->role);


        return redirect()->route('admin.donors.index')->with('success','Donor created successfully!');
    }

     public function edit(string $id)
    {
        $donor = User::where('id', $id)->where('role', 'donor')->firstOrFail();
        return view('admin.donors.create', compact('donor'));
    }



    public function update(Request $request, $id)
{
    $donor = User::where('id', $id)->where('role', 'donor')->firstOrFail();

    $request->merge(['role' => 'donor']);

    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255',  Rule::unique('users')->ignore($donor->id),],
        'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        'role' => ['required', 'in:donor'],
    ]);

    $updateData = [
        'name' => $request->name,
        'email' => $request->email,
        'role' => 'donor',
    ];

    if ($request->filled('password')) {
        $updateData['password'] = Hash::make($request->password);
    }

    $donor->update($updateData);

    $donor->syncRoles([$request->role]);

    return redirect()->route('admin.donors.index')->with('success', 'Donor updated successfully!');
}


    public function destroy(User $donor) {
        $donor->delete();
        return redirect()->route('admin.donors.index')->with('success', 'Donor deleted successfully.');
    }
}
