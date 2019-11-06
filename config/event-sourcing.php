<?php

use App\Events\OrderWasDelivered;
use App\Events\OrderWasPaid;
use App\Events\OrderWasPlaced;
use App\Events\OrderWasRefunded;
use App\Events\OrderWasShipped;
use App\Serializers\EventSerializer;
use App\Serializers\OrderWasDeliveredSerializer;
use App\Serializers\OrderWasPaidSerializer;
use App\Serializers\OrderWasPlacedSerializer;
use App\Serializers\OrderWasRefundedSerializer;
use App\Serializers\OrderWasShippedSerializer;
use Spatie\EventSourcing\EventSerializers\JsonEventSerializer;

return [

    /*
     * These directories will be scanned for projectors and reactors. They
     * will be registered to Projectionist automatically.
     */
    'auto_discover_projectors_and_reactors' => [
        app_path(),
    ],

    /*
     * Projectors are classes that build up projections. You can create them by performing
     * `php artisan event-sourcing:create-projector`. When not using auto-discovery,
     * Projectors can be registered in this array or a service provider.
     */
    'projectors' => [
        // App\Projectors\YourProjector::class
    ],

    /*
     * Reactors are classes that handle side-effects. You can create them by performing
     * `php artisan event-sourcing:create-reactor`. When not using auto-discovery
     * Reactors can be registered in this array or a service provider.
     */
    'reactors' => [
        // App\Reactors\YourReactor::class
    ],

    /*
     * A queue is used to guarantee that all events get passed to the projectors in
     * the right order. Here you can set of the name of the queue.
     */
    'queue' => env('EVENT_PROJECTOR_QUEUE_NAME', null),

    /*
     * When a Projector or Reactor throws an exception the event Projectionist can catch it
     * so all other projectors and reactors can still do their work. The exception will
     * be passed to the `handleException` method on that Projector or Reactor.
     */
    'catch_exceptions' => env('EVENT_PROJECTOR_CATCH_EXCEPTIONS', false),

    /*
     * This class is responsible for storing events in the EloquentStoredEventRepository.
     * To add extra behaviour you can change this to a class of your own. It should
     * extend the \Spatie\EventSourcing\Models\EloquentStoredEvent model.
     */
    'stored_event_model' => \Spatie\EventSourcing\Models\EloquentStoredEvent::class,

    /*
     * This class is responsible for storing events. To add extra behaviour you
     * can change this to a class of your own. The only restriction is that
     * it should implement \Spatie\EventSourcing\StoredEventRepository.
     */
    'stored_event_repository' => \Spatie\EventSourcing\EloquentStoredEventRepository::class,

    /*
     * This class is responsible for handling stored events. To add extra behaviour you
     * can change this to a class of your own. The only restriction is that
     * it should implement \Spatie\EventSourcing\HandleDomainEventJob.
     */
    'stored_event_job' => \Spatie\EventSourcing\HandleStoredEventJob::class,

    /*
     * Similar to Relation::morphMap() you can define which alias responds to which
     * event class. This allows you to change the namespace or classnames
     * of your events but still handle older events correctly.
     */
    'event_class_map' => [
    ],

    // Mapping_2
    //'event_class_map' => [
    //    'order_was_placed' => OrderWasPlaced::class,
    //    'order_was_paid' => OrderWasPaid::class,
    //    'order_was_shipped' => OrderWasShipped::class,
    //    'order_was_delivered' => OrderWasDelivered::class,
    //    'order_was_refunded' => OrderWasRefunded::class,
    //],

    /*
     * This class is responsible for serializing events. By default an event will be serialized
     * and stored as json. You can customize the class name. A valid serializer
     * should implement Spatie\EventSourcing\EventSerializers\Serializer.
     */
    'event_serializer' => JsonEventSerializer::class,

    // Mapping 2
    //'event_serializer' => EventSerializer::class,

    /*
    * This array is responsible for mapping the serializer with its own event.
    * In order to customize the serialization behaviour for each event we need to specify how do we want to map it.
    */
    'event_class_serializer_map' => [
        OrderWasPlacedSerializer::class => OrderWasPlaced::class,
        OrderWasPaidSerializer::class => OrderWasPaid::class,
        OrderWasShippedSerializer::class => OrderWasShipped::class,
        OrderWasDeliveredSerializer::class => OrderWasDelivered::class,
        OrderWasRefundedSerializer::class => OrderWasRefunded::class,
    ],


    /*
     * When replaying events, potentially a lot of events will have to be retrieved.
     * In order to avoid memory problems events will be retrieved as chunks.
     * You can specify the chunk size here.
     */
    'replay_chunk_size' => 1000,

    /*
     * In production, you likely don't want the package to auto-discover the event handlers
     * on every request. The package can cache all registered event handlers.
     * More info: https://docs.spatie.be/laravel-event-sourcing/v1/advanced-usage/discovering-projectors-and-reactors
     *
     * Here you can specify where the cache should be stored.
     */
    'cache_path' => storage_path('app/event-sourcing'),
];
