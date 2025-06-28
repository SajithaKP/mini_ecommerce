<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock,
        ]);

        $cart = Cart::updateOrCreate(
            ['user_id' => auth()->id(), 'product_id' => $product->id],
            ['quantity' => DB::raw("quantity + {$request->quantity}")]
        );

        return redirect()->route('cart.index')->with('success', 'Added to cart!');
    }

    public function index()
    {
        $items = Cart::with('product')->where('user_id', auth()->id())->get();
        $total = $items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('cart.index', compact('items', 'total'));
    }

    public function buy()
    {
        $items = Cart::with('product')->where('user_id', auth()->id())->get();
        $total = 0;

        foreach ($items as $item) {
            if ($item->quantity > $item->product->stock) {
                return redirect()->back()->with('error', 'Not enough stock for ' . $item->product->name);
            }
            $total += $item->product->price * $item->quantity;
        }

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

            // reduce stock
            $item->product->decrement('stock', $item->quantity);
        }

        Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('products.index')->with('success', 'Purchase complete!');
    }

}
