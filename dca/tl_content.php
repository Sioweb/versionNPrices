<?php

/**
 * Contao Open Source CMS
 */

/**
 * @file tl_content.php
 * @author Sascha Weidner
 * @version 3.0.0
 * @package sioweb.contao.extensions.vnp
 * @copyright Sascha Weidner, Sioweb
 */


/* Contao 3.2 support */
if(empty($GLOBALS['vnp_pricing']['headlineUnit']))
  $this->loadLanguageFile('default');

$GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = array('tl_vnp_content', 'loadVNPPalette');

$GLOBALS['TL_DCA']['tl_content']['palettes']['vnp_pricing'] = '{type_legend},type,headline;{vnp_legend},vnp_product;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';

$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'vnp_product';
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['vnp_product'] = 'vnp_versions,vnp_attributes,vnp_disclaimer';


$GLOBALS['TL_DCA']['tl_content']['fields']['vnp_product'] = array
(
  'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vnp_product'],
  'inputType'               => 'select',
  'foreignKey'              => 'tl_vnp_products.product',
  'eval'                    => array('tl_class'=>'w50 clr','includeBlankOption'=>true,'submitOnChange'=>true),
  'sql'                     => "varchar(20) NOT NULL default ''",
);
$GLOBALS['TL_DCA']['tl_content']['fields']['vnp_versions'] = array
(
  'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vnp_versions'],
  'inputType'               => 'checkboxWizard',
  'options_callback'        => array('tl_vnp_content', 'getVersions'),
  'eval'                    => array('multiple'=>true,'tl_class'=>'w50 clr'),
  'sql'                     => "blob NULL",
);
$GLOBALS['TL_DCA']['tl_content']['fields']['vnp_attributes'] = array
(
  'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vnp_attributes'],
  'inputType'               => 'checkboxWizard',
  'options_callback'        => array('tl_vnp_content', 'getAttributes'),
  'eval'                    => array('multiple'=>true,'tl_class'=>'w50 clr'),
  'sql'                     => "blob NULL",
);
$GLOBALS['TL_DCA']['tl_content']['fields']['vnp_disclaimer'] = array
(
  'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vnp_disclaimer'],
  'inputType'               => 'listWizard',
  'eval'                    => array('multiple'=>true,'tl_class'=>'long clr'),
  'sql'                     => "blob NULL",
);


class tl_vnp_content extends Backend
{
  /**
   * Import the back end user object
   */
  public function __construct()
  {
    parent::__construct();
    $this->import('BackendUser', 'User');
  }

  private function getVNPProduct($id) {
    $objModule = $this->Database->prepare("SELECT vnp_product FROM tl_content WHERE id=?")
                      ->limit(1)
                      ->execute($id);
    return $objModule->vnp_product;
  }

  public function loadVNPPalette(DataContainer $dc) {
    $vnp_product = $this->getVNPProduct($dc->id);
    if(!empty($vnp_product))
      $GLOBALS['TL_DCA']['tl_content']['palettes']['vnp_pricing'] = str_replace(',vnp_product',',vnp_product,'.$GLOBALS['TL_DCA']['tl_content']['subpalettes']['vnp_product'],$GLOBALS['TL_DCA']['tl_content']['palettes']['vnp_pricing']);
  }

  public function getVersions(DataContainer $dc) {
    $vnp_product = $this->getVNPProduct($dc->id);

    $arrVersions = array();
    $objVersion = $this->Database->prepare("SELECT id, version FROM tl_vnp_versions WHERE pid = ?")->execute($vnp_product);
    
    while ($objVersion->next())
    {
      $arrVersions[$objVersion->id] = $objVersion->version;
    }

    return $arrVersions;
  }

  public function getAttributes() {
    $arrAttributes = array();
    $objAttributes = $this->Database->execute("SELECT id, headline FROM tl_vnp_attributes ORDER BY headline");

    while ($objAttributes->next())
    {
      if ($this->User->hasAccess($objAttributes->id, 'vnp_attributes'))
      {
        $arrAttributes[$objAttributes->id] = $objAttributes->headline;
      }
    }

    return $arrAttributes;
  }

}