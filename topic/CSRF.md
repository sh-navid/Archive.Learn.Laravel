# CSRF
***Disclaimer*: The content described in this article are for educational purposes only.**
---
>> `Cross-site request forgery`, also known as `one-click attack` or `session riding` and abbreviated as `CSRF` or `XSRF`, is a type of malicious exploit of a website or web application where unauthorized commands are submitted from a user that the web application trusts. <sup>[wikipedia Jan26](https://en.wikipedia.org/wiki/Cross-site_request_forgery)</sup> 
- [How to handle this in laravel?](https://laravel.com/docs/5.6/routing)
- Read more about CSRF [here](https://blog.pusher.com/csrf-laravel-verifycsrftoken/) and [here](https://owasp.org/www-community/attacks/csrf).
## Laravel + CSRF
>> Any HTML forms pointing to `POST`, `PUT`, or `DELETE` routes that are defined in the web routes file should include a `CSRF` token field. Otherwise, the request will be rejected. <sup>[laravel Jan26](https://laravel.com/docs/5.6/routing)</sup>   
- You can get `419 | Page Expired` error in case not using `@csrf` directive
- How to use it?
    - Make two routes in `web.php` like this:
        ~~~php
        Route::get('/csrf', function () {
            return view("csrf");
        });

        Route::post("/csrf-form", function () {
            // $data = file_get_contents('php://input');
            return "The value of input text is: ".$_POST["myText"];
        });
        ~~~
    - Make a view `csrf.blade.php` like this:
        ~~~html
        <!DOCTYPE html>
        <html lang="en">
        <body>
            <h1>Form with CSRF token</h1>
            <form method="POST" action="/csrf-form">
                @csrf
                <input type="text" name="myText"/>
                <input type="submit"/>
            </form>
        </body>
        </html>
        ~~~
        - `@csrf` is a `Blade directive`
    - Open address in browser:
        - `http://127.0.0.1:8000/csrf`
    - If you load this route and inspect the rendered view you can see a hidden input like this:
        ~~~html
        <input type="hidden" name="_token" value="PFIGvtmC13ExEs513knyNPGRyzz8Q3ACVhOVkEIQ">
        ~~~
## Laravel + JavaScript + X-CSRF-TOKEN
- [ ] TODO: Document this

## Laravel + X-XSRF-TOKEN
- [ ] TODO: Document this
___
- [ ] TODO: Read [this document](https://laravel.com/docs/5.6/csrf) again for `X-CSRF-TOKEN` and `X-XSRF-TOKEN`
- [ ] TODO: Read more about CSRF attacks and examples