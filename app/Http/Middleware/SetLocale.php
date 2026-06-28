<?php
namespace App\Http\Middleware;
use Closure; use Illuminate\Http\Request;
use Illuminate\Support\Facades\{App, Session};
class SetLocale {
    public function handle(Request $request, Closure $next) {
        App::setLocale(Session::get('locale', 'id'));
        return $next($request);
    }
}
