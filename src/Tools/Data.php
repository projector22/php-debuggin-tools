<?php

namespace Debugger\Tools;

/**
 * A set of tools that can be called to help in the development and debugging of this app.
 * 
 * @author  Gareth Palmer [Github & Gitlab /projector22]
 * 
 * @since   1.1.0
 */

class Data {

    /**
     * Array of data to handle in debugging.
     * 
     * @var array   $data_object
     * 
     * @access  private
     * @since   1.1.0
     */

    private array $data_objects = [];


    /**
     * Method for instanciating this class and populate the property $this->data_objects.
     * 
     * @param   array   $data   The data to append to `$this->data_objects`.
     * 
     * @return  static
     * 
     * @access  public
     * @since   1.1.0
     */

    public function append_to_data_objects( array $data ): static {
        $this->data_objects = array_merge( $this->data_objects, $data );
        return $this;
    }


    /**
     * Dump the data to the screen.
     * 
     * @param   int|null    $count  The number to dump. Default: null
     * 
     * @return  static
     * 
     * @access  public
     * @since   1.1.0
     */

    public function dump( ?int $count = null ): static {
        $lb = count ( $this->data_objects ) > 1 && $count !== 1 ? '<hr>' : '';
        $i = 0;
        foreach ( $this->data_objects as $key => $entry ) {
            $this->display( $entry );
            echo $lb;
            unset( $this->data_objects[$key] );
            $i++;
            if ( !is_null( $count ) && $i == $count ) {
                break;
            }
        }
        return $this;
    }


    /**
     * To Be Build - Log to file.
     * 
     * @return  static
     * 
     * @todo    Work in some automatic pathing.
     * 
     * @access  public
     * @since   1.1.0
     */
    
    public function log( string $path, ?int $count = null ): static {
        $file = fopen( $path, 'a' );
        $i = 0;
        foreach ( $this->data_objects as $key => $entry ) {
            fwrite( $file, date( "Y-m-d H:i:s\t|\t" ) . $entry . "\n" );
            $i++;
            if ( !is_null( $count ) && $i == $count ) {
                break;
            }
        }
        fclose($file);
        return $this;
    }


    /**
     * Print out the parsed data to the screen.
     * 
     * @param   mixed   $data   The data to print.
     * 
     * @see https://www.php.net/manual/en/function.highlight-string.php
     * 
     * @access  private
     * @since   1.1.0
     */

    private function display( mixed $data ): void {
        if ( !is_array( $data ) && !is_object( $data ) ) {
            echo "<pre>";
            var_dump( $data );
            echo "</pre>";
        } else {
            $highlighted = highlight_string( "<?php\n" . print_r( $data, true ), true );
            echo preg_replace('/&lt;\\?php<br \\/>/', '', $highlighted, 1);
        }
    }


    /**
     * Table out data that may be sent, ideally in the form of an array
     * 
     * @param   int|null    $count  The number to dump. Default: null
     * 
     * @return  static
     * 
     * @access  public
     * @since   1.1.0
     */

    public function table(  ?int $count = null ): static {
        $lb = count ( $this->data_objects ) > 1 && $count !== 1 ? '<hr>' : '';
        $i = 0;
        echo <<<HTML
<style>
    .debug_table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid black;
    }

    .debug_table tr td,
    .debug_table tr th {
        border: 1px solid black;
        padding: 6px;
    }
    .debug_table tr:nth-child(even) {
        background-color: lightgrey;
    }
    .debug_table tr:hover {
        background-color: #4CAF50;
        color: white;
    }
</style>
HTML;
        foreach ( $this->data_objects as $key => $entry ) {
            echo "<table class='debug_table'>";
            echo "<tr>";
            if ( gettype( $entry[array_key_first( $entry )] ) !== 'string' ) {
                foreach ( $entry[array_key_first($entry)] as $index => $entry ) {
                    echo "<th>{$index}</th>";
                }
            }
            echo "</tr>";

            foreach ( $entry as $index => $entry ) {
                echo "<tr>";
                if ( is_array( $entry ) || is_object( $entry ) ) {
                    foreach ( $entry as $item ) {
                        echo "<td>";
                        if ( is_array( $item ) || is_object( $item ) ) {
                            $this->display( $item );
                        } else {
                            echo $item;
                        }
                        echo "</td>";
                    }
                } else {
                    echo "<td>{$entry}</td>";
                }
                echo "</tr>";
            }
            echo "</table>";

            echo $lb;
            unset( $this->data_objects[$key] );
            $i++;
            if ( !is_null( $count ) && $i == $count ) {
                break;
            }
        }
        return $this;
    }


    /**
     * To Be Build - Send as email.
     * 
     * @return  static
     * 
     * @access  public
     * @since   1.1.0
     */

    public function email(): static {

        return $this;
    }


    /**
     * Show the terminal output directly from a command.
     * 
     * @param   int|null    $count  The number to dump. Default: null
     * 
     * @return  static
     * 
     * @link    https://stackoverflow.com/questions/20107147/php-reading-shell-exec-live-output
     * 
     * @access  public
     * @since   1.1.0
     */

    public function cli( ?int $count = null ): static {
        $lb = count ( $this->data_objects ) > 1 && $count !== 1 ? '<hr>' : '';
        $i = 0;
        foreach ( $this->data_objects as $key => $command ) {
            while ( @ob_end_flush() ); // end all output buffers if any
            $proc = popen( $command, 'r' );
            echo '<pre>';
            while ( !feof( $proc ) ) {
                echo fread( $proc, 4096 );
                @flush();
            }
            echo '</pre>';
            echo $lb;
            unset( $this->data_objects[$key] );
            $i++;
            if ( !is_null( $count ) && $i == $count ) {
                break;
            }
        }
        return $this;
    }

}