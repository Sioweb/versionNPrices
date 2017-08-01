<?php

/**
* Contao Open Source CMS
*/


/*
* @file VnpPaymentTypesModel.php
* @class VnpPaymentTypesModel
* @author Sascha Weidner
* @version 3.0.0
* @package sioweb.contao.extensions.vnp
* @copyright Sascha Weidner, Sioweb
*/

if(!class_exists('VnpPaymentTypesModel')) {
  
class VnpPaymentTypesModel extends Model {
  /**
   * Table name
   * @var string
   */
  protected static $strTable = 'tl_vnp_payment_types';
}

}