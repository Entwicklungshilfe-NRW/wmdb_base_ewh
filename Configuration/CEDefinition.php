<?php



\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array('Kurse', 'Courses'), 'tx_wmdbbaseewh_list_type','wmdb_base_ewh');
$GLOBALS["TCA"]["tt_content"]["types"]["wmdb_base_ewh_cached"]["subtypes_excludelist"]["Courses"] = "bodytext,image,media,imagewidth,imageorient,imagecaption,imagecols,imageborder,layout,records";
$GLOBALS["TYPO3_CONF_VARS"]["EXT"]["wmdb_base_ewh"]["specialsMapping"]["Courses"] = array("class" => 'TYPO3\WmdbBaseEwh\CustomContentElements\Courses');
$GLOBALS["TCA"]["tt_content"]["columns"]["pi_flexform"]["config"]["ds"]["Courses,wmdb_base_ewh_pi1"] = "FILE:EXT:wmdb_base_ewh/Resources/Private/Flexforms/Courses.xml";


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array('Item teaser', 'ItemTeaser'), 'tx_wmdbbaseewh_list_type','wmdb_base_ewh');
$GLOBALS["TCA"]["tt_content"]["types"]["wmdb_base_ewh_cached"]["subtypes_excludelist"]["ItemTeaser"] = "bodytext,pi_flexform,media,imagewidth,imageorient,imagecaption,imagecols,imageborder,layout,records";


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array('Link Liste', 'LinkList'), 'tx_wmdbbaseewh_list_type','wmdb_base_ewh');
$GLOBALS["TCA"]["tt_content"]["types"]["wmdb_base_ewh_cached"]["subtypes_excludelist"]["LinkList"] = "bodytext,subheader,image,media,imagewidth,imageorient,imagecaption,imagecols,imageborder,layout,records";
$GLOBALS["TYPO3_CONF_VARS"]["EXT"]["wmdb_base_ewh"]["specialsMapping"]["LinkList"] = array("class" => 'TYPO3\WmdbBaseEwh\CustomContentElements\LinkList');
$GLOBALS["TCA"]["tt_content"]["columns"]["pi_flexform"]["config"]["ds"]["LinkList,wmdb_base_ewh_pi1"] = "FILE:EXT:wmdb_base_ewh/Resources/Private/Flexforms/LinkList.xml";


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array('Slider', 'Slider'), 'tx_wmdbbaseewh_list_type','wmdb_base_ewh');
$GLOBALS["TCA"]["tt_content"]["types"]["wmdb_base_ewh_cached"]["subtypes_excludelist"]["Slider"] = "bodytext,subheader,image,media,imagewidth,imageorient,imagecaption,imagecols,imageborder,layout,records";
$GLOBALS["TYPO3_CONF_VARS"]["EXT"]["wmdb_base_ewh"]["specialsMapping"]["Slider"] = array("class" => 'TYPO3\WmdbBaseEwh\CustomContentElements\Slider');
$GLOBALS["TCA"]["tt_content"]["columns"]["pi_flexform"]["config"]["ds"]["Slider,wmdb_base_ewh_pi1"] = "FILE:EXT:wmdb_base_ewh/Resources/Private/Flexforms/Slider.xml";


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array('Multiple Teaser', 'Teaser'), 'tx_wmdbbaseewh_list_type','wmdb_base_ewh');
$GLOBALS["TCA"]["tt_content"]["types"]["wmdb_base_ewh_cached"]["subtypes_excludelist"]["Teaser"] = "bodytext,subheader,image,media,imagewidth,imageorient,imagecaption,imagecols,imageborder,layout";
$GLOBALS["TYPO3_CONF_VARS"]["EXT"]["wmdb_base_ewh"]["specialsMapping"]["Teaser"] = array("class" => 'TYPO3\WmdbBaseEwh\CustomContentElements\Teaser');
$GLOBALS["TCA"]["tt_content"]["columns"]["pi_flexform"]["config"]["ds"]["Teaser,wmdb_base_ewh_pi1"] = "FILE:EXT:wmdb_base_ewh/Resources/Private/Flexforms/Teaser.xml";


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array('Text elements', 'TextElement'), 'tx_wmdbbaseewh_list_type','wmdb_base_ewh');
$GLOBALS["TCA"]["tt_content"]["types"]["wmdb_base_ewh_cached"]["subtypes_excludelist"]["TextElement"] = "bodytext,image,media,imagewidth,imageorient,imagecaption,imagecols,imageborder,layout,records";
$GLOBALS["TYPO3_CONF_VARS"]["EXT"]["wmdb_base_ewh"]["specialsMapping"]["TextElement"] = array("class" => 'TYPO3\WmdbBaseEwh\CustomContentElements\TextElement');
$GLOBALS["TCA"]["tt_content"]["columns"]["pi_flexform"]["config"]["ds"]["TextElement,wmdb_base_ewh_pi1"] = "FILE:EXT:wmdb_base_ewh/Resources/Private/Flexforms/TextElement.xml";