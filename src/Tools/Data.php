<?php

namespace Debugger\Tools;

class Data {

    private array $data_objects = [];


    public function append_to_data_objects( array $data ): static {
        $this->data_objects = array_merge( $this->data_objects, $data );
        return $this;
    }

    public function dump( ?int $count = null, bool $show_type = true ): static {
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

    private function display( $data ): void {
        // $result = highlight_string("<?php\n" . self::$_output, true);
        // self::$_output = preg_replace('/&lt;\\?php<br \\/>/', '', $result, 1);
        echo "<pre>";
        if ( !is_array( $data ) && !is_object( $data ) ) {
            var_dump( $data );
        } else {
            print_r( $data );
        }
        echo "</pre>";
    }


    /**
     * Table out data that may be sent, ideally in the form of an array
     * 
     * @param   array   $data   Any array, string or object
     * 
     * @access  public
     * @since   1.0.0
     */

     public function table( ?int $count = null ): static {
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

    
    public function log(): static {

        return $this;
    }


    public function email(): static {

        return $this;
    }


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