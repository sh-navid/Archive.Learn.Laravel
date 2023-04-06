# Laravel
## File Upload
- Create a view
    - `upload.blade.php`
    - ~~~php
        <!DOCTYPE html>
        <html lang="en">
        <body>
            <form action="/upload" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="myFile"/>
                <input type="submit"/>
            </form>
        </body>
        </html>
      ~~~
- Make a route in `web.php`
    - ~~~php
        Route::get('/upload', function () {
            return view("upload");
        });

        Route::post('/upload', [UploadController::class, "uploadFile"]);
      ~~~
- Make a controller
    - `php artisan make:controller UploadController`
    - ~~~php
        <?php

        namespace App\Http\Controllers;

        use Illuminate\Http\Request;

        class UploadController extends Controller
        {
            public function uploadFile(Request $request)
            {
                $file = $request->file('myFile');

                echo 'Name: ' . $file->getClientOriginalName();
                echo ' - Extension: ' . $file->getClientOriginalExtension();
                echo ' - Size: ' . $file->getSize();
                echo ' - Type: ' . $file->getMimeType();

                $file->move('uploads', $file->getClientOriginalName());
            }
        }
      ~~~
- You can see the uploaded file in `public/uploads`