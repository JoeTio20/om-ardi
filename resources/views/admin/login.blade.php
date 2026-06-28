@extends('layouts.app')
@section('title', 'Login - Sarang Burung')
@section('content')

<div class="min-h-[calc(100vh-64px)] flex flex-col items-center justify-center py-16 px-6">

  539
  <div class="mb-8 text-center">
    <img src="/IMAGE/logo.png" alt="Sarang Burung" class="w-20 h-20 object-contain mx-auto"
         onerror="this.style.display='none'">
  </div>

  540
  <div class="w-full max-w-md bg-white rounded-sm shadow-sm border border-gray-100 px-10 py-10">

    <h1 class="font-serif text-3xl text-center mb-1" style="font-family:'Playfair Display',serif">Welcome Back</h1>
    <p class="text-center text-sm text-gray-400 mb-8">Sign in to your account</p>

    @if(session('error_type') === 'email')
      <div class="bg-red-50 border border-red-200 text-red-600 text-sm px-4 py-3 rounded mb-6">
        Sorry, we couldn't find an account with that email address.
      </div>
    @elseif(session('error_type') === 'password')
      <div class="bg-red-50 border border-red-200 text-red-600 text-sm px-4 py-3 rounded mb-6">
        Sorry, wrong password. Please try again.
      </div>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}">
      @csrf

      <div class="mb-5">
        <label class="block text-[10px] tracking-[.15em] uppercase text-gray-500 mb-2">Email Address</label>
        <input type="email" name="email" value="{{ old('email') }}" required autofocus
               class="w-full border-0 border-b {{ session('error_type')==='email' ? 'border-red-400' : 'border-gray-200' }} pb-2 text-sm focus:outline-none focus:border-gray-800 transition bg-transparent"
               placeholder="name@example.com">
      </div>

      <div class="mb-8">
        <label class="block text-[10px] tracking-[.15em] uppercase text-gray-500 mb-2">Password</label>
        <input type="password" name="password" required
               class="w-full border-0 border-b {{ session('error_type')==='password' ? 'border-red-400' : 'border-gray-200' }} pb-2 text-sm focus:outline-none focus:border-gray-800 transition bg-transparent">
      </div>

      <button type="submit"
              class="w-full bg-charcoal text-cream text-[11px] tracking-[.2em] uppercase py-3.5 hover:opacity-80 transition">
        SIGN IN
      </button>
    </form>

  </div>

  <p class="mt-6 text-xs text-gray-400 flex items-center gap-1">
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
    </svg>
    Need assistance? Contact admin.
  </p>

</div>
@endsection
