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
    
    
Step 3

Write operations!

Add Models + DB migrations ()

    - app/Models/...
    - database/seeds/...
    - database/migration/...
    - database/factories/...
    - run php artisan migrate
    - run php artisan db:seed
    
Add the UseCases

    - app/UseCases/PlaceOrder.php + Repository
    - app/UseCases/MarkOrderAsShipped.php + Repository
    - app/UseCases/MarkOrderAsDelivered.php
    - app/UseCases/MarkOrderAsPaid.php
    - app/UseCases/MarkOrderAsRefunded.php
    - app/UseCases/RefundOrder.php
    
Add HTTPController

    - app/HTTP/Middleware/Validation/... + app/Services/...
    - app/HTTP/Controllers/PlaceOrderController.php

Let's do an api call (we have no time for testing :P)

    - php artisan serve
    - change the IDs with the one added during the seed phase
    - Run curl:     
        ```
        curl -X POST \
        http://localhost:8000/api/orders \
        -H 'Accept: */*' \
        -H 'Accept-Encoding: gzip, deflate' \
        -H 'Cache-Control: no-cache' \
        -H 'Connection: keep-alive' \
        -H 'Content-Length: 701' \
        -H 'Content-Type: application/json' \
        -H 'Host: localhost:8000' \
        -H 'Postman-Token: e1593d0e-03fd-4b6a-a4a9-ae14d3126784,a56e60d2-5907-423d-a513-a584b47677ba' \
        -H 'User-Agent: PostmanRuntime/7.17.1' \
        -H 'cache-control: no-cache' \
        -d '{
        "book_title":"Book title",
        "book_author":"Book Author",
        "book_price_amount":"1000",
        "book_price_currency":"EUR",
        "book_id":"004773df-6551-3f6b-b2dd-1d823a67198b",
        "customer_id":"050a0ff4-196f-343d-80c7-97ac34b49135",
        "customer_first_name":"Damiano",
        "customer_last_name":"Petrungaro",
        "customer_billing_address":{
        "street":"Heynstrasse 16 A",
        "city":"Berlin",
        "state":"-",
        "country":"Germany",
        "ring_name":"Damiano P.",
        "zip_code":"14159"
        },
        "customer_delivery_address":{
        "street":"Heynstrasse 16 A",
        "city":"Berlin",
        "state":"-",
        "country":"Germany",
        "ring_name":"-",
        "zip_code":"14159"
        }
        }'
        ```

Add CLICommands

    - app/Console/Commands/...
    - Run some commands!

