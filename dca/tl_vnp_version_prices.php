<?php

/**
* Contao Open Source CMS
*  
* @file tl_vnp_version_prices.php
* @author Sascha Weidner
* @version 3.0.0
* @package sioweb.contao.extensions.dummy
* @copyright Sascha Weidner, Sioweb
*/

/**
 * Table tl_vnp_version_prices 
 */
$GLOBALS['TL_DCA']['tl_vnp_version_prices'] = array
(

  // Config
  'config' => array
  (
    'dataContainer'               => 'Table',
    'ptable'                      => 'tl_vnp_versions',
    'enableVersioning'            => true,
    'switchToEdit'                => true,
    'enableVersioning'            => true,
    'sql' => array
    (
      'keys' => array
      (
        'id' => 'primary',
        'pid' => 'index'
      )
    )
  ),

  // List
  'list' => array
  (
    'sorting' => array
    (
      'mode'                    => 1,
      'fields'                  => array('paymentType'),
      'flag'                    => 1,
      'panelLayout'             => 'sort,search,limit'
    ),
    'label' => array
    (
      'fields'                  => array('paymentType', 'id'),
      'label_callback'          => array('tl_vnp_version_prices', 'getLabels'),
      'format'                  => '%s <span style="color:#b3b3b3; padding-left:3px;">[%s]</span>'
    ),
    'global_operations' => array
    (
      'all' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
        'href'                => 'act=select', 
        'class'               => 'header_edit_all',
        'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
      )
    ),

    'operations' => array
    (
      'edit' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_vnp_version_prices']['edit'],
        'href'                => 'act=edit',
        'icon'                => 'edit.gif'
      ),
      'copy' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_vnp_version_prices']['copy'],
        'href'                => 'act=copy',
        'icon'                => 'copy.gif'
      ),
      'delete' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_vnp_version_prices']['delete'],
        'href'                => 'act=delete',
        'icon'                => 'delete.gif',
        'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
      ),
      'show' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_vnp_version_prices']['show'],
        'href'                => 'act=show',
        'icon'                => 'show.gif'
      )
    )
  ),

  // Palettes
  'palettes' => array(
    '__selector__'                => array('source'),
    'default'                     => '{title_legend},paymentType,price'
  ),

  // Fields
  'fields' => array(
    'id' => array(
      'sql'           => "int(10) unsigned NOT NULL auto_increment"
    ),
    'pid' => array(
      'sql'           => "int(10) unsigned NOT NULL"
    ),
    'sorting' => array(
      'sql'           => "int(10) unsigned NOT NULL default '0'"
    ),
    'tstamp' => array(
      'sql'           => "int(10) unsigned NOT NULL default '0'"
    ),
    'paymentType' => array(
      'label'                   => &$GLOBALS['TL_LANG']['tl_vnp_version_prices']['paymentType'],
      'exclude'                 => true,
      'inputType'               => 'select',
      'foreignKey'              => 'tl_vnp_payment_types.headline',
      'relation'                => array('type'=>'belongsTo', 'load'=>'eager'),
      'eval'                    => array('mandatory'=>true),
      'sql'                     => "blob NULL"
    ),
    'price' => array(
      'label'                   => &$GLOBALS['TL_LANG']['tl_vnp_version_prices']['price'],
      'exclude'                 => true,
      'inputType'               => 'text',
      'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
      'sql'                     => "varchar(255) NOT NULL default ''"
    )
  )
);

class tl_vnp_version_prices extends Backend{
  
  public function __construct(){
    parent::__construct();
    $this->import('BackendUser', 'User');
  }


  public function getLabels($row, $label) {
    $Attribute = VnpPaymentTypesModel::findByPk($row['paymentType'])->row();
    return sprintf('%s <span style="color:#b3b3b3; padding-left:3px;">[%s]</span>',$Attribute['headline'],$row['id']);
  }

}