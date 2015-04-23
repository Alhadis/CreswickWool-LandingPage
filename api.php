<?php

/**
 * Endpoint to manage cart content on an external page
 */

 
# Load Magento
require_once '../app/Mage.php';
umask(0);
Mage::app('default');
Mage::getSingleton('core/session', array('name' => 'frontend'));

# Load cart
$cart = Mage::getSingleton('checkout/cart');

# Set up response
$response = array('message' => '', 'status' => 200);

# Manage requests

# Add to cart
if($_POST['action'] === 'add_to_cart'){
	

	$size_map	=	array(
		'Single'		=>	1,
		'Double'		=>	2,
		'Queen'			=>	3,
		'Chinese Queen'	=>	4,
		'King'			=>	5,
		'Chinese King'	=>	6,
		'Super King'	=>	7
	);
	
	
	$product_ids	=	array(
		
		# Pure regal alpaca quilt
		12245	=>	array(
			$size_map['Single']			=>	12233,
			$size_map['Double']			=>	12234,
			$size_map['Queen']			=>	12232,
			$size_map['Chinese Queen']	=>	17483,
			$size_map['King']			=>	12235,
			$size_map['Chinese King']	=>	17482,
			$size_map['Super King']		=>	12236
		),

		# Alpaca luxury quilt
		9699	=>	array(				#	⤹ Replace these IDs with the real Magento "subproduct" IDs.
			$size_map['Single']			=>	12246,
			$size_map['Double']			=>	12247,
			$size_map['Queen']			=>	12248,
		#	$size_map['Chinese Queen']	=>	12249,
			$size_map['King']			=>	10124,
			$size_map['Chinese King']	=>	1214124124,
		#	$size_map['Super King']		=>	10124
		)
	);



	try{
        $size           =   $_POST['size'];
		$product_id		=	$product_ids[$_POST['product_id']][$size];
		$quantity		=	$_POST['quantity'];

		$cart->addProduct($product_id, array('qty' => $quantity));
		$cart->save();

		Mage::getSingleton('checkout/session')->setCartWasUpdated(true);
		$response['message']	=	sprintf('Added product %1$s with quantity %2$s into cart', $product_id, $quantity);
	}

	catch(Exception $e){
		$response['message']	=	'Unable to add product to cart. Error: '.$e;
		$response['status']		=	400;
	}

} 

else{
	$response['message']	=	'No action specified';
	$response['status']		=	400;
}

# Respond
echo json_encode($response);


$response_message   =   array(
	200 =>  'OK',
	400 =>  'Bad Request'
);
header($_SERVER['SERVER_PROTOCOL'] ?: 'HTTP/1.0' . ' ' . $response_message[$response['status']]);
