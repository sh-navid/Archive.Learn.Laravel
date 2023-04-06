# Laravel
## File Upload
- Create a view
    - `upload.blade.php`
- Make a route in `web.php`
    - ~~~php
        Route::get('/upload', function () {
            return view("upload");
        });
      ~~~
- Make a controller
    - `php artisan make:controller UploadController`