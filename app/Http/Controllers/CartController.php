<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart     = session('cart', []);
        $subtotal = array_sum(array_map(fn($i) => $i['price'] * $i['qty'], $cart));
        $related  = Product::where('is_active', true)->inRandomOrder()->take(4)->get();
        return view('cart', compact('cart', 'subtotal', 'related'));
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart    = session('cart', []);
        $id      = $product->id;

        if (isset($cart[$id])) {
            $cart[$id]['qty']++;
        } else {
            $cart[$id] = [
                'id'    => $product->id,
                'name'  => $product->name,
                'price' => $product->price,
                'image' => $product->thumbnail,
                'desc'  => $product->description ?? '',
                'qty'   => 1,
            ];
        }

        session(['cart' => $cart]);
        return back()->with('cart_success', 'Produk ditambahkan ke keranjang!');
    }

    public function update(Request $request)
    {
        $cart = session('cart', []);
        $id   = $request->product_id;
        $qty  = max(1, (int) $request->qty);

        if (isset($cart[$id])) {
            $cart[$id]['qty'] = $qty;
        }

        session(['cart' => $cart]);
        return redirect()->route('cart.index');
    }

    public function remove(Request $request)
    {
        $cart = session('cart', []);
        unset($cart[$request->product_id]);
        session(['cart' => $cart]);
        return redirect()->route('cart.index');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index');
    }
}
