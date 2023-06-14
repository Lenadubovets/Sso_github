## GitHub SSO-enabled Laravel Application

1.Start ngrok

-   [visit](https://ngrok.com).

2. Create a new Laravel project:

composer create-project --prefer-dist laravel/laravel github-sso-app

3. Configure your database:
   Update the database connection details in the .env file with your database credentials.

Set up GitHub OAuth application:

[Go to the GitHub Developer Settings page](https://github.com/settings/developers).
Click on "New OAuth App" and fill in the details:
Application Name: Your app name
Homepage URL: The URL of your Laravel app
Authorization callback URL: {ngrok-url}/login/github/callback
After creating the app, note down the Client ID and Client Secret.

4. Install Laravel Socialite:
   Laravel Socialite provides a simple way to authenticate with OAuth providers. Install it via Composer:

composer require laravel/socialite

5. Configure Laravel Socialite:
   In your Laravel app, open config/services.php and add the following configuration for GitHub:

'github' => [
'client_id' => env('GITHUB_CLIENT_ID'),
'client_secret' => env('GITHUB_CLIENT_SECRET'),
'redirect' => env('GITHUB_REDIRECT_URI'),
],

6. Update environment variables:
   In the .env file, add the following lines and fill in the values you obtained from the GitHub OAuth application:

GITHUB_CLIENT_ID=your-github-client-id
GITHUB_CLIENT_SECRET=your-github-client-secret
GITHUB_REDIRECT_URI={ngrok-url}/login/callback

7. Create routes:
   Open the routes/web.php file and add the following routes:

Route::get('/logingit', function () {
return Socialite::driver('github')->redirect();
})->name('logingit');

Route::get('/login/callback', function () {
$user = Socialite::driver('github')->user();
    dd($user);
// Handle the authenticated user
// e.g., create a new user or log in an existing user
// based on the received user information

    // Redirect the user to the desired location
    return redirect('/dashboard');

})->name('login.callback');
