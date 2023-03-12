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
     * @static
     * @access  public
     * @since   1.0.0
     */

    public static DisplayData $display;

    /**
     * Object for holding the data dumping tool.
     * 
     * @var Data  $data
     * 
     * @static
     * @access  private
     * @since   1.1.0
     */

    private static Data $data;

    /**
     * Object for using a lorium generator tools.
     * 
     * @var Lorium  $lorium
     * 
     * @static
     * @access  public
     * @since   1.0.0
     */

    public static Lorium $lorium;

    /**
     * Object for using a number of terminal tools.
     * 
     * @var Cmd  $cmd
     * 
     * @static
     * @access  public
     * @since   1.0.1
     */

    public static Cmd $cmd;

    /**
     * Object for using a number of javascript tools.
     * 
     * @var Js  $js
     * 
     * @static
     * @access  private
     * @since   1.0.1
     */

    private static Js $js;

    /**
     * Object for using a number of logging tools.
     * 
     * @var Log  $log
     * 
     * @static
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
        // self::$js      = new Js;
        self::$log     = new Log;
    }


    /**
     * Generate and handle data of various kinds and returns the data object.
     * 
     * @param   mixed   ...$data    The data to handle.
     * 
     * @return  Data
     * 
     * @static
     * @access  public
     * @since   1.1.0
     */

    public static function data( mixed ...$data ): Data {
        if ( !isset( self::$data ) ) {
            self::$data = new Data;
        }
        self::$data->append_to_data_objects( $data );
        return self::$data;
    }


    /**
     * Generate and return the timer object.
     * 
     * @return  Timing
     * 
     * @static
     * @access  public
     * @since   1.1.0
     */

    public static function timer(): Timing {
        if ( !isset( self::$timer ) ) {
            self::$timer = new Timing;
        }
        return self::$timer;
    }


    /**
     * Generate and return the js object.
     * 
     * @return  Js
     * 
     * @static
     * @access  public
     * @since   1.1.0
     */

    public static function js(): Js {
        if ( !isset( self::$js ) ) {
            self::$js = new Js;
        }
        return self::$js;
    }


    /**
     * Display out data from $_GET, $_POST, $_SERVER & $_SESSION.
     * 
     * @access  public
     * @since   1.0.0
     * @since   1.1.0   Moved to `src/Debug.php`
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
        padding: 6px;
    }
    .dtpd_subkey {
        text-align: left;
    }
    .debug_table_page_data tr:nth-child(even) {
        background-color: lightgrey;
    }
    .debug_table_page_data tr:hover {
        background-color: #4CAF50;
        color: white;
    }
    .none-set {
        margin-bottom: 25px;
    }
</style>
HTML;
        $entries = [
            'GET'         => $_GET,
            'POST'        => $_POST,
            'SERVER'      => $_SERVER,
            'SESSION'     => $_SESSION,
            'ENVIRONMENT' => getenv(),
        ];
        foreach ( $entries as $index => $entry ) {
            echo "<h1>{$index}</h1>";
            if ( count( $entry ) == 0 ) {
                echo "<small>NONE SET</small>";
                echo "<hr class='none-set'>";
                continue;
            }
            echo "<table class='debug_table_page_data'>";
            echo "<tr>
            <th>Key</th>
            <th>Value</th>
            </tr>";
            foreach ( $entry as $key => $value ) {
                echo "<tr>";
                echo "<th class='dtpd_subkey'>{$key}</th>";
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
            echo "<hr>";
        }
    }


    /**
     * Display a block of text on the screen for demo or testing purposes
     * 
     * @param   int     $count  The number of times to perform this action
     *                          Default: 1
     * 
     * @access  public
     * @since   1.0.0
     */

     public function generate( int $count = 1 ): void {
        for ( $i = 0; $i < $count; $i++ ) {
            echo "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc id suscipit lorem. Aliquam erat volutpat. Quisque congue dapibus pulvinar. Maecenas viverra elementum velit. Suspendisse ullamcorper quis tortor sed aliquet. Vestibulum congue ligula semper arcu euismod egestas. Ut vel placerat sapien, sit amet lacinia nibh. Duis egestas orci nec est rutrum elementum. Suspendisse vel vulputate dolor. Donec dapibus lorem eget diam ornare, vitae feugiat nunc mattis. Curabitur vel congue mi, ut iaculis urna. Nullam non quam ultricies, pulvinar lorem sed, cursus nulla. Sed id vehicula leo. Cras ante massa, sagittis consectetur ipsum in, aliquet cursus dolor. Nulla facilisi. In quis molestie lorem.</p>
            <p>Suspendisse porta sollicitudin dolor non tincidunt. Duis eget vulputate ipsum, eu tincidunt justo. Ut eget tincidunt orci. Suspendisse ac quam et nulla interdum imperdiet non at ante. Aenean condimentum nec nisl vitae faucibus. Nam diam elit, finibus vel quam vel, luctus ultrices tellus. Phasellus in lorem vitae nisl gravida bibendum eget in ante. Sed maximus venenatis maximus. Aliquam rutrum, leo sed dignissim commodo, nisl nisi ultrices tellus, sed tempus urna tortor vel ante. Aliquam congue orci id tortor elementum, at tempus nulla egestas. Nunc mattis lacus id odio mollis, vitae lacinia massa ornare. Ut ultricies felis lacus, et mollis nunc eleifend sit amet. Quisque arcu sem, faucibus eu dolor in, pretium tempor dolor. Duis convallis auctor mi, in accumsan nibh rhoncus eget. Mauris at est libero.</p>
            <p>Cras justo mi, fringilla quis arcu sed, viverra congue quam. Duis rhoncus metus diam, quis fermentum leo dignissim eget. Nullam fringilla enim ac turpis vulputate dapibus. Aliquam quis dolor sapien. Duis a arcu mauris. Ut eget erat sagittis, efficitur mi sed, porta justo. Fusce porta purus convallis eleifend tempor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin vitae iaculis lacus. Sed in eleifend est. Quisque id nunc porttitor, accumsan massa in, sagittis elit. Phasellus auctor viverra iaculis.</p>
            <p>Etiam sed orci orci. Fusce semper leo vel ullamcorper vulputate. Duis id nibh eu dui sagittis malesuada. Mauris magna tortor, facilisis vitae augue nec, efficitur imperdiet magna. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse condimentum quis sem at porta. Duis non interdum nulla. Cras sit amet eleifend sapien. Nunc tellus enim, aliquam eget felis quis, viverra viverra mi. Integer pharetra libero arcu, vehicula scelerisque erat volutpat eget. Nam malesuada leo sed nulla imperdiet, eget vestibulum lorem maximus. Nam placerat, elit at suscipit tincidunt, dolor leo ultricies neque, in ultricies justo massa vel libero. Duis eu risus id nisl ullamcorper pellentesque et a nunc. Maecenas luctus nibh non est rhoncus, et euismod ligula dictum.</p>
            <p>Nam id posuere urna. Aenean velit justo, aliquet nec mauris sed, placerat vehicula justo. Cras et urna id ligula blandit commodo. Sed sed quam ornare, condimentum ex nec, accumsan justo. Donec id auctor mauris. Morbi accumsan mi nec lorem faucibus faucibus. Duis suscipit fringilla tellus id efficitur. Etiam ultrices enim vitae arcu posuere, ac auctor urna volutpat. Cras vel porta metus, quis porttitor sapien. Duis maximus, magna et porta tempor, libero augue ultrices libero, quis ultrices eros turpis at tortor. Aliquam imperdiet malesuada risus aliquam rutrum.</p>";
            echo "<br><br>";
        }
    }

}