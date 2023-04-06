# Laravel
## Ajax
- `php artisan make:controller AjaxController`
    - ~~~php
        <?php

        namespace App\Http\Controllers;

        use Illuminate\Http\Request;

        class AjaxController extends Controller
        {
            public function call(Request $request)
            {
                return "Hello from AJAX controller";
            }
        }
      ~~~~
- `ajax.blade.php`
    - ~~~php
        <!DOCTYPE html>
        <html lang="en">
        <body>
            <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
            <script>
            const call=()=>{
                $.ajax({
                    type:'POST',
                    url:'/ajaxcall',
                    headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                    success:(data)=> {
                        alert(data);
                    }
                    });
                }
            </script>
            <button onclick="call()">Click</button>
        </body>
        </html>
      ~~~~
- `web.php`
    - ~~~php
        Route::view('/ajax',    'ajax');
        Route::post('/ajaxcall', [AjaxController::class, 'call']);
      ~~~~