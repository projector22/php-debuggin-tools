<?php

namespace Debugger;

use Debugger\Tools\Lorium;
use Debugger\Tools\Timing;
use Debugger\Tools\DisplayData;

/**
 * Class for providing a number of Debugging tools.
 * 
 * @author  Gareth Palmer   @evangeltheology
 * 
 * @version 1.0.0
 */

class Debug {

    /**
     * Object for using timing tools.
     * 
     * @var object  $timer
     * 
     * @access  public
     * @since   1.0.0
     */

    public static object $timer;

    /**
     * Object for using display tools.
     * 
     * @var object  $display
     * 
     * @access  public
     * @since   1.0.0
     */

    public static object $display;

    /**
     * Object for using a lorium generator tools.
     * 
     * @var object  $lorium
     * 
     * @access  public
     * @since   1.0.0
     */

    public static object $lorium;


    /**
     * Constructor method, should be placed in the autoloader or called 
     * before any of the properties above are called.
     * 
     * @access  public
     * @since   1.0.0
     */
    
    public static function __constructStatic() {
        self::$timer = new Timing;
        self::$display = new DisplayData;
        self::$lorium = new Lorium;
    }

}