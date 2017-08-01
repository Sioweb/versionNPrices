<?php

/**
 * Contao Open Source CMS
 */

/**
 * @file autoload.php
 * @author Sascha Weidner
 * @version 3.0.0
 * @package sioweb.contao.extensions.vnp
 * @copyright Sascha Weidner, Sioweb
 */

ClassLoader::addNamespaces(array(
    'sioweb\contao\extensions\vnp'
));

ClassLoader::addClasses(array(
    // classes
    'sioweb\contao\extensions\vnp\ContentVNPricing'   => 'system/modules/versionsNPrices/elements/ContentVNPricing.php',
    'VnpProductsModel'                                => 'system/modules/versionsNPrices/models/VnpProductsModel.php',
    'VnpVersionsModel'                                => 'system/modules/versionsNPrices/models/VnpVersionsModel.php',
    'VnpAttributesModel'                              => 'system/modules/versionsNPrices/models/VnpAttributesModel.php',
    'VnpPaymentTypesModel'                            => 'system/modules/versionsNPrices/models/VnpPaymentTypesModel.php',
    'VnpVersionPricesModel'                           => 'system/modules/versionsNPrices/models/VnpVersionPricesModel.php',
    'VnpVersionAttributesModel'                       => 'system/modules/versionsNPrices/models/VnpVersionAttributesModel.php',
));

TemplateLoader::addFiles(array(
    'vnp_default'       => 'system/modules/versionsNPrices/templates',

    // Isotope
    'iso_reader_vnp'    => 'system/modules/versionsNPrices/templates/isotope',
));