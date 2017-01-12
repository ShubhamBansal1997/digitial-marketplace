<?php
    $path=dirname(__FILE__);
    $abs_path=explode('application/',$path);
    if( file_get_contents($abs_path[0].'application/config/verify.txt') != 'yes' )
    {
        file_put_contents($abs_path[0].'installer/check_install.txt','no');
    }
?>
