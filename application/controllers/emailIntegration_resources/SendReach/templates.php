<?php
/**
 * This file contains examples for using the SendReach PHP-SDK.
 */
 
// require the setup which has registered the autoloader
require_once dirname(__FILE__) . '/setup.php';

// CREATE THE ENDPOINT
$endpoint = new MailWizzApi_Endpoint_Templates();

/*===================================================================================*/

// GET ALL ITEMS
$response = $endpoint->getTemplates($pageNumber = 1, $perPage = 10);

// DISPLAY RESPONSE
echo '<pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// GET ONE ITEM
$response = $endpoint->getTemplate('TEMPLATE-UNIQUE-ID');

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// delete template
$response = $endpoint->delete('TEMPLATE-UNIQUE-ID');

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// CREATE A NEW TEMPLATE
$rand = rand();
$response = $endpoint->create(array(
    'name'          => 'My API template ' . $rand,
    'content'       => file_get_contents(dirname(__FILE__) . '/template-example.html'),
    //'archive'     => file_get_contents(dirname(__FILE__) . '/template-example.zip'),
    'inline_css'    => 'no',// yes|no
));

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// UPDATE A TEMPLATE
$response = $endpoint->update('TEMPLATE-UNIQUE-ID', array(
    'name'          => 'My API template - updated' . $rand,
    'content'       => file_get_contents(dirname(__FILE__) . '/template-example.html'),
    //'archive'     => file_get_contents(dirname(__FILE__) . '/template-example.zip'),
    'inline_css'    => 'no',// yes|no
));

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';