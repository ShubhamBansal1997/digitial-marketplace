<?php
/**
 * This file contains examples for using the SendReach PHP-SDK.
 */
 
// require the setup which has registered the autoloader
require_once dirname(__FILE__) . '/setup.php';

// create the lists endpoint:
$endpoint = new MailWizzApi_Endpoint_Lists();

/*===================================================================================*/

// GET ALL ITEMS
$response = $endpoint->getLists($pageNumber = 1, $perPage = 10);

// DISPLAY RESPONSE
echo '<pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// get a single list
//$response = $endpoint->getList('LIST-UNIQUE-ID');

// DISPLAY RESPONSE
//echo '<hr /><pre>';
//print_r($response->body);
//echo '</pre>';

/*===================================================================================*/

// copy a list
//$response = $endpoint->copy('LIST-UNIQUE-ID');

// DISPLAY RESPONSE
//echo '<hr /><pre>';
//print_r($response->body);
//echo '</pre>';

/*===================================================================================*/

// delete a list
//$response = $endpoint->delete('LIST-UNIQUE-ID');

// DISPLAY RESPONSE
//echo '<hr /><pre>';
//print_r($response->body);
//echo '</pre>';
