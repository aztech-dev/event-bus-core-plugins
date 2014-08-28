# File plugin

## Dependencies

  * No dependencies *

## Supported elements :

  * Persistant publishing
  * Subscribe

## Configuration options & defaults

| Parameter | Default | Description |
|--------------|-------------|-------------------------------------------------------------------------------------------|
| `file` | **Required** | Path to the file used as a queue. |

## Usage

```php

use \Aztech\Events\Event;
use \Aztech\Events\Bus\Events;
use \Aztech\Events\Bus\Plugins;

include __DIR__ . '/vendor/autoload.php';

Plugins::loadFilePlugin('file');

$options = array('file' => '/tmp/events.queue');
$publisher = Events::createPublisher('file', $options);

// Create and publish an event.
$event = Events::create('event.topic', array('property' => 'value'));
$publisher->publish($event);

$application = Events::createApplication('file', $options);
$application->on('#', function(Event $event) {
    echo $event->getCategory() . ' : received event #' . $event->getId();
});

// This call is blocking
$application->run();

```

## Caveats

At the time being, the AMQP event plugin uses topic based routing to publish events. Multiple nodes connecting to a single queue will work in round-robin mode.

It is possible to use different routing scenarios/exchange types, but that is left as an exercise to the reader (Hint: no need to build/patch the current plugin).
