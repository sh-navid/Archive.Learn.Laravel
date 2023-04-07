# Laravel

## Composer - Milon

- `composer require milon/barcode`
- Check `composer.json`
  - `"milon/barcode": "^10.0"`
- Register barcode library in `config/app.php`
  - ~~~php
      'providers' => [
             Milon\Barcode\BarcodeServiceProvider::class
      ]
      'aliases' => Facade::defaultAliases()->merge([
            'DNS1D' => Milon\Barcode\Facades\DNS1DFacade::class,
            'DNS2D' => Milon\Barcode\Facades\DNS2DFacade::class,
      ])->toArray(),
    ~~~
- `web.php`
    - `Route::view('/barcode',  "barcode");`
- `barcode.blade.php`
    - ~~~php
        <!DOCTYPE html>
        <html>
        <body>
                {!! DNS2D::getBarcodeHTML('2121', 'QRCODE') !!}
                {!! DNS1D::getBarcodeHTML('2121', 'PHARMA') !!}     
        </body>
        </html>
      ~~~
