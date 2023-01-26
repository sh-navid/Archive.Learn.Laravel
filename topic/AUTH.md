# Laravel
***Disclaimer*: The content described in this article are for educational purposes only.**
---
## Basic Auth
- Make Basic Authentication
    - First
        - `php artisan make:middleware AuthBasic`
    - Next in `AuthBasic.php`
        ~~~php
            if (Auth::onceBasic()) {
                return response()->json(['message', 'Authentication Failed'], 401);
            } else {
                return $next($request);
            }
        ~~~
    - Then register this in `Kernel.php` -> `api`
        ~~~php
            'api' => [
                ...
                \App\Http\Middleware\AuthBasic::class
                ...
            ],
        ~~~