<?php

namespace Debugger;

use Debugger\Tools\Js;
use Debugger\Tools\Cmd;
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
     * @access  public
     * @since   1.0.0
     */

    public static Timing $timer;

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
     */
    
    public static function __constructStatic() {
        self::$timer   = new Timing;
        self::$display = new DisplayData;
        self::$lorium  = new Lorium;
        self::$cmd     = new Cmd;
        self::$js      = new Js;
        self::$log     = new Log;
    }

}