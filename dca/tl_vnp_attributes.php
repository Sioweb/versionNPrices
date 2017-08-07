<?php

/**
* Contao Open Source CMS
*  
* @file tl_vnp_attributes.php
* @author Sascha Weidner
* @version 3.0.0
* @package sioweb.contao.extensions.dummy
* @copyright Sascha Weidner, Sioweb
*/

/**
 * Table tl_vnp_attributes 
 */
$GLOBALS['TL_DCA']['tl_vnp_attributes'] = array
(

  // Config
  'config' => array
  (
    'dataContainer'               => 'Table',
    'enableVersioning'            => true,
    'sql' => array(
      'keys' => array (
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
      'fields'                  => array('headline'),
      'flag'                    => 1
    ),
    'label' => array
    (
      'fields'                  => array('headline', 'id'),
      'label_callback'          => array('tl_vnp_attributes', 'getLabels'),
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
        'label'               => &$GLOBALS['TL_LANG']['tl_vnp_attributes']['edit'],
        'href'                => 'act=edit',
        'icon'                => 'edit.gif'
      ),
      'copy' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_vnp_attributes']['copy'],
        'href'                => 'act=copy',
        'icon'                => 'copy.gif'
      ),
      'delete' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_vnp_attributes']['delete'],
        'href'                => 'act=delete',
        'icon'                => 'delete.gif',
        'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
      ),
      'show' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_vnp_attributes']['show'],
        'href'                => 'act=show',
        'icon'                => 'show.gif'
      )
    )
  ),

  // Palettes
  'palettes' => array(
    '__selector__'                => array('source'),
    'default'                     => '{title_legend},headline,description,value;{source_legend},source'
  ),

  // Subpalettes
  'subpalettes' => array
  (
    'source_internal'             => 'jumpTo',
    'source_article'              => 'articleId',
    'source_external'             => 'url,target'
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
    'headline' => array(
      'label'                   => &$GLOBALS['TL_LANG']['tl_vnp_attributes']['headline'],
      'exclude'                 => true,
      'inputType'               => 'text',
      'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
      'sql'                     => "varchar(255) NOT NULL default ''"
    ),
    'headline' => array(
      'label'                   => &$GLOBALS['TL_LANG']['tl_vnp_attributes']['headline'],
      'exclude'                 => true,
      'inputType'               => 'text',
      'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
      'sql'                     => "varchar(255) NOT NULL default ''"
    ),
    'description' => array(
      'label'                   => &$GLOBALS['TL_LANG']['tl_vnp_attributes']['description'],
      'exclude'                 => true,
      'search'                  => true,
      'inputType'               => 'textarea',
      'eval'                    => array('rte'=>'tinyMCE','style'=>'height: 50px;','tl_class'=>'clr long','gsIgnore'=>true),
      'sql'                     => "text NULL"
    ),
    'value' => array(
      'label'                   => &$GLOBALS['TL_LANG']['tl_vnp_attributes']['value'],
      'exclude'                 => true,
      'inputType'               => 'text',
      'eval'                    => array('maxlength'=>255),
      'sql'                     => "varchar(255) NOT NULL default ''"
    ),
    'source' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_vnp_attributes']['source'],
      'default'                 => 'default',
      'exclude'                 => true,
      'filter'                  => true,
      'inputType'               => 'radio',
      'options_callback'        => array('tl_vnp_attributes', 'getSourceOptions'),
      'reference'               => &$GLOBALS['TL_LANG']['tl_vnp_attributes'],
      'eval'                    => array('submitOnChange'=>true, 'helpwizard'=>true),
      'sql'                     => "varchar(12) NOT NULL default ''"
    ),
    'jumpTo' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_vnp_attributes']['jumpTo'],
      'exclude'                 => true,
      'inputType'               => 'pageTree',
      'foreignKey'              => 'tl_page.title',
      'eval'                    => array('mandatory'=>true, 'fieldType'=>'radio'),
      'sql'                     => "int(10) unsigned NOT NULL default '0'",
      'relation'                => array('type'=>'belongsTo', 'load'=>'lazy')
    ),
    'articleId' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_vnp_attributes']['articleId'],
      'exclude'                 => true,
      'inputType'               => 'select',
      'options_callback'        => array('tl_vnp_attributes', 'getArticleAlias'),
      'eval'                    => array('chosen'=>true, 'mandatory'=>true),
      'sql'                     => "int(10) unsigned NOT NULL default '0'"
    ),
    'url' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['MSC']['url'],
      'exclude'                 => true,
      'search'                  => true,
      'inputType'               => 'text',
      'eval'                    => array('mandatory'=>true, 'decodeEntities'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
      'sql'                     => "varchar(255) NOT NULL default ''"
    ),
    'target' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['MSC']['target'],
      'exclude'                 => true,
      'inputType'               => 'checkbox',
      'eval'                    => array('tl_class'=>'w50 m12'),
      'sql'                     => "char(1) NOT NULL default ''"
    ),
  )
);

