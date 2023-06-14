# GitHub SSO-enabled Laravel Application

This repository provides a Laravel application with GitHub Single Sign-On (SSO) integration. The application allows users to log in using their GitHub accounts.

## Prerequisites

-   [ngrok](https://ngrok.com) - A tool for exposing local servers over the internet.

## Installation

1.  Start ngrok to expose your local Laravel app:

    ```bash
    ngrok http http://localhost:8000

    ```

2.  Create a new Laravel project:
    composer create-project --prefer-dist laravel/laravel github-sso-app

3.  Configure your database:
    Update the database connection details in the .env file with your database credentials.

4.  Set up GitHub OAuth application

    Go to the GitHub Developer Settings page (https://github.com/settings/developers).

    Click on "New OAuth App" and fill in the details:

    -   Application Name: Your app name
        -Homepage URL: The URL of your Laravel app
        -Authorization callback URL: {ngrok-url}/login/github/callback

    After creating the app, note down the Client ID and Client Secret.

5.  Install and configure Laravel Socialite

    Install Laravel Socialite via Composer: composer require laravel/socialite

6.  Configure Laravel Socialite:open config/services.php in your Laravel app and add the following configuration for GitHub:
    php

        'github' => [
            'client_id' => env('GITHUB_CLIENT_ID'),
            'client_secret' => env('GITHUB_CLIENT_SECRET'),
            'redirect' => env('GITHUB_REDIRECT_URI'),
        ],

7.  Update environment variables
    In the .env file, add the following lines and fill in the values you obtained from the GitHub OAuth application:

    GITHUB_CLIENT_ID=your-github-client-id
    GITHUB_CLIENT_SECRET=your-github-client-secret
    GITHUB_REDIRECT_URI={ngrok-url}/login/callback

## Usage

1. Create the following routes in routes/web.php:

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

  <p class="has-line-data" data-line-start="5" data-line-end="6">To get started with the app, clone the repository and install the dependencies:</p>
<pre><code class="has-line-data" data-line-start="8" data-line-end="12" class="language-sh">git <span class="hljs-built_in">clone</span> https://github.com/Lenadubovets/Sso_github
