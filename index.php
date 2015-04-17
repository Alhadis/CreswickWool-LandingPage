<?php

	function features_list($list){
		$features	=	array_filter(explode(PHP_EOL, $list));
		return sprintf('<ul class="features"><li>%1$s</li></ul>', implode('</li><li>', $features));
	}


	$locale	=	'zh_CN';
	$locale	=	'en_AU';

	# HTML lang attribute values
	$page_langs	=	array(
		'en_AU'	=>	'en-AU',
		'zh_CN'	=>	'zh_CN-Hans'
	);


	setlocale(LC_ALL, $locale);
	bindtextdomain('messages', 'src/lang');
	bind_textdomain_codeset('messages', 'UTF-8');
	textdomain('messages');

?> 
<!DOCTYPE html>
<html lang="<?= $page_langs[$locale] ?>">
<head>
<!--[if lte IE 9]><script src="src/js/compat/ie.lteIE9.js"></script><![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="initial-scale=1, minimum-scale=1" />
<title><?= _('Creswick Woollen Mills'); ?></title>

<link rel="stylesheet" type="text/css" href="src/css/fonts.css" />
<link rel="stylesheet" type="text/css" href="src/css/global.css" />
<link rel="stylesheet" type="text/css" href="src/css/main.css" />
</head>



<body>

	<header id="top">
		<a id="logo" class="r creswick" href="#">Creswick Wool</a>
		<a class="r weibo" href="http://weibo.com/u/5035482887" target="_blank">微博 Weibo.com</a>
	</header>


	<div id="preamble">
		<h1><?=	_('Creswick Woollen Mills'); ?></h1>
		<p><?=	_('Creswick Woollen Mills is the home of luxurious, natural fibre products designed in Australia. Founded in 1947 Creswick Woollen Mills is now the only coloured woollen spinning mill of its kind in Australia.'); ?></p>
		<p><?= _('Creswick has six stores across Victoria, Australia and stocks many of its products in the famous Australian department store David Jones.'); ?></p>
	</div>



	<div id="products">
		<article id="pure-regal-alpaca-quilt" data-product-id="12245">
			<h2 class="product-name" data-product-uri="//www.creswickwool.com/alpaca-pillow-luxury-twin-pack.html"><?= _('Pure Regal Alpaca Quilt'); ?></h2>
	
			<figure class="product-image">
				<a href="http://www.creswickwool.com/alpaca-pillow-luxury-twin-pack.html">
					<img src="src/img/regal_quilt_1.jpg" alt="" />
				</a>
			</figure>
			
			<div class="product-price">
				<p class="faded"><?= _('Regular price: <s>$499</s>'); ?></p>
				<p><strong><?= _('Special price: $388') ?></strong></p>
			</div>
	
	
	
			<div class="product-options">
				<div class="folding-choice">
					<input class="control" type="checkbox" id="mode-1" checked="checked" />
					<label class="disclosure" for="mode-1" data-text-selected="<?=

						# Translators: The %s gets replaced with the size the user's chosen.
						_('Your size: %s');

					?>"><?= _('Pick your size:') ?></label>

	
					<ul class="fold choices">
						<li><input type="radio" id="choice-1a" name="choice-1" value="1" /><label for="choice-1a"><?= _('Single'); ?></label></li>
						<li><input type="radio" id="choice-1b" name="choice-1" value="2" /><label for="choice-1b"><?= _('Double'); ?></label></li>					
						<li><input type="radio" id="choice-1c" name="choice-1" value="3" /><label for="choice-1c"><?= _('Queen'); ?></label></li>					
						<li><input type="radio" id="choice-1d" name="choice-1" value="4" /><label for="choice-1d"><?= _('Chinese Queen'); ?></label></li>					
						<li><input type="radio" id="choice-1e" name="choice-1" value="5" /><label for="choice-1e"><?= _('King'); ?></label></li>					
						<li><input type="radio" id="choice-1f" name="choice-1" value="6" /><label for="choice-1f"><?= _('Chinese King'); ?></label></li>					
						<li><input type="radio" id="choice-1g" name="choice-1" value="7" /><label for="choice-1g"><?= _('Super King'); ?></label></li>					
					</ul>
				</div>

				<label class="matchstick"><?= _('Quantity:'); ?> <input type="number" class="quantity-field" step="1" min="1" value="1" /></label>
				<a href="#" class="add btn"><?= _('Add to bag'); ?></a>
			</div>
	
	
			<div class="product-description"><?php
				features_list(_('500 GSM
100% alpaca
Australian Made'));
				?> 

				<p><?= _('Pure alpaca regal quilts offer warmth without weight when compared to wool.') ?></p>
				<p><?= _('An innovation in luxury quilts, Creswick\'s pure alpaca regal quilt features a new and exclusive quilting design which creates the softest, smoothest and warmest combination of innovative design in luxury quilts. Alpaca fleece is an exclusive and rare fibre with a unique softness that creates a truly luxurious experience in sleeping comfort.'); ?></p>

				<div class="sizing-guide">
					<h3><?= _('Sizing Guide'); ?></h3>
					<p><?= _('Comes in the following sizes:'); ?></p>
					<dl>
						<dt><?= _('Single:'); ?></dt><dd><?=		_('140cm × 210cm'); ?></dd>
						<dt><?= _('Double:'); ?></dt><dd><?=		_('180cm × 210cm'); ?></dd>
						<dt><?= _('Queen:'); ?></dt><dd><?=			_('210cm × 210cm'); ?></dd>
						<dt><?= _('Chinese Queen:'); ?></dt><dd><?=	_('230cm × 200cm'); ?></dd>
						<dt><?= _('King:'); ?></dt><dd><?=			_('245cm × 210cm'); ?></dd>
						<dt><?= _('Chinese King:'); ?></dt><dd><?=	_('240cm × 220cm'); ?></dd>
						<dt><?= _('Super King:'); ?></dt><dd><?=	_('240cm × 270cm'); ?></dd>
					</dl>
				</div>
			</div>
		</article>
	
	
	
	
	
		<article id="alpaca-luxury-quilt" data-product-id="9699">
			<h2 class="product-name" data-product-uri="//www.creswickwool.com/alpaca-pillow-luxury-twin-pack.html"><?= _('Alpaca Luxury Quilt'); ?></h2>
	
			<figure class="product-image">
				<a href="http://www.creswickwool.com/alpaca-pillow-luxury-twin-pack.html">
					<img src="src/img/2_pillow_pack.jpg" alt="" />
				</a>
			</figure>
	
			<div class="product-price">
				<p class="faded"><?= _('Regular price: <s>$379</s>'); ?></p>
				<p><strong><?= _('Special price: $258') ?></strong></p>
			</div>	
	
	
			<div class="product-options">
				<div class="folding-choice">
					<input class="control" type="checkbox" id="mode-2" checked="checked" />
					<label class="disclosure" for="mode-2" data-text-selected="<?=

						# Translators: The %s gets replaced with the size the user's chosen.
						_('Your Size: %s');

					?>"><?= _('Pick your size:'); ?></label>
	
					<input type="radio" id="choice-2_" name="choice-2" value="0" checked="checked" hidden="hidden" />
					<ul class="fold choices">
						<li><input type="radio" id="choice-2a" name="choice-2" value="1" /><label for="choice-2a"><?= _('Single'); ?></label></li>
						<li><input type="radio" id="choice-2b" name="choice-2" value="2" /><label for="choice-2b"><?= _('Double'); ?></label></li>
						<li><input type="radio" id="choice-2c" name="choice-2" value="3" /><label for="choice-2c"><?= _('Queen'); ?></label></li>
						<li><input type="radio" id="choice-2e" name="choice-2" value="5" /><label for="choice-2e"><?= _('King'); ?></label></li>
						<li><input type="radio" id="choice-2g" name="choice-2" value="7" /><label for="choice-2g"><?= _('Super King'); ?></label></li>
					</ul>
				</div>
	
				<label class="matchstick"><?= _('Quantity:'); ?> <input type="number" class="quantity-field" step="1" min="1" value="1" /></label>
				<a href="#" class="add btn"><?= _('Add to bag'); ?></a>
			</div>
	
	
			<div class="product-description">
				<?php
					features_list(_('50% Alpaca and 50% Wool
Australian made
400 GSM')); ?> 
				<p><?= _('The Creswick Woollen Mills alpaca and wool quilt is the ultimate in sleeping luxury. With 50% alpaca and 50% wool fleece encased in a sateen fabric of the finest woven cotton yarn; the Creswick alpaca and wool quilt has been purposely designed to deliver superior softness and luxury. Offering lightweight comfort and natural warmth, the unique thermal properties of these remarkable fibres mean you will always enjoy a perfect night\'s sleep.'); ?></p>

				<div class="sizing-guide">
					<h3><?= _('Sizing Guide'); ?></h3>
					<p><?= _('Comes in the following sizes:'); ?></p>
					<dl>
						<dt><?= _('Single:'); ?></dt><dd><?=		_('140cm × 210cm');	?></dd>
						<dt><?= _('Double:'); ?></dt><dd><?=		_('180cm × 210cm');	?></dd>
						<dt><?= _('Queen:'); ?></dt><dd><?=			_('210cm × 210cm');	?></dd>
						<dt><?= _('King:'); ?></dt><dd><?=			_('245cm × 210cm');	?></dd>
						<dt><?= _('Super King:'); ?></dt><dd><?=	_('240cm × 270cm'); ?></dd>
					</dl>
				</div>
			</div>
		</article>


		<div id="cart-message" role="alert" hidden="hidden">
			<p><?= _('Product added to cart') ?></p>
			<a href="http://www.creswickwool.com/checkout/cart" class="add btn"><?= _('View cart'); ?></a>
		</div>
	</div>




	<div id="more-info">
		<div id="about">
			<h2><?= _('About'); ?></h2>
			<p><?= _('Located in Creswick, a small country township approximately 120km from Melbourne, only 20 minutes north-east of Ballarat and 20 minutes south-east of Daylesford, Creswick Woollen Mills has become a household name both in Australia and globally. Creswick\'s continued success is attributed to ongoing research and innovation, as well as dedication to high quality with exclusive designs.'); ?></p>
			<p><?= _('Visit Creswick Woollen Mills to see where the products are manufactured and visit with our friendly alpacas.'); ?></p>
			<p>
				<?= _('Contact details for the Mill:'); ?>
				<span class="contact-number"><?= _('Phone: 03 5345 2202'); ?></span>
				<span class="contact-email"><?=
					sprintf(
						# translators: %s gets replaced with a hyperlinked e-mail address
						_('Email: %s'),
						'<a href="mailto:info@creswickwool.com.au">info@creswickwool.com.au</a>'
					);
				?></span>
			</p>
		</div>
		
		
		<div id="delivery-and-returns">
			<h2><?= _('Delivery and Returns'); ?></h2>
			<p><?= _('We accept international orders.'); ?></p>
			<p><?= _('<strong>Orders shipped overseas are exempt from GST charges (this will be deducted at the checkout).</strong>'); ?></p>
			<p><?= _('Orders are sent via International Post Courier and are registered. Please allow up to 10 working days for orders to be received after a 48-hour processing period. Overseas orders will only show up on the tracking when they arrive at the country of destination.'); ?></p>
			<p><?= _('We hope you will be delighted with your Creswick Woollen Mills purchase. If for some reason you are unsatisfied with your purchase from the Creswick Woollen Mills website we will happily exchange or refund the purchase price of the item in accordance to our returns and exchanges policy.'); ?></p>
		</div>
	</div>


	<footer id="bottom">
		<div id="secure-shopping"><span><?= _('Secure Shopping'); ?></span></div>
		<a id="full-website" href="http://www.creswickwool.com.au"><span><?= _('Full Website'); ?> <small>www.creswickwool.com.au</small></span></a>
		<div id="natural-fibres"><span><?= _('Natural Fibres'); ?></span></div>
	</footer>


	<aside id="keep-in-touch">
		<h2><?= _('Keep in touch'); ?></h2>
		<p><?= _('Subscribe right away and you will receive our news everyday!'); ?></p>
		<form id="subscription-form" method="post">
			<input type="email" id="subscribe-address" name="subscribe-address" placeholder="<?= htmlspecialchars(_('Put your email address here')); ?>" />
			<input type="submit" id="subscribe-submit" name="subscribe-submit" value="<?= htmlspecialchars(_('Subscribe')); ?>" />
		</form>
	</aside>


	<p id="australian-made"><?= _('Australian Made'); ?></p>


	<script type="text/javascript" src="src/js/main.js"></script>
</body>
</html>