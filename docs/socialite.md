# Socialite

[Back to README](../README.md)

## Get Socialite Login API Keys

- [Google Captcha API](https://www.google.com/recaptcha/admin#list)
- [Facebook API](https://developers.facebook.com/)
- [Twitter API](https://apps.twitter.com/)
- [Google &plus; API](https://console.developers.google.com/)
- [GitHub API](https://github.com/settings/applications/new)
- [YouTube API](https://developers.google.com/youtube/v3/getting-started)
- [Twitch TV API](https://www.twitch.tv/kraken/oauth2/clients/new)
- [Instagram API](https://instagram.com/developer/register/)
- [37 Signals API](https://github.com/basecamp/basecamp-classic-api)

## Add More Socialite Logins

- See full list of providers: [https://socialiteproviders.github.io](https://socialiteproviders.github.io/#providers)

### Steps

1. Go to [https://socialiteproviders.github.io](https://socialiteproviders.github.io/providers/twitch/) and select the provider to be added.
2. From the projects root folder, in the terminal, run composer to get the needed package.

    - Example:

    ```
       composer require socialiteproviders/twitch
    ```

3. From the projects root folder run `composer update`
4. Add the service provider to `/config/services.php`

    - Example:

    ```
       'twitch' => [
           'client_id'   => env('TWITCH_KEY'),
           'client_secret' => env('TWITCH_SECRET'),
           'redirect'    => env('TWITCH_REDIRECT_URI'),
       ],
    ```

5. Add the API credentials to `/.env`

    - Example:

    ```
       TWITCH_KEY=YOURKEYHERE
       TWITCH_SECRET=YOURSECRETHERE
       TWITCH_REDIRECT_URI=http://YOURWEBSITEURL.COM/social/handle/twitch
    ```

6. Add the social media login link:

    - Example:
      In file `/resources/views/auth/login.blade.php` add ONE of the following:

        - Conventional HTML:

        ```
        <a href="{{ route('social.redirect', ['provider' => 'twitch']) }}" class="btn btn-lg btn-primary btn-block twitch">Twitch</a>
        ```

        - Use Laravel HTML Facade with [Laravel Collective](https://laravelcollective.com/):

        ```
        {!! html()->a(route('social.redirect', ['provider' => 'twitch']), 'Twitch', array('class' => 'btn btn-lg btn-primary btn-block twitch')) !!}
        ```

## Other API keys

- [Google Maps API v3 Key](https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key)
