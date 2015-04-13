<?php

/**
 * Endpoint to manage cart content on an external page
 */

/*
Load Magento
*/
require_once ("../app/Mage.php");
umask(0);
Mage::app("default");
Mage::getSingleton("core/session", array("name" => "frontend"));

/*
Load cart
*/
$cart = Mage::getSingleton('checkout/cart');

/*
Set up response
*/
$response = array('message' => '', 'status' => 200);

/*
Manage requests
*/

// Add to cart
if ($_POST['action'] == 'add_to_cart') {
	
	try {

		$product_id = $_POST['product_id'];
		$quantity = $_POST['quantity'];
		
		$cart->addProduct($product_id, array('qty' => $quantity));
		$cart->save();
		
		Mage::getSingleton('checkout/session')->setCartWasUpdated(true);

		$response['message'] = 'Added product '.$product_id.' with quantity '.$quantity.' into cart';

	}
	catch(Exception $e) {

		$response['message'] = 'Unable to add product to cart. Error: ' . $e;
		$response['status'] = 400;
	
	}

} 
else {

	$response['message'] = 'No action specified';
	$response['status'] = 400;

}

/*
Respond
*/
echo json_encode($response);
http_response_code($response['status']);
