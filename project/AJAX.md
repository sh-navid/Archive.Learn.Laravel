# Laravel
## Ajax
- `php artisan make:controller AjaxController`
    - ~~~php

      ~~~~
- `ajax.blade.php`
    - ~~~php

      ~~~~
- `web.php`
    - ~~~php
        Route::get('/ajaxcall', [AjaxController::class, 'call']);
      ~~~~