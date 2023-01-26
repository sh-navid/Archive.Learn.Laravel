# PHP and Composer Installation
***Disclaimer*: The content described in this article are for educational purposes only.**
---
- Windows
    - Download [php](https://www.php.net/)
    - Download [Composer](https://getcomposer.org/)
        >> Is a dependency management tool for PHP
- Ubuntu
    - Run this command
        - `sudo apt install php-cli`
    - Continue installation process of [Composer](https://getcomposer.org/download/) for linux
    - After running above instruction you should have `composer.phar` in your working directory
    - Now you can run composer `./composer.phar`

# Laravel Installation
- Open a Terminal and Type
    - Windows
        - `composer create-project laravel/laravel my-app`
    - Ubuntu
        - `./composer.phar create-project laravel/laravel my-app`
- Redirect to `my-app` using this command
    - `cd my-app`
- Run the application
    - `php artisan serve`