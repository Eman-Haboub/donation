<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    /**
     * عرض المحفظة الرئيسية (الرصيد + العمليات)
     */
    public function index()
    {
        $user = Auth::user();

        // الحصول على محفظة المستخدم أو إنشاء واحدة جديدة إذا لم تكن موجودة
        $wallet = Wallet::firstOrCreate(['user_id' => $user->id], ['balance' => 0]);

        // جلب آخر العمليات
        $transactions = $wallet->transactions()->latest()->get();

        return view('wallet.index', compact('wallet', 'transactions'));
    }

    /**
     * إظهار فورم الإيداع
     */
    public function depositForm()
    {
        return view('wallet.deposit');
    }

    /**
     * تنفيذ عملية الإيداع
     */
    public function deposit(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $wallet = Wallet::firstOrCreate(['user_id' => Auth::id()]);

        $wallet->balance += $request->amount;
        $wallet->save();

        $wallet->transactions()->create([
            'type' => 'deposit',
            'amount' => $request->amount,
            'description' => 'Wallet deposit',
        ]);

        return redirect()->route('wallet.index')->with('success', 'Balance added successfully!');
    }

    /**
     * إظهار فورم السحب
     */
    public function withdrawForm()
    {
        return view('wallet.withdraw');
    }

    /**
     * تنفيذ عملية السحب أو التحويل
     */
 public function withdraw(Request $request)
{
    $request->validate([
        'amount' => 'required|numeric|min:1',
        'family_id' => 'nullable|integer|exists:families,id',
    ]);

    $wallet = Wallet::where('user_id', Auth::id())->firstOrFail();

    if ($wallet->balance < $request->amount) {
        return back()->with('error', 'Insufficient balance!');
    }

    // إذا تم تحديد أسرة، فالمعاملة هي تبرع
    if ($request->family_id) {
        $familyWallet = Wallet::firstOrCreate(
            ['user_id' => null, 'id' => null, 'family_id' => $request->family_id],
            ['balance' => 0]
        );

        // خصم من محفظة المتبرع
        $wallet->balance -= $request->amount;
        $wallet->save();

        // إضافة إلى محفظة الأسرة
        $familyWallet->balance += $request->amount;
        $familyWallet->save();

        // تسجيل العمليات في كل محفظة
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

        return redirect()->route('wallet.index')->with('success', 'Donation sent successfully to family!');
    }

    // في حال كانت العملية سحب فقط
    $wallet->balance -= $request->amount;
    $wallet->save();

    $wallet->transactions()->create([
        'type' => 'withdraw',
        'amount' => $request->amount,
        'description' => 'Balance withdrawal',
    ]);

    return redirect()->route('wallet.index')->with('success', 'Withdrawal completed successfully!');
}


}
