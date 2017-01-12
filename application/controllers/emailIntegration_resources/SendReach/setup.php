<?php
/**
 * This file contains examples for using the SendReach PHP-SDK.
 */
 
//exit('COMMENT ME TO TEST THE EXAMPLES!');
 
// require the autoloader class
require_once dirname(__FILE__) . '/MailWizzApi/Autoloader.php';

// register the autoloader.
MailWizzApi_Autoloader::register();

// if using a framework that already uses an autoloading mechanism, like Yii for example, 
// you can register the autoloader like:
// Yii::registerAutoloader(array('MailWizzApi_Autoloader', 'autoloader'), true);

/**
 * Configuration components:
 * The api for the SendReach platform is designed to return proper etags when GET requests are made.
 * We can use this to cache the request response in order to decrease loading time therefore improving performance.
 * In this case, we will need to use a cache component that will store the responses and a file cache will do it just fine.
 * Please see MailWizzApi/Cache for a list of available cache components and their usage.
 */

// configuration object
$config = new MailWizzApi_Config(array(
    'apiUrl'        => 'https://dashboard.sendreach.com/api/index.php',
    'publicKey'     => publicKey,
    'privateKey'    => privateKey,
    
    // components 
    'components' => array(
        'cache' => array(
            'class'     => 'MailWizzApi_Cache_File',
            'filesPath' => dirname(__FILE__) . '/../MailWizzApi/Cache/data/cache', // make sure it is writable by webserver
        )
    ),
));

// now inject the configuration and we are ready to make api calls
MailWizzApi_Base::setConfig($config);

// start UTC
date_default_timezone_set('UTC');