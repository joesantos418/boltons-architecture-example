# boltons-architecture-example
An example of the PHP architecture used at Arquivei.

To run the tests, install the dependencies:

`user@machine:checkout-path/boltons-architecture-example$ composer install`

Then run the following:

`user@machine:checkout-path/boltons-architecture-example$ ./vendor/bin/phpunit -c phpunit.xml`

You can check the coverage report by running (requires phpdbg):

`user@machine:checkout-path/boltons-architecture-example$ phpdbg -qrr ./vendor/bin/phpunit -c phpunit.xml --coverage-html coverage`

Open the coverage/index.html file in your browser to see the report.
