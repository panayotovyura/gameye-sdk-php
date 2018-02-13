![Gameye](https://gameye.com/img/logo_blue.png)

# Gameye SDK for PHP #

[![Latest Stable Version](https://poser.pugx.org/Gameye/gameye-sdk-php/v/stable)](https://packagist.org/packages/gameye/gameye-sdk-php)
[![Total Downloads](https://poser.pugx.org/Gameye/gameye-sdk-php/downloads)](https://packagist.org/packages/gameye/gameye-sdk-php)
[![License](https://poser.pugx.org/gameye/gameye-sdk-php/license)](https://packagist.org/packages/gameye/gameye-sdk-php)

Create eSport and competitive matches for Counter-Strike: Global Offensive, Team Fortress 2, Left 4 Dead 2, Killing Floor 2, Insurgency and Day of Infamy for your platform without fixed monthly costs or any need for your own server infrastructure. Simply implement the Gameye API to kick off online matches when you need the, - you will even be able to implement the scores/statistics directly on your website. How cool is that!

## Requirements ##

To use the Gameye SDK, the following prerequisites need to be fulfilled:

+ Obtain a free Gameye API key, please send us [an email](mailto:support@gameye.com)
+ Composer
+ PHP 5.6.4+ or newer
+ PHP cURL extension

## Installation ##

The easiest way to install the Gameye SDK is to require it with [Composer](http://getcomposer.org/doc/00-intro.md).

    $ composer require gameye/gameye-sdk-php

    {
        "require": {
            "gameye/gameye-sdk-php": "1.*"
        }
    }

You may also git checkout or [download all the files](https://github.com/Gameye/gameye-sdk-php/archive/master.zip), and include the Gameye SDK client manually.

## Getting started ##

1. Use the Gameye SDK to create a match with your desired game-specific options. It's important to specify an unique ID in order to be able to retrieve the details when the match has been created.

2. After the first player has joined the match, the status will change from `waiting` to `playing`. At this point it will be possible to retrieve statistics and scores from the match.

3. After the match has ended our platform will post a request to your webhook to let you know the match is done.


Initialize the Gameye API client and set your API key.

```php
$gameye = new \Gameye\SDK\createGameyeClient([
            'AccessToken' => 'yourgameyeapitoken',
            'ApiEndpoint' => 'https://api.gameye.com',
        ]);
```

Create a match.

```php
$gameye->commandStartMatch([
    'matchKey'     => 'yourmatchid',
    'locationKeys' => [1],
    'gameKey'      => 'csgo',
    'templateKey'  => 'esl1on1',
    'config'      => [
        'steamToken' => 'yoursteamgameservertoken',
        'maxPlayers' => 12,
        'maxRounds'  => 15,
        'tickRate'   => 128,
        'map'        => 'de_dust2',
    ],
    'endCallbackUrl' => 'https://platform.com/match?id=yourmatchid'
]);
```

_After creating the match, the server details will be available via the `GetMatch` function._
_When the match has been ended we will make a GET request to your callback url so you can fetch the match results._

Create a match with a custom (Steam Workshop) map.  
Remove the map parameter from the config array and add the following two parameters.  
  

```php
'config' => [
    'workshopMap' => 'workshopid',
    'authkey'     => 'yoursteamwebapikey'
],
```
You can find the id of a custom map at the end of a [Steam Workshop URL](https://steamcommunity.com/workshop/browse/?appid=730).

Get a list of all available games and locations we support.
```php
$gameye->queryGame();
```

Get a list of all available templates (configuration files) for a game.
```php
$gameye->queryTemplate($gameKey);
```

Get a detailed list of all your active matches.
```php
$gameye->queryMatch();
```

Stop a match.
```php
$gameye->commandStopMatch([
    'matchKey' => $matchKey,
]);
```

## Create a Steam Server Login Token ##

We made a helper function to make it easier for you to create a GSLT (Game Server Login Token) via the Steam WEB API. It is strongly recommended to create a fresh token for every match and delete the token after the match has ended. This is advisable because every Steam account is limited to a maximum of 1000 tokens. Passing a GSLT when starting a match is currently only required for CS:GO. For more information see the [Steam website](https://steamcommunity.com/dev/managegameservers).

```php
$steam = new \Gameye\SDK\SteamClient([
            'WebToken' => 'webtoken',
        ]);

$steam->GameServersService->CreateAccountV1($appid, $memo);
```
You can create a Steam Web API key on the [Steam website](https://steamcommunity.com/dev/apikey).

The APP id that you should include for CS:GO is 730


## Examples ##

We have created an example implementation of this SDK based on the Laravel framework which implements all functions provided here, this should show you how to create a basic backend and how to create and manage matches via our API.

+ [Example implementation in Laravel](https://github.com/Gameye/gameye-sdk-example-laravel).

## Contributing ##
We encourage everyone to help us improve our public packages. If you want to contribute please submit a [pull request](https://github.com/Gameye/gameye-sdk-php/pulls).

## License ##
[BSD (Berkeley Software Distribution) License](https://opensource.org/licenses/bsd-license.php). 2017 Gameye B.V.

## Support ##
Contact: [gameye.com](https://gameye.com) — support@gameye.com


## automated tests
NEVER commit something that breaks the build! If you do, you suck. You can
easily prevent this by linking the `test.sh` script as a git `pre-push` or
`pre-commit` hook!

like this:
```bash
ln test.sh .git/hooks/pre-commit
```

If you use a git commit hook for testing, you may also bypass this hook with
the `--no-verify` or `-n` option of git commit, like this:
```bash
git commit -nm'some commit message'
```
