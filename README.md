![sample](/public/images/sample.png)

# Nifty Dash
Administration dashboard built with Laravel and Vue


# Create a user

php artisan tinker
$user = new App\User
$user->name = 'admin'
$user->email = 'admin@example.com'
$user->password = Hash::make('password')
$user->save()

