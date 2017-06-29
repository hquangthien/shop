<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $controller = $request->segment(2);
        $method = $request->method();
        $action = $request->route()->getAction()['uses'];
        $action = last(explode('@', $action));

        if (Auth::check()){
            if (Auth::user()->role == 3)
            {
                Auth::logout();
                return redirect()->route('login')->with('msg', 'Bạn đã truy cập danh mục không được phép');
            }
        } else{
            return redirect()->route('login');
        }


        switch ($controller){
            case 'user':
                switch ($action){
                    case 'create':
                        if (Auth::user()->role != 1){
                            Auth::logout();
                            return redirect()->route('login')->with('msg', 'Bạn đã truy cập danh mục không được phép');
                        }
                        break;
                    case 'store':
                        if (Auth::user()->role != 1){
                            Auth::logout();
                            return redirect()->route('login')->with('msg', 'Bạn đã truy cập danh mục không được phép');
                        }
                        break;
                    case 'edit':
                        if (Auth::user()->id != $request->id){
                            Auth::logout();
                            return redirect()->route('login')->with('msg', 'Bạn đã truy cập danh mục không được phép');
                        }
                        break;
                    case 'destroy':
                        if (Auth::user()->role != 1 && Auth::user()->id != $request->id){
                            Auth::logout();
                            return redirect()->route('login')->with('msg', 'Bạn đã truy cập danh mục không được phép');
                        }
                        break;
                }
                break;
            case 'cat':
                switch ($action){
                    case 'create':
                        if (Auth::user()->role != 1){
                            Auth::logout();
                            return redirect()->route('login')->with('msg', 'Bạn đã truy cập danh mục không được phép');
                        }
                        break;
                    case 'store':
                        if (Auth::user()->role != 1){
                            Auth::logout();
                            return redirect()->route('login')->with('msg', 'Bạn đã truy cập danh mục không được phép');
                        }
                        break;
                    case 'edit':
                        if (Auth::user()->role != 1){
                            Auth::logout();
                            return redirect()->route('login')->with('msg', 'Bạn đã truy cập danh mục không được phép');
                        }
                        break;
                    case 'destroy':
                        if (Auth::user()->role != 1){
                            Auth::logout();
                            return redirect()->route('login')->with('msg', 'Bạn đã truy cập danh mục không được phép');
                        }
                        break;
                }
                break;
            case 'guest':
                switch ($action){
                    case 'edit':
                        if (Auth::user()->id != $request->id){
                            Auth::logout();
                            return redirect()->route('login')->with('msg', 'Bạn đã truy cập danh mục không được phép');
                        }
                        break;
                    case 'destroy':
                        if (Auth::user()->role != 1 && Auth::user()->id != $request->id){
                            Auth::logout();
                            return redirect()->route('login')->with('msg', 'Bạn đã truy cập danh mục không được phép');
                        }
                        break;
                }
                break;
            case 'adv':
                switch ($action){
                    case 'destroy':
                        if (Auth::user()->role != 1){
                            Auth::logout();
                            return redirect()->route('login')->with('msg', 'Bạn đã truy cập danh mục không được phép');
                        }
                        break;
                }
                break;
            case 'product':
                switch ($action){
                    case 'destroy':
                        if (Auth::user()->role != 1){
                            Auth::logout();
                            return redirect()->route('login')->with('msg', 'Bạn đã truy cập danh mục không được phép');
                        }
                        break;
                }
                break;
            case 'shop':
                switch ($action){
                    case 'destroy':
                        if (Auth::user()->role != 1){
                            Auth::logout();
                            return redirect()->route('login')->with('msg', 'Bạn đã truy cập danh mục không được phép');
                        }
                        break;
                }
                break;
            case 'bill':
                switch ($action){
                    case 'destroy':
                        if (Auth::user()->role != 1){
                            Auth::logout();
                            return redirect()->route('login')->with('msg', 'Bạn đã truy cập danh mục không được phép');
                        }
                        break;
                }
                break;
        }

        return $next($request);
    }
}
