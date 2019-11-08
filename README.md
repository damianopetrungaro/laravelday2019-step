Step 1

Spin up your DB!

Install laravel-event-sourcing

    - php composer.phar require spatie/laravel-event-sourcing
    - php artisan vendor:publish
    - run migrations

Create the domain events (do not use value objects :P)

    - app/Events/OrderWasDelivered.php
    - app/Events/OrderWasPaid.php
    - app/Events/OrderWasPlaced.php
    - app/Events/OrderWasRefunded.php
    - app/Events/OrderWasShipped.php

Add a command to play with the events

    - php artisan make:command Interact
    - use handle1
    - discuss issues (event_class column)

Add mapping to the event-sourcing.php file at the key `event_class_map` (see diff)

    - use handle2
    - discuss issues (event_properties column)

Add a serializer

    - use handle2
    - discuss issues (event_properties column)

Add serializers

    - app/Serializers/Exception/...
    - app/Serializers/EventSerializer.php
    - app/Serializers/OrderWasDeliveredSerializer.php
    - app/Serializers/OrderWasPaidSerializer.php
    - app/Serializers/OrderWasPlacedSerializer.php
    - app/Serializers/OrderWasRefundedSerializer.php
    - app/Serializers/OrderWasShippedSerializer.php
    - use handle1

Cool so far!


Step 2

Add Value Object

    - app/ValueObjects/Exception/...
    - app/ValueObjects/Address.php
    - app/ValueObjects/BookDetails.php
    - app/ValueObjects/BookID.php
    - app/ValueObjects/CustomerDetails.php
    - app/ValueObjects/CustomerID.php
    - app/ValueObjects/ID.php
    - app/ValueObjects/UserID.php
    
Refactor the domain event using ValueObject 

    - ...
    
Add the Aggregate

    - php artisan make:aggregate Order
    - add getter/setter in old fashion way
    - refactor using the domain events
    - add domain exceptions
    

