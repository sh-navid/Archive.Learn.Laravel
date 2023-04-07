# Laravel
## Factory
- `php artisan make:Model Cake -m`
    - Go to `migration` and fill
        - ~~~php
            public function up()
            {
                Schema::create('cakes', function (Blueprint $table) {
                    $table->id();
                    $table->string("name");
                    $table->integer("price");
                    $table->timestamps();
                });
            }
        ~~~
- `php artisan migrate`
- `php artisan make:factory CakeFactory`