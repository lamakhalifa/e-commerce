<?php

namespace App\Http\Controllers;

use Laravel\Cashier\Cashier;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        $user = $request->user();

        try {
            return $user->checkout('price_xxxxx', [
                'success_url' => route('checkout.success'),
                'cancel_url' => route('checkout.cancel'),
                'metadata' => [
                    'product_id' => 1,
                    'user_id' => $user->id,
                ],
            ]);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');

        if (!$sessionId) {
            return redirect()->route('home');
        }

        $session = Cashier::stripe()->checkout->sessions->retrieve($sessionId);

        if ($session->payment_status === 'paid') {
            return view('payment.success', ['session' => $session]);
        }

        return redirect()->route('checkout.cancel');
    }

    public function cancel()
    {
        return view('payment.cancel');
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'payment_method_id' => 'required|string',
            'amount' => 'required|integer|min:50',
        ]);

        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $paymentIntent = PaymentIntent::create([
                'amount' => $request->amount,
                'currency' => 'sar',
                'payment_method' => $request->payment_method_id,
                'confirmation_method' => 'manual',
                'confirm' => true,
                'return_url' => route('cart.index'),
                'metadata' => [
                    'email' => auth()->user()->email,
                    'name' => auth()->user()->name,
                    'items' => json_encode($request->items),
                    'discount' => $request->discount ?? 0,
                ],
            ]);

            if ($paymentIntent->status === 'succeeded') {
                // حفظ الطلب في قاعدة البيانات هنا
                return response()->json(['success' => true, 'payment_intent' => $paymentIntent]);
            }

            return response()->json(['success' => false, 'error' => 'لم يتم تأكيد الدفع']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
