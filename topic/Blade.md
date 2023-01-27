# CSRF
***Disclaimer*: The content described in this article are for educational purposes only.**
---
## Blade
- Make a route
    ~~~php
    Route::get('/home', function () {
        return view('home', ['title' => 'My Page']);
    });
    ~~~
- Make a view `home.blade.php` with this content
    ~~~blade
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>{{$title}}</title>
    </head>
    <body>
        <h1>{{$title}}</h1>
    </body>
    </html>
    ~~~
## More on blade
- Time
    ~~~blade
    {{time()}}
    ~~~
- IF-Else
    ~~~blade
    <body>
        @if (12==13)
            hello
        @else
            goodbye
        @endif
    </body>
    ~~~