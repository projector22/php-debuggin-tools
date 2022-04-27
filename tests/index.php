<?php
/**
 * @author  Gareth Palmer   @evangelthelogy
 * @since   1.0.1
 */

?>

<html>
<h1>PHP Debuggin Tools</h1>
<h2>Test Pages</h2>
<ol>
    <?php
    $files = scandir( __DIR__ );
    foreach( $files as $file ) {
        if ( $file == 'index.php' || $file == '.' || $file == '..' ) {
            continue;
        }
        $name = ucfirst( str_replace( '.php', '', $file ) );
        echo "<li><a href='{$file}' target='_blank'>{$name}</a></li>";
    }
    ?>
</ol>
</html>