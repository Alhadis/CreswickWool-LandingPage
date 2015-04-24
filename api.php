<?php

/**
 * Endpoint to manage cart content on an external page
 */


# Load landing page's configuration file
require_once 'inc/main.php';



try{

	# Load Magento
	require_once '../app/Mage.php';
	umask(0);
	Mage::app('default');
	Mage::getSingleton('core/session', array('name' => 'frontend'));


	# Load cart
	$cart = Mage::getSingleton('checkout/cart');


	# Add to cart
	if($_POST[K_QUERY_ACTION] === K_ACTION_CART_ADD){
		
        $size           =   $_POST[K_QUERY_SIZE];
		$quantity		=	$_POST[K_QUERY_QUANTITY];
		$product_id		=	$_POST[K_QUERY_PRODUCT];

		# Locate an item in the product config by matching ID
		foreach($products as $key => $value)
			if($value['id'] == $product_id){
				$product = $value;
				break;
			}


		# This shouldn't have happened, but better safe than sorry.
		if(!$product)
			throw new Exception(sprintf('Product ID "%1$s" not specified in config array.', $product_id));


		# Bail if no size ID was set, or it was set to something weird.
		if(!$size_names[$size])
			throw new Exception(sprintf('Unrecognised size constant: %1$s', $size));


		# Bail if the user's somehow requested a size that lacks a product ID (this shouldn't have happened, either).
		if(!($product_id = $product['sizes'][$size])){
			$format	=	'Size ID %1$s ("%2$s") doesn\'t exist for product ID %3$s ("%4$s").';
			throw new Exception(sprintf($format, $size, $size_names[$size], $_POST[K_QUERY_PRODUCT], $product['name']));
		}



		$product_id	=	$product_id['id'];
		$cart->addProduct($product_id, array('qty' => $quantity));
		$cart->save();

		Mage::getSingleton('checkout/session')->setCartWasUpdated(true);
		$message = sprintf('Added product %1$s with quantity %2$s into cart', $product_id, $quantity);
	}

	else{
		$message = 'No action specified';
		http_response_code(400);
	}
}

# If anything went wrong, ensure the correct status code is sent back to the user.
catch(Exception $e){
	$message	=	'Unable to add product to cart. Error: '.$e;
	http_response_code(400);
}



# Respond
http_response_code($status_code);
header('Content-Type: application/json; charset=UTF-8');
echo json_encode(compact('message'));
