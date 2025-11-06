<?php
namespace App\Http\Controllers;
use App\Models\Family;
use App\Models\Wallet;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        ]);

        $donation = Donation::create([
            'family_id' => $request->family_id,
            'amount' => $request->amount,
            'currency' => $request->currency,
            'donor_name' => $request->donor_name,
            'donor_email' => $request->donor_email,
            'status' => 'pending',
        ]);

        $wallet = Wallet::where('user_id', Auth::id())->firstOrFail();

        if ($wallet->balance < $request->amount) {
            return back()->with('error', 'Insufficient balance!');
        }

        if ($request->family_id) {
        $familyWallet = Wallet::firstOrCreate(
            ['user_id' => null, 'id' => null, 'family_id' => $request->family_id],
            ['balance' => 0]
        );

        $wallet->balance -= $request->amount;
        $wallet->save();

        $familyWallet->balance += $request->amount;
        $familyWallet->save();
Family::where('id', $request->family_id)->increment('donated', $request->amount);
        $wallet->transactions()->create([
            'type' => 'donation',
            'amount' => $request->amount,
            'description' => 'Donation to family ID: ' . $request->family_id,
        ]);

        $familyWallet->transactions()->create([
            'type' => 'deposit',
            'amount' => $request->amount,
            'description' => 'Received donation from donor ID: ' . Auth::id(),
        ]);

    }



        return redirect()->back()->with('success', 'Payment has been completed successfully..');
    }
}
