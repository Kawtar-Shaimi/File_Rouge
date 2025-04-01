<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show(Payment $payment)
    {
        try {
            $payment->load('order', 'order.client');
            return view('admin.payments.show', compact('payment'));
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while getting payment try again later.');
        }
    }

    public function edit(Payment $payment)
    {
        return view('admin.payments.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        try {
            $request->validate([
                'status' => 'required|string|in:pending,paid,failed'
            ]);

            $isUpdated = $payment->update([
                'status' => $request->status
            ]);

            if (!$isUpdated) {
                return back()->with('error', 'Payment status not updated.');
            }

            return redirect()->route('admin.index')->with('success', 'Payment status updated successfully.');
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while updating payment status try again later.');
        }
    }

    public function destroy(Payment $payment)
    {

        try {
            $isDeleted = $payment->delete();

            if (!$isDeleted) {
                return back()->with('error', 'Payment not deleted.');
            }

            return redirect()->route('admin.index')->with('success', 'Payment deleted successfully.');
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while deleting payment try again later.');
        }
    }
}
