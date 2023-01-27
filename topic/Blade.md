# Laravel
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
- Unless
    ~~~blade
    @unless (false)
        This is false
    @endunless
    ~~~
- Check empty array
    ~~~blade
    @empty([])
        Array is empty
    @endempty
    ~~~
- Unchecked
    ~~~blade
    @isset($var)
    @endisset
    ~~~

    ~~~blade
    @switch($i)
        @case(1)
            Do something
            @break
    
        @default
            Do something
    @endswitch
    ~~~

    ~~~blade
    @foreach ($arr as $item)
    @endforeach
    ~~~

    ~~~blade
    @for ($i = 0; $i < 30; $i++)
    @endfor
    ~~~

    ~~~blade
    @forelse ($arr as $item)
    @empty
        // no item
    @endforelse
    ~~~

    ~~~blade
    @while (true)
    @endwhile
    ~~~

    ~~~blade
    @php
        $var = false;
    @endphp
    ~~~

    ~~~blade
    @include('something.something')
    @includeIf
    @includewhen
    @includeUnless
    @includeFirst
    ~~~

___
- [ ] TODO: read more about blade [here](https://laravel.com/docs/9.x/blade)