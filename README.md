# Activity Package for Laravel 4

Activity is a activity/news feed system for Laravel 4 applications.

## Installation via Composer

Add this to you composer.json file, in the require object:

```javascript
"dmyers/laravel-activity": "dev-master"
```

After that, run composer install to install Activity.

Add the service provider to `app/config/app.php`, within the `providers` array.

```php
'providers' => array(
    // ...
    'Dmyers\Activity\ActivityServiceProvider',
)
```

Add a class alias to `app/config/app.php`, within the `aliases` array.

```php
'aliases' => array(
    // ...
    'Activity' => 'Dmyers\Activity\Activity',
)
```

Publish the package's model, migration, and view.

```console
php artisan model:publish dmyers/laravel-activity
php artisan migration:publish dmyers/laravel-activity
php artisan view:publish dmyers/laravel-activity
```

Finally, add the trait to the models you want to track activity on.

```php
use ActivityTrait;

protected $activity_item_field = 'id';

protected $activity_doer_field = 'user_id';

protected $activity_events = array('created', 'updated', 'deleted');

protected $activity_feed_type = 'user';
```

## Usage

First get an instance of an item type (model):

```php
$object = Model::find(1);
```

Fetch all the activity:

```php
$object->activity(array(
	'id'        => $activity_id, // optional
	'doer_id'   => $doer_id, // optional
	'victim_id' => $victim_id, // optional
	'item_id'   => $item_id, // optional
	'item_type' => $item_type, // optional
	'feed_type' => $feed_type, // optional
));
```

Track an activity event:

```php
$object->addActivity($item_type, $doer_id, $victim_id, $action);
```

Update an activity event:

```php
$object->updateActivity($item_type, $doer_id, $victim_id, $action);
```

Delete an activity event:

```php
$object->deleteActivity($item_type, $doer_id, $victim_id, $action);
```

Display an activity feed:

```php
$object->renderActivityFeed($type, $doer_id, $victim_id);
```

Push a feed into another activity feed:

```php
$object->pushActivityFeed($type, $doer_id, $victim_id);
```