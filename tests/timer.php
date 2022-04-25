<?php

use Debugger\Debug;

function autoload( string $class ) {
    $class_name = $class;
    $path = realpath( __DIR__ . '/../src/' );
    $class = str_replace( 'Debugger', '', $class );
    $require_path = str_replace( '\\', '/', $path. $class );
    require_once $require_path . '.php';

    /**
     * THIS IS REQUIRED FOR PAGE AUTOLOAD
     */
    if ( method_exists( $class_name, '__constructStatic' ) ) {
        $class_name::__constructStatic();
    }
}

spl_autoload_register( 'autoload' );


Debug::$timer->start();

sleep( 1 );

Debug::$timer->timestamp();
sleep( 2 );

Debug::$timer->timestamp( 'Second Timestamp' );
sleep( 1 );

Debug::$timer->timestamp();
sleep( 3 );

Debug::$timer->timestamp( 'Last Timestamp' );

Debug::$timer->end( true );
