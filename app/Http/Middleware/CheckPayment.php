<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Subscription;
use Route;
class CheckPayment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $guard = 'frontend')
    {
        if(auth()->guard($guard)->check()){
            $user = auth()->guard($guard)->user();
            if($user->type_id == '3'){
                if($user->subscription_end >= date('Y-m-d')){
                    return $next($request);
                }else{
                    if(!in_array($request->route()->getName(),['plans','account-settings','pro-account','logout','checkout','explore']) && !$request->ajax()){
                        if (empty($user->stripe_id)) {
                            session()->flash('error', 'please subscribe a plan to get full access.');
                        }else{
                            session()->flash('error', 'your current plan has expired please upgrade your plan.');
                        }
                        return redirect()->route('plans');
                    }
                }
            }
        }
        return $next($request);
    }
}
