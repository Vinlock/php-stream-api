## Connecting and Instantiating the Webgate
How to connect to the Platform Webgate API and make function based calls.
```php
$config = [
    'app_id' => 'APP_ID',
    'app_secret' => 'APP_SECRET',
    'server' => 'SERVER_IP:PORT'
];
 
$gpsessionID = $_COOKIE['GPSESSIONID'];
 
$webgate = new Webgate($config, $gpsessionID);
```

## Methods
### Get User Account
```php
$webgate->getUserAccount();
```
#### Sample Response
Response Type: `Object`
```json
{
  "user_id": "FCB9F684-7758-49E6-910E-F69FF6731DDB", # NPID
  "user_center": "3",
  "user_name": "Vinlock",
  "portal_name": "Vinlock",
  "user_status": "1",
  "login_name": "dwashbrook@ncsoft.com" # E-Mail Used to Login
}
```
`user_id` - NP ID   
`login_name` -

### Get Game Account
**Params:**

`$gameCode` - The game code associated with the game you are retrieving the account from. Example: `aion`, `wildstar`, `bns`
```php
$webgate->getGameAccount($gameCode);
```
#### Sample Response
Response Type: `Object`
```json
[
  "0": {
    "alias": "_200026035",
    "created": "2016-11-16 20:00:24.000 +09:00", # Account Creation Date/Time
    "game_account_id": "200026035" # Corresponding Game Account ID
  }
]
```

### Get Presences
**Params:**

`$gameCode` - The game code associated with the game you are retrieving the presence from. Example: `aion`, `wildstar`, `bns`
```php
$webgate->getPresences($gameCode);
```
#### Sample Response
Response Type: `Object`
```json
TODO
```

### Get Role IDs
```php
$webgate->getRoleID();
```
#### Sample Response
Response Type: `Object`
```json
TODO
```



