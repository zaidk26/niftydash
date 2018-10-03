![sample](/public/images/sample.png)

# Nifty Dash
Starting point Administration dashboard built with Laravel and Vue

Use as you please


# Create a user

php artisan tinker
$user = new App\User
$user->name = 'admin'
$user->email = 'admin@example.com'
$user->password = Hash::make('password')
$user->save()

