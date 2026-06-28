@extends('layouts.app')
@section('title','Keranjang Belanja')
@section('content')
<div style="background:#FAF8F5;min-height:80vh;padding:40px 60px;">
  <p style="font-size:12px;color:#A08070;margin-bottom:20px;">
    <a href="/" style="color:#A08070;text-decoration:none;">Home</a>
    <span style="margin:0 6px;">&rsaquo;</span>
    <span style="color:#2C1810;">Shopping Cart</span>
  </p>
  <h1 style="font-family:'Playfair Display',serif;font-size:36px;font-weight:400;color:#1A1009;margin-bottom:6px;">Your Selection</h1>
  <p style="font-size:13px;color:#A08070;margin-bottom:24px;">Carefully curated pieces, ready for their journey.</p>
  <hr style="border:none;border-top:1px solid #E8DDD2;margin-bottom:32px;">
  @if(session('cart_success'))
    <div style="background:#F0FAF0;border:1px solid #86EFAC;color:#166534;font-size:13px;padding:12px 16px;border-radius:6px;margin-bottom:20px;">
      {{ session('cart_success') }}
    </div>
  @endif
  @if(empty($cart))
    <div style="text-align:center;padding:80px 20px;">
      <svg style="margin:0 auto 16px;display:block;" width="48" height="48" fill="none" stroke="#C4B5A5" stroke-width="1.3" viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
      <p style="font-family:'Playfair Display',serif;font-size:22px;color:#2C1810;margin-bottom:8px;">Keranjang kosong</p>
      <p style="font-size:13px;color:#A08070;margin-bottom:24px;">Temukan produk terbaik kami.</p>
      <a href="/products" style="display:inline-block;background:#2C1810;color:#fff;font-size:11px;font-weight:600;letter-spacing:.15em;text-transform:uppercase;padding:14px 32px;text-decoration:none;">VIEW PRODUCTS</a>
    </div>
  @else
  <div style="display:grid;grid-template-columns:1fr 320px;gap:32px;align-items:start;">
    <div>
      @foreach($cart as $id => $item)
      <div style="background:#fff;border:1px solid #EDE5DC;border-radius:4px;padding:20px;display:flex;gap:20px;margin-bottom:16px;">
        <img src="{{ $item['image'] }}" style="width:100px;height:100px;object-fit:cover;border-radius:4px;flex-shrink:0;" onerror="this.src='/IMAGE/SUPER.jpeg'">
        <div style="flex:1;">
          <div style="display:flex;justify-content:space-between;align-items:start;">
            <div>
              <p style="font-family:'Playfair Display',serif;font-size:16px;color:#2C1810;margin-bottom:4px;">{{ $item['name'] }}</p>
              <p style="font-size:11px;color:#A08070;letter-spacing:.06em;text-transform:uppercase;">{{ Str::limit($item['desc'],50) }}</p>
            </div>
            <p style="font-size:15px;font-weight:500;color:#2C1810;white-space:nowrap;">Rp {{ number_format($item['price'],0,',','.') }}</p>
          </div>
          <div style="display:flex;justify-content:space-between;align-items:center;margin-top:14px;">
            <form method="POST" action="{{ route('cart.update') }}" style="display:flex;align-items:center;border:1px solid #E8DDD2;border-radius:4px;overflow:hidden;">
              @csrf
              <input type="hidden" name="product_id" value="{{ $id }}">
              <button type="submit" name="qty" value="{{ max(1,$item['qty']-1) }}" style="width:32px;height:32px;background:none;border:none;font-size:18px;cursor:pointer;color:#6B5B4E;">&#8722;</button>
              <span style="width:32px;text-align:center;font-size:13px;color:#2C1810;">{{ $item['qty'] }}</span>
              <button type="submit" name="qty" value="{{ $item['qty']+1 }}" style="width:32px;height:32px;background:none;border:none;font-size:18px;cursor:pointer;color:#6B5B4E;">&#43;</button>
            </form>
            <form method="POST" action="{{ route('cart.remove') }}">
              @csrf
              <input type="hidden" name="product_id" value="{{ $id }}">
              <button style="background:none;border:none;font-size:12px;color:#A08070;cursor:pointer;display:flex;align-items:center;gap:4px;">
                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                Remove
              </button>
            </form>
          </div>
        </div>
      </div>
      @endforeach
      <div style="background:#FBF6EE;border:1px solid #EDE5DC;border-radius:4px;padding:16px 20px;display:flex;justify-content:space-between;align-items:center;">
        <div style="display:flex;align-items:center;gap:12px;">
          <svg width="20" height="20" fill="none" stroke="#8B6914" stroke-width="1.5" viewBox="0 0 24 24"><polyline points="20 12 20 22 4 22 4 12"/><rect x="2" y="7" width="20" height="5"/><line x1="12" y1="22" x2="12" y2="7"/><path d="M12 7H7.5a2.5 2.5 0 010-5C11 2 12 7 12 7z"/><path d="M12 7h4.5a2.5 2.5 0 000-5C13 2 12 7 12 7z"/></svg>
          <div>
            <p style="font-size:13px;font-weight:500;color:#2C1810;">This is a gift</p>
            <p style="font-size:12px;color:#A08070;">Complimentary gift wrapping and a personalized note.</p>
          </div>
        </div>
        <svg width="16" height="16" fill="none" stroke="#A08070" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
      </div>
    </div>
    <div style="background:#fff;border:1px solid #EDE5DC;border-radius:4px;padding:24px;position:sticky;top:20px;">
      <h3 style="font-family:'Playfair Display',serif;font-size:18px;color:#2C1810;margin-bottom:20px;">Order Summary</h3>
      <div style="display:flex;justify-content:space-between;font-size:13px;color:#6B5B4E;margin-bottom:10px;">
        <span>Subtotal</span><span>Rp {{ number_format($subtotal,0,',','.') }}</span>
      </div>
      <div style="display:flex;justify-content:space-between;font-size:13px;color:#6B5B4E;margin-bottom:10px;">
        <span>Standard Shipping</span><span style="color:#A08070;">Calculated next</span>
      </div>
      <hr style="border:none;border-top:1px solid #F0E9E0;margin:16px 0;">
      <div style="display:flex;justify-content:space-between;font-size:15px;font-weight:700;color:#2C1810;margin-bottom:20px;">
        <span>Total</span><span>Rp {{ number_format($subtotal,0,',','.') }}</span>
      </div>
      <a href="{{ route('checkout.index') }}" style="display:block;background:#2C1810;color:#fff;text-align:center;font-size:11px;font-weight:700;letter-spacing:.15em;text-transform:uppercase;padding:14px;text-decoration:none;margin-bottom:10px;">PROCEED TO CHECKOUT</a>
      <a href="/products" style="display:block;background:#fff;color:#2C1810;text-align:center;font-size:11px;font-weight:600;letter-spacing:.12em;text-transform:uppercase;padding:14px;text-decoration:none;border:1px solid #2C1810;">CONTINUE SHOPPING</a>
      <p style="font-size:10px;color:#C4B5A5;text-align:center;margin-top:16px;">&#x1F512; Secured with 256-bit SSL encryption</p>
    </div>
  </div>
  @if($related->count())
  <div style="margin-top:64px;">
    <div style="display:flex;justify-content:space-between;align-items:baseline;margin-bottom:20px;">
      <h2 style="font-family:'Playfair Display',serif;font-size:26px;color:#1A1009;">Complete Your Order</h2>
      <a href="/products" style="font-size:12px;color:#8B6914;text-decoration:none;border-bottom:1px solid #8B6914;">View All</a>
    </div>
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:20px;">
      @foreach($related as $p)
      <div>
        <img src="{{ $p->thumbnail }}" style="width:100%;aspect-ratio:1;object-fit:cover;margin-bottom:10px;" onerror="this.src='/IMAGE/SUPER.jpeg'">
        <p style="font-size:14px;font-weight:500;color:#2C1810;">{{ $p->name }}</p>
        <p style="font-size:13px;color:#A08070;margin-bottom:8px;">Rp {{ number_format($p->price,0,',','.') }}</p>
        <form method="POST" action="{{ route('cart.add') }}">
          @csrf
          <input type="hidden" name="product_id" value="{{ $p->id }}">
          <button type="submit" style="width:100%;background:#2C1810;color:#fff;font-size:10px;font-weight:600;letter-spacing:.1em;text-transform:uppercase;padding:10px;border:none;cursor:pointer;">ADD TO CART</button>
        </form>
      </div>
      @endforeach
    </div>
  </div>
  @endif
  @endif
</div>
@endsection
