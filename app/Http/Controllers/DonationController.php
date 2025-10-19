<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Family;
use App\Models\Donation;

class DonationController extends Controller
{
    public function create($id)
    {
        $family = Family::findOrFail($id);
        $families = Family::all();
        return view('donations.create', compact('family', 'families'));
    }

    public function quick()
    {
        $families = Family::all();
        return view('donations.create', ['families' => $families]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'family_id' => 'required|exists:families,id',
            'amount' => 'required|numeric|min:1',
            'currency' => 'required|string',
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'required|email',
            'payment_method' => 'required|string'
        ]);

        // إنشاء سجل تبرع مبدئي
        $donation = Donation::create([
            'family_id' => $request->family_id,
            'amount' => $request->amount,
            'currency' => $request->currency,
            'donor_name' => $request->donor_name,
            'donor_email' => $request->donor_email,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
        ]);

        // ✅ التوجيه حسب طريقة الدفع
        if ($request->payment_method === 'paypal') {
            return redirect()->route('paypal.checkout', $donation->id);
        }

        if ($request->payment_method === 'bank_transfer') {
            // تحويل بسيط: عرض صفحة تحتوي على بيانات البنك
            return redirect()->route('donations.bank', $donation->id);
        }

        if ($request->payment_method === 'credit_card') {
            // يمكن دمج بوابة Stripe لاحقًا
            return redirect()->route('donations.card', $donation->id);
        }

        return redirect()->route('families.index')->with('error', 'Invalid payment method selected.');
    }
}
