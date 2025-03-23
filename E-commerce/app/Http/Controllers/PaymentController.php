<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show(Payment $payment)
    {
        $payment->load('order', 'order.user');
        return view('admin.payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        return view('admin.payments.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'status' => 'required|string|in:pending,paid,failed'
        ]);

        $isUpdated = $payment->update([
            'status' => $request->status
        ]);

        if (!$isUpdated) {
            return back()->with('error', 'Payment not updated.');
        }

        return redirect()->route('admin.index')->with('success', 'Payment updated.');
    }

    public function destroy(Payment $payment)
    {
        $isDeleted = $payment->delete();

        if (!$isDeleted) {
            return back()->with('error', 'Payment not deleted.');
        }

        return redirect()->route('admin.index')->with('success', 'Payment deleted.');
    }
}
