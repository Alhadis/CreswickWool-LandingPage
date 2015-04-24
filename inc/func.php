<?php

	
	/**
	 * Displays a product entry
	 *
	 * @param array $product - Product metadata, expressed as an associative array
	 * @global $size_names
	 */
	function display_product($product){
		global $size_names;

		# Track how many products have been displayed already.
		static $count;
		$count	=	isset($count) ? $count : 0;
		$count++;


		# Extract the $product array's properties as local variables.
		extract($product);

	?> 
		<article id="<?= $slug ?>" data-product-id="<?= $id ?>">
			<h2 class="product-name" data-product-uri="<?= $permalink ?>"><?= $name; ?></h2>

			<figure class="product-image">
				<a href="<?= $permalink ?>"><img src="<?= $image ?>" alt="" /></a>
			</figure>

			<div class="product-price">
				<p class="faded"><?= $price_1; ?></p>
				<p><strong><?= $price_2; ?></strong></p>
			</div>



			<div class="product-options">
				<div class="folding-choice">
					<input class="control" type="checkbox" id="mode-<?= $count ?>" checked="checked" />
					<label class="disclosure" for="mode-<?= $count ?>" data-text-selected="<?=

						# translators: The %s gets replaced with the size the user's chosen.
						_('Your size: %s');

					?>"><?= _('Pick your size:') ?></label>


					<ul class="fold choices"><?php

						foreach($sizes as $size_id => $size_info){
							$choice_name	=	sprintf('choice-%1$s', $count);
							$choice_id		=	$choice_name . chr(96 + $size_id);
							$size_name		=	$size_names[$size_id];
						?> 
						<li><input type="radio" id="<?= $choice_id ?>" name="<?= $choice_name ?>" value="<?= $size_id ?>" /><label for="<?= $choice_id ?>"><?= $size_name; ?></label></li><?php
						}
					?> 
					</ul>
				</div>

				<label class="matchstick"><?= _('Quantity:'); ?> <input type="number" class="quantity-field" step="1" min="1" value="1" /></label>
				<a href="#" class="add btn"><?= _('Add to bag'); ?></a>
			</div>
	
	
			<div class="product-description"><?php
			
				# Features list
				$features	=	array_filter(explode(PHP_EOL, $features));
				printf('<ul class="features"><li>%1$s</li></ul>', implode('</li><li>', $features));


				# Main description
				foreach($description as $line): ?> 
				<p><?= $line ?></p><?php endforeach; ?> 


				<div class="sizing-guide">
					<h3><?= _('Sizing Guide'); ?></h3>
					<p><?= _('Comes in the following sizes:'); ?></p>
					<dl><?php foreach($sizes as $size_id => $size_info): ?> 
						<dt><?= sprintf('%1$s%2$s', $size_names[$size_id], _(':')); ?></dt><dd><?= $size_info['spec']; ?></dd><?php
						endforeach; ?> 
					</dl>
				</div>
			</div>
		</article>
		<?php
	}




	/** Always make sure gettext's shorthand function is available, even if it's not available to the running system */
	if(!function_exists('_')){
		function _($i){ return $i; }
	}
	
	
	/**
	 * Polyfill for http_response_code for environments running PHP versions older than v5.4.
	 * @link http://php.net/manual/en/function.http-response-code.php#107261
	 */
	if(!function_exists('http_response_code')){
		function http_response_code($code = NULL){

			if($code !== NULL){

				$codes	=	array(
					100 => 'Continue',
					101 => 'Switching Protocols',
					200 => 'OK',
					201 => 'Created',
					202 => 'Accepted',
					203 => 'Non-Authoritative Information',
					204 => 'No Content',
					205 => 'Reset Content',
					206 => 'Partial Content',
					300 => 'Multiple Choices',
					301 => 'Moved Permanently',
					302 => 'Moved Temporarily',
					303 => 'See Other',
					304 => 'Not Modified',
					305 => 'Use Proxy',
					400 => 'Bad Request',
					401 => 'Unauthorized',
					402 => 'Payment Required',
					403 => 'Forbidden',
					404 => 'Not Found',
					405 => 'Method Not Allowed',
					406 => 'Not Acceptable',
					407 => 'Proxy Authentication Required',
					408 => 'Request Time-out',
					409 => 'Conflict',
					410 => 'Gone',
					411 => 'Length Required',
					412 => 'Precondition Failed',
					413 => 'Request Entity Too Large',
					414 => 'Request-URI Too Large',
					415 => 'Unsupported Media Type',
					500 => 'Internal Server Error',
					501 => 'Not Implemented',
					502 => 'Bad Gateway',
					503 => 'Service Unavailable',
					504 => 'Gateway Time-out',
					505 => 'HTTP Version not supported'
				);

				$text	=	$codes[$code];
				if(!$text) exit('Unknown http status code "' . htmlentities($code) . '"');


				$protocol	=	(isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
				header($protocol . ' ' . $code . ' ' . $text);
				$GLOBALS['http_response_code'] = $code;

			} else $code = (isset($GLOBALS['http_response_code']) ? $GLOBALS['http_response_code'] : 200);

			return $code;
		}
	}