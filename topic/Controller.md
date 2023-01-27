# CSRF
***Disclaimer*: The content described in this article are for educational purposes only.**
---
## Controller
- To make a controller
    - `php artisan make:controller HelloController`
- This will create a controller in `app/Http/Controllers`
- Add a route for this controller
    ~~~php 
    Route::get(‘/hello’,HelloController@say’);
    ~~~
