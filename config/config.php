<?php

/**
 * Contao Open Source CMS
 */

/**
 * @file config.php
 * @author Sascha Weidner
 * @version 3.0.0
 * @package sioweb.contao.extensions.vnp
 * @copyright Sascha Weidner, Sioweb
 */

if(TL_MODE == 'FE') {
  $GLOBALS['TL_CSS'][] = 'system/modules/versionsNPrices/assets/vnp.css';
  $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/versionsNPrices/assets/vnp.js';
}

$vnp = array(
	'states' => array(
		'neu'=>'Neu',
		'enterprise'=>'Enterprise',
		'angebot'=>'Angebot',
		'beliebt'=>'Beliebt'
	)
);
if(!empty($GLOBALS['VNP'])) {
	$GLOBALS['VNP'] = array_merge($vnp,$GLOBALS['VNP']);
} else {
	$GLOBALS['VNP'] = $vnp;
}

array_insert($GLOBALS['BE_MOD']['vnp'], 4, array(
	'vnp_attributes' => array(
		'tables' => array('tl_vnp_attributes'),
		'icon' => 'system/modules/versionsNPrices/assets/sioweb16x16.png'
	),
	'tl_vnp_payment_types' => array(
		'tables' => array('tl_vnp_payment_types'),
		'icon' => 'system/modules/versionsNPrices/assets/sioweb16x16.png'
	),
	'vnp_products' => array(
		'tables' => array('tl_vnp_products','tl_vnp_versions','tl_vnp_version_attributes','tl_vnp_version_prices'),
		'icon' => 'system/modules/versionsNPrices/assets/sioweb16x16.png'
	),
));

/**
 * Front end modules
 */
array_insert($GLOBALS['TL_CTE'], 2, array(
    'texts' => array
    (
        'vnp_pricing'    => 'sioweb\contao\extensions\vnp\ContentVNPricing',
    )
));
