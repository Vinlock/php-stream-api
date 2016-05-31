PHP API Wrapper for multiple streaming services. Currently supporting Twitch.tv and Hitbox.tv.


## Install via Composer

```
$ composer require vinlock/stream-api
```

## Usage

### Merging games.
```php
$twitch = \Vinlock\StreamAPI\Services\Twitch::game("Dota 2");

$hitbox = \Vinlock\StreamAPI\Services\Hitbox::game("Dota 2");

$merge = \Vinlock\StreamAPI\Services\Service::merge($twitch, $hitbox);

echo $merge->getJSON(); // Displays all streams from highest to lowest viewers for Dota 2 on Twitch and Hitbox.
```
Merge as many games as you want...
```php
$bladeandsoul_twitch = \Vinlock\StreamAPI\Services\Twitch::game("Blade and Soul");
$bladeandsoul_hitbox = \Vinlock\StreamAPI\Services\Hitbox::game("Blade and Soul");
$overwatch_twitch = \Vinlock\StreamAPI\Services\Twitch::game("Overwatch");
$overwatch_hitbox = \Vinlock\StreamAPI\Services\Hitbox::game("Overwatch");

$merge = \Vinlock\StreamAPI\Services\Service::merge(
    $bladeandsoul_twitch,
    $bladeandsoul_hitbox, 
    $overwatch_twitch, 
    $overwatch_hitbox
);

echo $merge->getJSON();
```

### From Usernames
Results will only show for online users.
```php
$twitch = new \Vinlock\StreamAPI\Services\Twitch("vinlockz");
$hitbox = new \Vinlock\StreamAPI\Services\Hitbox("vinlock");

$merge = \Vinlock\StreamAPI\Services\Service::merge($twitch, $hitbox);

echo $merge->getJSON();     // Displays the information for all streams merged as JSON.
echo $merge->getArray();    // Array
echo $merge->getObject();   // Object
```

## Example JSON
