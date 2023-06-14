<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\BaseWebController;

class CacheController extends BaseWebController
{

    public function __construct(Request $request)
    {
        $this->middleware(function ($request, $next) {
            $this->id = Auth::guard('web')->user();
            parent::__construct($this->id, $request);
            return $next($request);
        });
    }

    public function clearAll(Request $request)
    {
        Cache::flush();

        $request->session()->flash('alert', array('code'=> 'success', 'text'  => "Limpeza de cache realizada com sucesso!"));
        return redirect(route("dashboard"));
    }
}
