@extends('layouts.app')
@section('title','Pesanan Berhasil')
@section('content')
<div style="background:#FAF8F5;min-height:80vh;display:flex;align-items:center;justify-content:center;padding:60px 20px;">
  <div style="text-align:center;max-width:480px;width:100%;">
    <div style="width:64px;height:64px;background:#F0FAF0;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
      <svg width="28" height="28" fill="none" stroke="#22C55E" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
    </div>
    <h1 style="font-family:'Playfair Display',serif;font-size:30px;color:#2C1810;margin-bottom:8px;">Order Confirmed!</h1>
    <p style="font-size:13px;color:#A08070;margin-bottom:24px;">Terima kasih, {{ $order->first_name }}! Pesanan Anda sudah kami terima.</p>
    <div style="background:#fff;border:1px solid #EDE5DC;border-radius:8px;padding:20px;text-align:left;margin-bottom:24px;">
      <p style="font-size:11px;font-weight:600;color:#A08070;letter-spacing:.1em;text-transform:uppercase;margin-bottom:12px;">Order Details</p>
      <p style="font-size:13px;color:#6B5B4E;margin-bottom:6px;">Order ID: <strong style="color:#2C1810;">#SB-{{ str_pad($order->id,5,'0',STR_PAD_LEFT) }}</strong></p>
      <p style="font-size:13px;color:#6B5B4E;margin-bottom:6px;">Total: <strong style="color:#2C1810;">Rp {{ number_format($order->total,0,',','.') }}</strong></p>
      <p style="font-size:13px;color:#6B5B4E;">Metode: <strong style="color:#2C1810;">{{ $order->payment_method==='transfer' ? 'Bank Transfer Manual' : 'Midtrans' }}</strong></p>
      @if($order->payment_method==='transfer')
      <div style="margin-top:14px;background:#FBF6EE;border-radius:6px;padding:14px;">
        <p style="font-size:12px;font-weight:600;color:#2C1810;margin-bottom:6px;">Transfer ke:</p>
        <p style="font-size:13px;color:#6B5B4E;">Bank BCA &bull; <strong style="color:#2C1810;">1234 5678 90</strong></p>
        <p style="font-size:13px;color:#6B5B4E;">a.n. Sarang Burung Walet</p>
        <p style="font-size:11px;color:#A08070;margin-top:6px;">Konfirmasi via WhatsApp setelah transfer.</p>
      </div>
      @endif
    </div>
    <a href="{{ route('home') }}" style="display:inline-block;background:#2C1810;color:#fff;font-size:11px;font-weight:700;letter-spacing:.15em;text-transform:uppercase;padding:14px 32px;text-decoration:none;">BACK TO HOME</a>
  </div>
</div>
@endsection
