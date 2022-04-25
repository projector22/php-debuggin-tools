# php-debuggin-tools

PHP Debugging tools

## Notes on Autoloading

The `Debug` class contains a bunch of static properties that link back various Tool classes. In order for this to function as expected, you need to either first call `Debug::__constructStatic()`, or more ideally, call it from your autoload function. For example.

```php
function autoload( string $class ) {
    /**
     * EXAMPLE
     */
    $path = realpath( __DIR__ . '/examplePath/' );
    $require_path = str_replace( '\\', '/', $path. $class );
    require_once $require_path . '.php';

    /**
     * THIS IS THE IMPORTANT BIT.
     * 
     * Check method `__constructStatic` exists and call it if so.
     */
    if ( method_exists( $class, '__constructStatic' ) ) {
        $class::__constructStatic();
    }
}
```
