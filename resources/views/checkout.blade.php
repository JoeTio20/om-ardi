@extends('layouts.app')
@section('title','Checkout')
@section('content')
<div style="background:#FAF8F5;min-height:80vh;padding:40px 60px;">

  <h1 style="font-family:'Playfair Display',serif;font-size:36px;font-weight:400;color:#1A1009;margin-bottom:6px;">Checkout</h1>
  <p style="font-size:12px;color:#A08070;margin-bottom:32px;">
    <a href="{{ route('cart.index') }}" style="color:#A08070;text-decoration:none;">Cart</a>
    <span style="margin:0 6px;">&rsaquo;</span>
    <strong style="color:#2C1810;">Information &amp; Payment</strong>
  </p>

  @if($errors->any())
    <div style="background:#FEF2F2;border:1px solid #FCA5A5;color:#991B1B;font-size:13px;padding:12px 16px;border-radius:6px;margin-bottom:20px;">
      <ul style="margin:0;padding-left:16px;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
  @endif

  <form method="POST" action="{{ route('checkout.store') }}">
    @csrf
    <div style="display:grid;grid-template-columns:1fr 340px;gap:40px;align-items:start;">

      <div>
        <h2 style="display:flex;align-items:center;gap:12px;font-size:17px;font-weight:500;color:#2C1810;margin-bottom:20px;">
          <span style="width:26px;height:26px;border-radius:50%;border:1.5px solid #2C1810;display:flex;align-items:center;justify-content:center;font-size:12px;flex-shrink:0;">1</span>
          Shipping Details
        </h2>

        <div style="margin-bottom:18px;">
          <label style="display:block;font-size:12px;color:#A08070;margin-bottom:6px;">WhatsApp Number</label>
          <input type="text" name="whatsapp" value="{{ old('whatsapp') }}" placeholder="+62 812..." required
                 style="width:100%;border:none;border-bottom:1px solid #D4C9BC;padding:8px 0;font-size:14px;background:transparent;outline:none;color:#2C1810;box-sizing:border-box;">
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:18px;">
          <div>
            <label style="display:block;font-size:12px;color:#A08070;margin-bottom:6px;">First Name</label>
            <input type="text" name="first_name" value="{{ old('first_name') }}" required
                   style="width:100%;border:none;border-bottom:1px solid #D4C9BC;padding:8px 0;font-size:14px;background:transparent;outline:none;color:#2C1810;box-sizing:border-box;">
          </div>
          <div>
            <label style="display:block;font-size:12px;color:#A08070;margin-bottom:6px;">Last Name</label>
            <input type="text" name="last_name" value="{{ old('last_name') }}" required
                   style="width:100%;border:none;border-bottom:1px solid #D4C9BC;padding:8px 0;font-size:14px;background:transparent;outline:none;color:#2C1810;box-sizing:border-box;">
          </div>
        </div>
        <div style="margin-bottom:18px;">
          <label style="display:block;font-size:12px;color:#A08070;margin-bottom:6px;">Shipping Address</label>
          <input type="text" name="address" value="{{ old('address') }}" placeholder="Street name and house number" required
                 style="width:100%;border:none;border-bottom:1px solid #D4C9BC;padding:8px 0;font-size:14px;background:transparent;outline:none;color:#2C1810;box-sizing:border-box;">
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:32px;">
          <div>
            <label style="display:block;font-size:12px;color:#A08070;margin-bottom:6px;">City</label>
            <input type="text" name="city" value="{{ old('city') }}" required
                   style="width:100%;border:none;border-bottom:1px solid #D4C9BC;padding:8px 0;font-size:14px;background:transparent;outline:none;color:#2C1810;box-sizing:border-box;">
          </div>
          <div>
            <label style="display:block;font-size:12px;color:#A08070;margin-bottom:6px;">Postal Code</label>
            <input type="text" name="postal_code" value="{{ old('postal_code') }}"
                   style="width:100%;border:none;border-bottom:1px solid #D4C9BC;padding:8px 0;font-size:14px;background:transparent;outline:none;color:#2C1810;box-sizing:border-box;">
          </div>
        </div>

        <h2 style="display:flex;align-items:center;gap:12px;font-size:17px;font-weight:500;color:#2C1810;margin-bottom:20px;">
          <span style="width:26px;height:26px;border-radius:50%;border:1.5px solid #2C1810;display:flex;align-items:center;justify-content:center;font-size:12px;flex-shrink:0;">2</span>
          Payment Method
        </h2>

        <label id="lbl-midtrans" style="display:flex;justify-content:space-between;align-items:center;border:1.5px solid #2C1810;border-radius:6px;padding:14px 16px;cursor:pointer;margin-bottom:10px;">
          <div style="display:flex;align-items:center;gap:12px;">
            <input type="radio" name="payment_method" value="midtrans" checked style="accent-color:#2C1810;width:16px;height:16px;">
            <span style="font-size:14px;font-weight:500;color:#2C1810;">Credit / Debit Card &amp; E-Wallet</span>
          </div>
          <svg width="20" height="20" fill="none" stroke="#A08070" stroke-width="1.5" viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
        </label>

        <label id="lbl-transfer" style="display:flex;justify-content:space-between;align-items:center;border:1px solid #EDE5DC;border-radius:6px;padding:14px 16px;cursor:pointer;margin-bottom:12px;">
          <div style="display:flex;align-items:center;gap:12px;">
            <input type="radio" name="payment_method" value="transfer" style="accent-color:#2C1810;width:16px;height:16px;">
            <span style="font-size:14px;font-weight:500;color:#2C1810;">Manual Bank Transfer</span>
          </div>
          <svg width="20" height="20" fill="none" stroke="#A08070" stroke-width="1.5" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        </label>

        <div id="bank-info" style="display:none;background:#FBF6EE;border:1px solid #EDE5DC;border-radius:6px;padding:16px;margin-bottom:20px;">
          <p style="font-size:12px;font-weight:600;color:#2C1810;margin-bottom:8px;">Transfer ke rekening:</p>
          <p style="font-size:13px;color:#6B5B4E;">Bank BCA</p>
          <p style="font-size:17px;font-weight:700;color:#2C1810;letter-spacing:.05em;">1234 5678 90</p>
          <p style="font-size:13px;color:#6B5B4E;">a.n. Sarang Burung Walet</p>
          <p style="font-size:11px;color:#A08070;margin-top:8px;">Konfirmasi pembayaran via WhatsApp setelah transfer.</p>
        </div>

        <button type="submit" style="display:inline-flex;align-items:center;gap:10px;background:#2C1810;color:#fff;font-size:11px;font-weight:700;letter-spacing:.15em;text-transform:uppercase;padding:16px 32px;border:none;cursor:pointer;">
          COMPLETE ORDER
          <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
        </button>
        <p style="font-size:11px;color:#A08070;margin-top:10px;">Taxes and shipping calculated at checkout. Secure SSL encrypted transaction.</p>
      </div>

      <div style="background:#fff;border:1px solid #EDE5DC;border-radius:4px;padding:24px;position:sticky;top:20px;">
        <h3 style="font-family:'Playfair Display',serif;font-size:18px;color:#2C1810;margin-bottom:20px;">Order Summary</h3>
        @foreach($cart as $item)
        <div style="display:flex;gap:14px;align-items:center;margin-bottom:16px;">
          <div style="position:relative;flex-shrink:0;">
            <img src="{{ $item['image'] }}" style="width:56px;height:56px;object-fit:cover;border-radius:4px;" onerror="this.src='/IMAGE/SUPER.jpeg'">
            <span style="position:absolute;top:-6px;right:-6px;background:#2C1810;color:#fff;font-size:10px;font-weight:700;width:18px;height:18px;border-radius:50%;display:flex;align-items:center;justify-content:center;">{{ $item['qty'] }}</span>
          </div>
          <div style="flex:1;min-width:0;">
            <p style="font-size:13px;font-weight:500;color:#2C1810;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $item['name'] }}</p>
            <p style="font-size:11px;color:#A08070;">{{ Str::limit($item['desc']??'',35) }}</p>
          </div>
          <p style="font-size:13px;font-weight:500;color:#2C1810;white-space:nowrap;">Rp {{ number_format($item['price']*$item['qty'],0,',','.') }}</p>
        </div>
        @endforeach
        <hr style="border:none;border-top:1px solid #F0E9E0;margin:16px 0;">
        <div style="display:flex;justify-content:space-between;font-size:13px;color:#6B5B4E;margin-bottom:8px;">
          <span>Subtotal</span><span>Rp {{ number_format($subtotal,0,',','.') }}</span>
        </div>
        <div style="display:flex;justify-content:space-between;font-size:13px;color:#A08070;margin-bottom:16px;">
          <span>Shipping</span><span>Calculated later</span>
        </div>
        <div style="display:flex;justify-content:space-between;font-size:15px;font-weight:700;color:#2C1810;">
          <span>Total</span><span>Rp {{ number_format($subtotal,0,',','.') }}</span>
        </div>
      </div>
    </div>
  </form>
</div>

<script>
document.querySelectorAll('input[name="payment_method"]').forEach(function(r){
  r.addEventListener('change', function()
    var isTrans = this.value === 'transfer';
    document.getElementById('bank-info').style.display = isTrans ? 'block' : 'none';
    document.getElementById('lbl-midtrans').style.border = isTrans ? '1px solid #EDE5DC' : '1.5px solid #2C1810';
    document.getElementById('lbl-transfer').style.border = isTrans ? '1.5px solid #2C1810' : '1px solid #EDE5DC';
  );
});
</script>
@endsection
