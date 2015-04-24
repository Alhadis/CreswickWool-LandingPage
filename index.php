<?php
	include_once 'inc/main.php';
?>
<!DOCTYPE html>
<html lang="<?= $page_langs[$locale] ?>">
<head>
<!--[if lte IE 9]><script src="src/js/compat/ie.lteIE9.js"></script><![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="initial-scale=1, minimum-scale=1" />
<title><?= _('Creswick Woollen Mills'); ?></title>

<?php if($environment === 'DEVELOPMENT'): ?> 
<link rel="stylesheet" type="text/css" href="src/css/fonts.css" />
<link rel="stylesheet" type="text/css" href="src/css/global.css" />
<link rel="stylesheet" type="text/css" href="src/css/main.css" />
<?php else: ?> 
<link rel="stylesheet" type="text/css" href="src/min/main.css" />
<?php endif; ?> 
</head>



<body>

	<header id="top">
		<a id="logo" class="r creswick" href="<?= $base_url ?>">Creswick Wool</a>
		<a class="r weibo" href="http://weibo.com/u/5035482887" target="_blank">微博 Weibo.com</a>
	</header>


	<div id="preamble">
		<h1><?=	_('Creswick Woollen Mills'); ?></h1>
		<p><?=	_('Creswick Woollen Mills is the home of luxurious, natural fibre products designed in Australia. Founded in 1947 Creswick Woollen Mills is now the only coloured woollen spinning mill of its kind in Australia.'); ?></p>
		<p><?= _('Creswick has six stores across Victoria, Australia and stocks many of its products in the famous Australian department store David Jones.'); ?></p>
	</div>



	<div id="products"><?php

		foreach($products as $product)
			display_product($product);
	?> 
	</div>



	<div class="msg" id="cart-add" role="alert" hidden="hidden">
		<p><?= _('Product added to cart') ?></p>
		<a href="<?= $base_url ?>checkout/cart" class="add btn"><?= _('View cart'); ?></a>
	</div>

	<div class="msg" id="cart-error" role="alert" hidden="hidden">
		<p><?= _('Product could not be added to cart') ?></p>
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
		<a id="full-website" href="http://www.creswickwool.com.au/"><span><?= _('Full Website'); ?> <small>www.creswickwool.com.au</small></span></a>
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


	<script type="text/javascript" src="src/<?= $environment === 'DEVELOPMENT' ? 'js' : 'min' ?>/main.js"></script>
</body>
</html>