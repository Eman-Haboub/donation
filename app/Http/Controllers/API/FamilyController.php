<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Family;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FamilyController extends Controller
{
    // عرض كل الأسر
    public function index()
    {
        $families = Family::all();
        return response()->json($families);
    }

    // عرض أسرة واحدة بالتفصيل
    public function show($id)
    {
        $family = Family::with('needs', 'donations')->find($id);

        if (!$family) {
            return response()->json(['message' => 'Family not found'], 404);
        }

        return response()->json($family);
    }

    // إضافة أسرة جديدة (Admin + الأسرة نفسها)
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->role != 'admin' && $user->role != 'family') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $validator = Validator::make($request->all(), [
            'alias' => 'required|string',
            'public_region' => 'required|string',
            'information' => 'required|string',
            'members_count' => 'required|integer',
            'goal' => 'required|integer',
            'real_name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'nullable|string',
            'income' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $family = Family::create(array_merge($request->all(), [
            'user_id' => $user->id
        ]));

        return response()->json(['message' => 'Family created successfully', 'family' => $family], 201);
    }

    // تعديل أسرة (Admin فقط)
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $family = Family::find($id);
        if (!$family) {
            return response()->json(['message' => 'Family not found'], 404);
        }

        $family->update($request->all());
        return response()->json(['message' => 'Family updated successfully', 'family' => $family]);
    }

    // حذف أسرة (Admin فقط)
    public function destroy($id)
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $family = Family::find($id);
        if (!$family) {
            return response()->json(['message' => 'Family not found'], 404);
        }

        $family->delete();
        return response()->json(['message' => 'Family deleted successfully']);
    }
}
