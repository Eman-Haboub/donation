<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Family;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DonationController extends Controller
{
    // إرسال تبرع
    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->role != 'donor') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $validator = Validator::make($request->all(), [
            'family_id' => 'required|exists:families,id',
            'amount' => 'required|numeric|min:1',
            'currency' => 'nullable|string',
            'payment_method' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $donation = Donation::create([
            'family_id' => $request->family_id,
            'amount' => $request->amount,
            'currency' => $request->currency ?? 'USD',
            'donor_name' => $user->name,
            'donor_email' => $user->email,
            'payment_method' => $request->payment_method ?? 'paypal',
            'status' => 'completed', // يمكنك تغييرها حسب عملية الدفع الفعلية
        ]);

        // تحديث المحفظة الخاصة بالأسرة
        $family = Family::find($request->family_id);
        $family->donated += $request->amount;
        $family->save();

        return response()->json(['message' => 'Donation successful', 'donation' => $donation], 201);
    }

    // عرض التبرعات لكل أسرة (Admin فقط)
    public function familyDonations($family_id)
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $family = Family::find($family_id);
        if (!$family) {
            return response()->json(['message' => 'Family not found'], 404);
        }

        $donations = Donation::where('family_id', $family_id)->get();

        return response()->json(['family' => $family->alias, 'donations' => $donations]);
    }
}
