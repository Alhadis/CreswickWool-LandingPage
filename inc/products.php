<?php
	global $size_names, $products;


	$size_names = array(
		K_SIZE_SINGLE			=>	__('Single'),
		K_SIZE_DOUBLE			=>	__('Double'),
		K_SIZE_QUEEN			=>	__('Queen'),
		K_SIZE_CHINESE_QUEEN	=>	__('Chinese Queen'),
		K_SIZE_KING				=>	__('King'),
		K_SIZE_CHINESE_KING		=>	__('Chinese King'),
		K_SIZE_SUPER_KING		=>	__('Super King')
	);


	$products = array(
		array(
			'id'		=>	12245,
			'slug'		=>	'pure-regal-alpaca-quilt',
			'name'		=>	__('Pure Regal Alpaca Quilt'),
			'permalink'	=>	$base_url.'alpaca-pillow-luxury-twin-pack.html',
			'image'		=>	'src/img/regal_quilt_1.jpg',
			
			'price_1'	=>	__('Regular price: <s>$499</s>'),
			'price_2'	=>	__('Special price: $388'),
			'features'	=>	__('500 GSM
100% alpaca
Australian Made'),
			'description'	=>	array(
				__('Pure alpaca regal quilts offer warmth without weight when compared to wool.'),
				__('An innovation in luxury quilts, Creswick\'s pure alpaca regal quilt features a new and exclusive quilting design which creates the softest, smoothest and warmest combination of innovative design in luxury quilts. Alpaca fleece is an exclusive and rare fibre with a unique softness that creates a truly luxurious experience in sleeping comfort.')
			),


			'sizes'	=>	array(
				K_SIZE_SINGLE			=>	array('id' => 12233,	'spec' => __('140cm × 210cm')),
				K_SIZE_DOUBLE			=>	array('id' => 12234,	'spec' => __('180cm × 210cm')),
				K_SIZE_QUEEN			=>	array('id' => 12232,	'spec' => __('210cm × 210cm')),
				K_SIZE_CHINESE_QUEEN	=>	array('id' => 17483,	'spec' => __('230cm × 200cm')),
				K_SIZE_KING				=>	array('id' => 12235,	'spec' => __('245cm × 210cm')),
				K_SIZE_CHINESE_KING		=>	array('id' => 17482,	'spec' => __('240cm × 220cm')),
				K_SIZE_SUPER_KING		=>	array('id' => 12236,	'spec' => __('240cm × 270cm'))
			)
		),



		array(
			'id'		=>	9699,
			'slug'		=>	'alpaca-luxury-quilt',
			'name'		=>	__('Alpaca Luxury Quilt'),
			'permalink'	=>	$base_url.'alpaca-pillow-luxury-twin-pack.html',
			'image'		=>	'src/img/alux_quilt.jpg',
			
			'price_1'	=>	__('Regular price: <s>$379</s>'),
			'price_2'	=>	__('Special price: $258'),
			'features'	=>	__('50% Alpaca and 50% Wool
Australian made
400 GSM'),
			'description'	=>	array(
				__('The Creswick Woollen Mills alpaca and wool quilt is the ultimate in sleeping luxury. With 50% alpaca and 50% wool fleece encased in a sateen fabric of the finest woven cotton yarn; the Creswick alpaca and wool quilt has been purposely designed to deliver superior softness and luxury. Offering lightweight comfort and natural warmth, the unique thermal properties of these remarkable fibres mean you will always enjoy a perfect night\'s sleep.')
			),

			'sizes'	=>	array(			#					⤹ Replace these IDs with the real Magento "subproduct" IDs.
				K_SIZE_SINGLE			=>	array('id' => 12246,		'spec' => __('140cm × 210cm')),
				K_SIZE_DOUBLE			=>	array('id' => 12247,		'spec' => __('180cm × 210cm')),
				K_SIZE_QUEEN			=>	array('id' => 12248,		'spec' => __('210cm × 210cm')),
				K_SIZE_KING				=>	array('id' => 10124,		'spec' => __('245cm × 210cm')),
				K_SIZE_SUPER_KING		=>	array('id' => 1214124124,	'spec' => __('240cm × 270cm'))
			)
		)
	);
