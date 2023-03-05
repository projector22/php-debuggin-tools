<?php

namespace Debugger;

use Debugger\Tools\Js;
use Debugger\Tools\Cmd;
use Debugger\Tools\Data;
use Debugger\Tools\Log;
use Debugger\Tools\Lorium;
use Debugger\Tools\Timing;
use Debugger\Tools\DisplayData;

/**
 * Class for providing a number of Debugging tools.
 * 
 * @author  Gareth Palmer  [Github & Gitlab /projector22]
 * 
 * @version 1.0.0
 */

class Debug {

    /**
     * Object for using timing tools.
     * 
     * @var Timing  $timer
     * 
     * @static
     * @access  private
     * @since   1.0.0
     */

    private static Timing $timer;

    /**
     * Object for using display tools.
     * 
     * @var DisplayData  $display
     * 
     * @access  public
     * @since   1.0.0
     */

    public static DisplayData $display;

    /**
     * Object for using a lorium generator tools.
     * 
     * @var Lorium  $lorium
     * 
     * @access  public
     * @since   1.0.0
     */

    public static Lorium $lorium;

    /**
     * Object for using a number of terminal tools.
     * 
     * @var Cmd  $cmd
     * 
     * @access  public
     * @since   1.0.1
     */

    public static Cmd $cmd;

    /**
     * Object for using a number of javascript tools.
     * 
     * @var Js  $js
     * 
     * @access  public
     * @since   1.0.1
     */

    public static Js $js;

    /**
     * Object for using a number of logging tools.
     * 
     * @var Log  $log
     * 
     * @access  public
     * @since   1.0.1
     */

    public static Log $log;


    /**
     * Constructor method, should be placed in the autoloader or called 
     * before any of the properties above are called.
     * 
     * @access  public
     * @since   1.0.0
     * 
     * @deprecated  1.1.0 - all properties should be set to private and called
     *                      & instanciated through methods in this class.
     */
    
    public static function __constructStatic() {
        // self::$timer   = new Timing;
        self::$display = new DisplayData;
        self::$lorium  = new Lorium;
        self::$cmd     = new Cmd;
        self::$js      = new Js;
        self::$log     = new Log;
    }


    public static function data( mixed ...$data ): Data {
        $data_container = new Data;
        $data_container->append_to_data_objects( $data );
        return $data_container;
    }


    public static function timer(): Timing {
        if ( !isset( self::$timer ) ) {
            self::$timer = new Timing;
        }
        return self::$timer;
    }


    /**
     * Display out data from $_GET, $_POST, $_SERVER & $_SESSION.
     * 
     * @access  public
     * @since   1.0.0
     */

    public static function page_data(): void {
        if ( session_status() == PHP_SESSION_NONE ) {
            session_start();
        }
        echo <<<HTML
<style>
    .debug_table_page_data {
        min-width: 600px;
        border-collapse: collapse;
        border: 1px solid black;
    }

    .debug_table_page_data tr td,
    .debug_table_page_data tr th {
        border: 1px solid black;
    }
    .debug_table_page_data tr:nth-child(even) {
        background-color: lightgrey;
    }
    .debug_table_page_data tr:hover {
        background-color: #4CAF50;
        color: white;
    }
</style>
HTML;
        $entries = [
            'GET'     => $_GET,
            'POST'    => $_POST,
            'SERVER'  => $_SERVER,
            'SESSION' => $_SESSION,
        ];
        foreach ( $entries as $index => $entry ) {
            echo "<h1>{$index}</h1>";
            if ( count( $entry ) == 0 ) {
                continue;
            }
            echo "<table class='debug_table_page_data'>";
            echo "<tr>
            <th>Key</th>
            <th>Value</th>
            </tr>";
            foreach ( $entry as $key => $value ) {
                echo "<tr>";
                echo "<td>{$key}</td>";
                echo "<td>";
                if ( is_array( $value) || is_object( $value ) ) {
                    echo json_encode( $value, JSON_PRETTY_PRINT );
                } else {
                    echo $value;
                }
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }

}