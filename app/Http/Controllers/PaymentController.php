<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;

class PaymentController extends Controller
{
    public function createOrder(Request $request)
    {
        $items = Cart::with('product')->where('user_id', auth()->id())->get();
        $total = $items->sum(fn($item) => $item->product->price * $item->quantity);

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $order = $api->order->create([
            'receipt' => 'order_rcptid_' . time(),
            'amount' => $total * 100, // paise
            'currency' => 'INR',
        ]);

        return view('payment.checkout', [
            'order_id' => $order['id'],
            'amount' => $total,
            'key' => env('RAZORPAY_KEY'),
        ]);
    }

    public function verifyPayment(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        try {
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ];
            $api->utility->verifyPaymentSignature($attributes);

            // Save order after successful payment
            $items = Cart::with('product')->where('user_id', auth()->id())->get();
            $total = $items->sum(fn($item) => $item->product->price * $item->quantity);

            $order = Order::create([
                'user_id' => auth()->id(),
                'total_price' => $total,
            ]);

            foreach ($items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
                $item->product->decrement('stock', $item->quantity);
            }

            Cart::where('user_id', auth()->id())->delete();

            return redirect()->route('products.index')->with('success', 'Payment successful!');

        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }
}
