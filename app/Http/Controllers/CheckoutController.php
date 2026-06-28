<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index');
        }
        $subtotal = array_sum(array_map(fn($i) => $i['price'] * $i['qty'], $cart));
        return view('checkout', compact('cart', 'subtotal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'     => 'required|string|max:100',
            'last_name'      => 'required|string|max:100',
            'whatsapp'       => 'required|string|max:20',
            'address'        => 'required|string',
            'city'           => 'required|string',
            'postal_code'    => 'nullable|string|max:10',
            'payment_method' => 'required|in:transfer,midtrans',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        $subtotal = array_sum(array_map(fn($i) => $i['price'] * $i['qty'], $cart));

        $order = Order::create([
            'first_name'     => $request->first_name,
            'last_name'      => $request->last_name,
            'whatsapp'       => $request->whatsapp,
            'address'        => $request->address,
            'city'           => $request->city,
            'postal_code'    => $request->postal_code,
            'total'          => $subtotal,
            'payment_method' => $request->payment_method,
            'status'         => 'pending',
            'items'          => json_encode(array_values($cart)),
        ]);

        session()->forget('cart');
        return redirect()->route('checkout.success', $order->id);
    }

    public function success($id)
    {
        $order = Order::findOrFail($id);
        return view('checkout-success', compact('order'));
    }
}
