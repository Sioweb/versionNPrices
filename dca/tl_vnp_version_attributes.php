<?php

/**
* Contao Open Source CMS
*  
* @file tl_vnp_version_attributes.php
* @author Sascha Weidner
* @version 3.0.0
* @package sioweb.contao.extensions.dummy
* @copyright Sascha Weidner, Sioweb
*/

/**
 * Table tl_vnp_version_attributes 
 */
$GLOBALS['TL_DCA']['tl_vnp_version_attributes'] = array
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
      'fields'                  => array('attribute'),
      'flag'                    => 1,
      'panelLayout'             => 'sort,search,limit'
    ),
    'label' => array
    (
      'fields'                  => array('attribute', 'id'),
      'label_callback'          => array('tl_vnp_version_attributes', 'getLabels'),
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
        'label'               => &$GLOBALS['TL_LANG']['tl_vnp_version_attributes']['edit'],
        'href'                => 'act=edit',
        'icon'                => 'edit.gif'
      ),
      'copy' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_vnp_version_attributes']['copy'],
        'href'                => 'act=copy',
        'icon'                => 'copy.gif'
      ),
      'delete' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_vnp_version_attributes']['delete'],
        'href'                => 'act=delete',
        'icon'                => 'delete.gif',
        'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
      ),
      'show' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_vnp_version_attributes']['show'],
        'href'                => 'act=show',
        'icon'                => 'show.gif'
      )
    )
  ),

  // Palettes
  'palettes' => array(
    '__selector__'                => array('source'),
    'default'                     => '{title_legend},attribute,value,disclaimer'
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
    'attribute' => array(
      'label'                   => &$GLOBALS['TL_LANG']['tl_vnp_version_attributes']['attribute'],
      'inputType'               => 'select',
      'options_callback'        => array('tl_vnp_version_attributes', 'getAttributes'),
      'eval'                    => array('tl_class'=>'w50 clr'),
      'sql'                     => "blob NULL",
    ),
    'disclaimer' => array(
      'label'                   => &$GLOBALS['TL_LANG']['tl_vnp_version_attributes']['disclaimer'],
      'inputType'               => 'listWizard',
      'eval'                    => array('multiple'=>true,'tl_class'=>'long clr'),
      'sql'                     => "blob NULL",
    ),
    'value' => array(
      'label'                   => &$GLOBALS['TL_LANG']['tl_vnp_version_attributes']['value'],
      'exclude'                 => true,
      'inputType'               => 'text',
      'eval'                    => array('maxlength'=>255),
      'sql'                     => "varchar(255) NOT NULL default ''"
    )
  )
);

class tl_vnp_version_attributes extends Backend{
  
  public function __construct(){
    parent::__construct();
    $this->import('BackendUser', 'User');
  }

  public function getAttributes() {
    if (!$this->User->isAdmin && !is_array($this->User->news)) {
      return array();
    }

    $arrAttributes = array();
    $objAttributes = $this->Database->execute("SELECT id, headline FROM tl_vnp_attributes ORDER BY headline");

    while ($objAttributes->next()) {
      if ($this->User->hasAccess($objAttributes->id, 'vnp_attributes')) {
        $arrAttributes[$objAttributes->id] = $objAttributes->headline;
      }
    }

    return $arrAttributes;
  }


  public function getLabels($row, $label) {
    $Attribute = VnpAttributesModel::findByPk($row['attribute'])->row();
    if(!empty($row['value'])) {
      $Attribute['headline'] = sprintf($Attribute['headline'],$row['value'].'<span style="color:#b3b3b3; padding-left:3px;">(<del>'.$Attribute['value'].'</del>)</span>');
    }
    return sprintf('%s <span style="color:#b3b3b3; padding-left:3px;">[%s]</span>',$Attribute['headline'],$row['id']);
  }
}