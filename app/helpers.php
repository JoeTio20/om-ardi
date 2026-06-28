<?php

function formatHarga(int $price): string
{
    $locale = app()->getLocale();

    if ($locale === 'en') {
        $rate = cache()->remember('usd_rate', 3600, function () {
            try {
                $res = \Illuminate\Support\Facades\Http::get('https://api.frankfurter.app/latest?from=USD&to=IDR');
                return $res->json('rates.IDR') ?? 16000;
            } catch (\Exception $e) {
                return 16000;
            }
        });
        return '$' . number_format($price / $rate, 0);
    }

    return 'Rp ' . number_format($price, 0, ',', '.');
}