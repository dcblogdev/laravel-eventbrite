## Community

There is a Discord community. https://discord.gg/VYau8hgwrm For quick help, ask questions in the appropriate channel.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/dcblogdev/laravel-eventbrite.svg?style=flat-square)](https://packagist.org/packages/dcblogdev/laravel-eventbrite)
[![Total Downloads](https://img.shields.io/packagist/dt/dcblogdev/laravel-eventbrite.svg?style=flat-square)](https://packagist.org/packages/dcblogdev/laravel-eventbrite)

![Logo](https://repository-images.githubusercontent.com/242608028/89897400-49bf-11eb-8870-028ccfbcc7b2)

A Laravel package for working with Eventbrite. In order to use this package you must have a Eventbrite application created at https://www.eventbrite.com/platform/

Eventbrite API documentation can be found at:
https://www.eventbrite.com/platform/docs/introduction

# Application Register
To use Eventbrite API an application needs creating at https://www.eventbrite.co.uk/account-settings/apps

Click the Create API Key button then fill in the form

# Install

Via Composer

```
composer require dcblogdev/laravel-eventbrite
```

## Config

You can publish the config file with:

```
php artisan vendor:publish --provider="Dcblogdev\Eventbrite\EventbriteServiceProvider" --tag="config"
```

When published, the config/box.php config file contains:

```
return [
    'key' => env('EVENTBRITE_KEY'),
    'org' => env('EVENTBRITE_ORG_ID'),
];
```

.ENV Configuration
You should add the env variables to your .env file, this allows you to use a different application on different servers.

```
EVENTBRITE_KEY needs your application key

EVENTBRITE_ORG_ID can be used to set your organisation.

EVENTBRITE_KEY=
EVENTBRITE_ORG_ID=
```

## Usage

Import Namespace

```php
use Dcblogdev\Eventbrite\Facades\Eventbrite;
```

A routes example:

```php
Route::get('eventbrite', function() {

    //get all events
    Eventbrite::events(); 
    
});
```

Calls can be made by referencing Eventbrite:: then the verb get,post,put,patch or delete followed by the end point to call. An array can be passed as a second option.

The end points are relative paths after https://www.eventbriteapi.com/v3/

Example GET request

```php
Eventbrite::get('users/me/organizations');
```

The formula is:

```php
Eventbrite::get('path', $array);
Eventbrite::post('path', $array);
Eventbrite::put('path', $array);
Eventbrite::patch('path', $array);
Eventbrite::delete('path', $array);
```

## Change log

Please see the [changelog][3] for more information on what has changed recently.

## Contributing

Contributions are welcome and will be fully credited.

Contributions are accepted via Pull Requests on [Github][4].

## Pull Requests

- **Document any change in behaviour** - Make sure the `readme.md` and any other relevant documentation are kept up-to-date.

- **Consider our release cycle** - We try to follow [SemVer v2.0.0][5]. Randomly breaking public APIs is not an option.

- **One pull request per feature** - If you want to do more than one thing, send multiple pull requests.

## Security

If you discover any security related issues, please email dave@dcblog.dev email instead of using the issue tracker.

## License

license. Please see the [license file][6] for more information.

[3]:    changelog.md
[4]:    https://github.com/dcblogdev/laravel-eventbrite
[5]:    http://semver.org/
[6]:    license.md
