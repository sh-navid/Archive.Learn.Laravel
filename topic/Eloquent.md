# Laravel
## Eloquent
### Foreign Id, Join
- Update `User` migration
- Make both model and migration for `Post`
    - `php artisan make:model Post -m`
- Revert all migrations and then run them again.
    - `php artisan migrate:fresh`