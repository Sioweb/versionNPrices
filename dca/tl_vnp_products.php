<?php

/**
* Contao Open Source CMS
*  
* @file tl_vnp_products.php
* @author Sascha Weidner
* @version 3.0.0
* @package sioweb.contao.extensions.dummy
* @copyright Sascha Weidner, Sioweb
*/

/**
 * Table tl_vnp_products 
 */
$GLOBALS['TL_DCA']['tl_vnp_products'] = array
(

  // Config
  'config' => array
  (
    'dataContainer'               => 'Table',
    'ctable'                      => array('tl_vnp_versions'),
    'switchToEdit'                => true,
    'enableVersioning'            => true,
    'sql' => array(
      'keys' => array (
        'id' => 'primary'
      )
    )
  ),

  // List
  'list' => array
  (
    'sorting' => array
    (
      'mode'                    => 1,
      'fields'                  => array('product'),
      'flag'                    => 1,
      'panelLayout'             => 'sort,search,limit'
    ),
    'label' => array
    (
      'fields'                  => array('product', 'id'),
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
        'label'               => &$GLOBALS['TL_LANG']['tl_vnp_products']['edit'],
        'href'                => 'table=tl_vnp_versions',
        'icon'                => 'edit.gif',
      ),
      'editheader' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_vnp_products']['editheader'],
        'href'                => 'act=edit',
        'icon'                => 'header.gif',
      ),
      'copy' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_vnp_products']['copy'],
        'href'                => 'act=copy',
        'icon'                => 'copy.gif'
      ),
      'delete' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_vnp_products']['delete'],
        'href'                => 'act=delete',
        'icon'                => 'delete.gif',
        'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
      ),
      'show' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_vnp_products']['show'],
        'href'                => 'act=show',
        'icon'                => 'show.gif'
      )
    )
  ),

  // Palettes
  'palettes' => array(
    'default'                     => '{title_legend},product'
  ),

  // Fields
  'fields' => array(
    'id' => array(
      'sql'           => "int(10) unsigned NOT NULL auto_increment",
      'foreignKey'    => 'tl_vnp_versions.id',
      'relation'      => array('type'=>'hasMany', 'load'=>'eager', 'field'=>'pid')
    ),
    'sorting' => array(
      'sql'           => "int(10) unsigned NOT NULL default '0'"
    ),
    'tstamp' => array(
      'sql'           => "int(10) unsigned NOT NULL default '0'"
    ),
    'product' => array(
      'label'                   => &$GLOBALS['TL_LANG']['tl_vnp_products']['product'],
      'exclude'                 => true,
      'inputType'               => 'text',
      'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
      'sql'                     => "varchar(255) NOT NULL default ''"
    ),
    // 'author' => array
    // (
    //   'label'                   => &$GLOBALS['TL_LANG']['tl_vnp_products']['addOnlyTrueLinks'],
    //   'exclude'                 => true,
    //   'inputType'               => 'checkbox',
    //   'eval'                    => array('submitOnChange'=>true),
    //   'sql'                     => "char(1) NOT NULL default ''"
    // ),
  )
);

class tl_vnp_products extends Backend{
  
  public function __construct(){
    parent::__construct();
    $this->import('BackendUser', 'User');
  }

  /* Alle Methoden definieren die in der DCA oben angegeben wurden */
}