class tl_vnp_attributes extends Backend{
  
  public function __construct(){
    parent::__construct();
    $this->import('BackendUser', 'User');
  }


  /**
   * Get all articles and return them as array
   *
   * @param DataContainer $dc
   *
   * @return array
   */
  public function getArticleAlias(DataContainer $dc)
  {
    $arrPids = array();
    $arrAlias = array();

    if (!$this->User->isAdmin)
    {
      foreach ($this->User->pagemounts as $id)
      {
        $arrPids[] = $id;
        $arrPids = array_merge($arrPids, $this->Database->getChildRecords($id, 'tl_page'));
      }

      if (empty($arrPids))
      {
        return $arrAlias;
      }

      $objAlias = $this->Database->prepare("SELECT a.id, a.title, a.inColumn, p.title AS parent FROM tl_article a LEFT JOIN tl_page p ON p.id=a.pid WHERE a.pid IN(". implode(',', array_map('intval', array_unique($arrPids))) .") ORDER BY parent, a.sorting")
                     ->execute($dc->id);
    }
    else
    {
      $objAlias = $this->Database->prepare("SELECT a.id, a.title, a.inColumn, p.title AS parent FROM tl_article a LEFT JOIN tl_page p ON p.id=a.pid ORDER BY parent, a.sorting")
                     ->execute($dc->id);
    }

    if ($objAlias->numRows)
    {
      System::loadLanguageFile('tl_article');

      while ($objAlias->next())
      {
        $arrAlias[$objAlias->parent][$objAlias->id] = $objAlias->title . ' (' . ($GLOBALS['TL_LANG']['COLS'][$objAlias->inColumn] ?: $objAlias->inColumn) . ', ID ' . $objAlias->id . ')';
      }
    }

    return $arrAlias;
  }


  /**
   * Add the source options depending on the allowed fields (see #5498)
   *
   * @param DataContainer $dc
   *
   * @return array
   */
  public function getSourceOptions(DataContainer $dc)
  {
    if ($this->User->isAdmin)
    {
      return array('default', 'internal', 'article', 'external');
    }

    $arrOptions = array('default');

    // Add the "internal" option
    if ($this->User->hasAccess('tl_news::jumpTo', 'alexf'))
    {
      $arrOptions[] = 'internal';
    }

    // Add the "article" option
    if ($this->User->hasAccess('tl_news::articleId', 'alexf'))
    {
      $arrOptions[] = 'article';
    }

    // Add the "external" option
    if ($this->User->hasAccess('tl_news::url', 'alexf'))
    {
      $arrOptions[] = 'external';
    }

    // Add the option currently set
    if ($dc->activeRecord && $dc->activeRecord->source != '')
    {
      $arrOptions[] = $dc->activeRecord->source;
      $arrOptions = array_unique($arrOptions);
    }

    return $arrOptions;
  }


  public function getLabels($row, $label) {
    if(!empty($row['value'])) {
      $row['headline'] = sprintf($row['headline'],$row['value']);
    }
    return sprintf('%s <span style="color:#b3b3b3; padding-left:3px;">[%s]</span>',$row['headline'],$row['id']);
  }
}