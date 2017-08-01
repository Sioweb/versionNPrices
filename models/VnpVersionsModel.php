<?php

/**
* Contao Open Source CMS
*/


/*
* @file VnpVersionsModel.php
* @class VnpVersionsModel
* @author Sascha Weidner
* @version 3.0.0
* @package sioweb.contao.extensions.vnp
* @copyright Sascha Weidner, Sioweb
*/

if(!class_exists('VnpVersionsModel')) {
  
class VnpVersionsModel extends Model {
  /**
   * Table name
   * @var string
   */
  protected static $strTable = 'tl_vnp_versions';
}

}