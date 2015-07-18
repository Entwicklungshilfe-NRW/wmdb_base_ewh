<?php
/**
 * Created by PhpStorm.
 * User: Florian
 * Date: 23.09.2014
 * Time: 07:41
 */

if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

/**
 * - Define own palette
 */
$GLOBALS['TCA']['tt_content']['palettes']['wmdblayout'] =  array('showitem' => 'tx_wmdbbaseewh_list_type, sys_language_uid, colPos, section_frame, sectionIndex, hidden', 'canNotCollapse' => 1);

$GLOBALS['TCA']['tt_content']['types'][$_EXTKEY . '_cached']['subtype_value_field'] = 'tx_wmdbbaseewh_list_type';
$GLOBALS['TCA']['tt_content']['types'][$_EXTKEY . '_uncached']['subtype_value_field'] = $GLOBALS['TCA']['tt_content']['types'][$_EXTKEY . '_cached']['subtype_value_field'];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array(
	'LLL:EXT:' . $_EXTKEY . '/locallang_db.xml:tt_content.CType.Cached',
	$_EXTKEY . '_cached',
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'ext_icon.gif'
),'CType', $_EXTKEY);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array(
	'LLL:EXT:' . $_EXTKEY . '/locallang_db.xml:tt_content.CType.Uncached',
	$_EXTKEY . '_uncached',
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'ext_icon.gif'
),'CType', $_EXTKEY);

$tempColumns = array(
	'tx_wmdbbaseewh_list_type' => array(
		'label' => 'LLL:EXT:' . $_EXTKEY . '/locallang_db.xml:CType.ListLabel',
		'config' => array(
			'type' => 'user',
			'userFunc' => 'TYPO3\\WmdbBaseEwh\\TCA\\CustomFields->getFieldTxWmdbBaseEwhListType',
			'items' => array(
				array(''),
			),
		),
	)
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $tempColumns);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('tt_content', 'wmdblayout', 'tx_wmdbbaseewh_list_type', 'before:sys_language_uid');

$requestUpdateFields = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $GLOBALS['TCA']['tt_content']['ctrl']['requestUpdate'], true);
$requestUpdateFields[] = 'tx_wmdbbaseewh_list_type';
$requestUpdateFields = array_unique($requestUpdateFields);
$GLOBALS['TCA']['tt_content']['ctrl']['requestUpdate'] = implode(',', $requestUpdateFields);


//if (TYPO3_MODE === 'BE' && isset($_SERVER['WMDB_LOCAL']) && file_exists(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'mod1/index.php')) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addModulePath('tools_txwmdbbaseewhM1', \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'mod1/');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addModule('tools', 'txwmdbbaseewhM1', '', \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'mod1/');
//}



$allPossibleOptions = 'bodytext;;;richtext:rte_transform[flag=rte_enabled|mode=ts_css], pi_flexform, subheader, header_link, image, media, imagewidth, imageorient, imagecaption, imagecols, imageborder, layout, records';
$GLOBALS['TCA']['tt_content']['types'][$_EXTKEY . '_cached']['showitem'] = '
	CType;;wmdblayout;;1-1-1, header;;3;;2-2-2,,
	--div--;LLL:EXT:cms/locallang_ttc.xlf:CType.I.1, layout;;1-1-1, ' . $allPossibleOptions . ',
	--div--;LLL:EXT:cms/locallang_tca.xlf:pages.tabs.access, starttime, endtime, fe_group
	';
$GLOBALS['TCA']['tt_content']['types'][$_EXTKEY . '_cached']['subtypes_excludelist'][''] = 'header_link,sys_language_uid, colPos, section_frame, pi_flexform, sectionIndex,bodytext, subheader, pi_flexform,layout,spaceBefore,spaceAfter,section_frame';

/**
 * New option group:
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array('Testing group 1', '--div--1'), 'tx_wmdbbaseewh_list_type',$_EXTKEY);


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_wmdbbaseewh_slide');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToInsertRecords('tx_wmdbbaseewh_slide');
$TCA['tx_wmdbbaseewh_slide'] = array(
	'ctrl' => array(
		'title'     => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_slide',
		'label'     => 'headline',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/tx_wmdbbaseewh_slide.php',
		'iconfile'          => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'icon_tx_wmdbbaseewh_slide.gif',
	),
);



$TCA['tx_wmdbbaseewh_courses'] = array(
	'ctrl' => array(
		'title'     => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_courses',
		'label'     => 'headline',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/tx_wmdbbaseewh_courses.php',
		'iconfile'          => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'icon_tx_wmdbbaseewh_courses.gif',
	),
);


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
	$_EXTKEY,
	'tx_wmdbbaseewh_courses',
	'tx_wmdbbasewh_courses_cats',
	array(
		'label' => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_courses.category',
		'exclude' => FALSE,
		'fieldConfiguration' => array(
			'foreign_table_where' => ' AND sys_category.sys_language_uid IN (-1, 0) ORDER BY sys_category.title ASC',
		),
		'l10n_mode' => 'exclude',
		'l10n_display' => 'hideDiff',
	)
);


$TCA['tx_wmdbbaseewh_links'] = array(
    'ctrl' => array(
        'title'     => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_links',
        'label'     => 'label',
        'tstamp'    => 'tstamp',
        'crdate'    => 'crdate',
        'cruser_id' => 'cruser_id',
        'default_sortby' => 'ORDER BY crdate',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
        ),
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/tx_wmdbbaseewh_links.php',
        'iconfile'          => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'icon_tx_wmdbbaseewh_links.gif',
    ),
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_wmdbbaseewh_links');

$TCA['tx_wmdbbaseewh_speaker'] = array(
    'ctrl' => array(
        'title'     => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_speaker',
        'label'     => 'lastname',
        'tstamp'    => 'tstamp',
        'crdate'    => 'crdate',
        'cruser_id' => 'cruser_id',
        'default_sortby' => 'ORDER BY crdate',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/tx_wmdbbaseewh_speaker.php',
        'iconfile'          => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'icon_tx_wmdbbaseewh_speaker.gif',
    ),
);

$TCA['tx_wmdbbaseewh_speaker_milestones'] = array(
    'ctrl' => array(
        'title'     => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_speaker_milestones',
        'label'     => 'title',
        'tstamp'    => 'tstamp',
        'crdate'    => 'crdate',
        'cruser_id' => 'cruser_id',
        'default_sortby' => 'ORDER BY crdate',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
        ),
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/tx_wmdbbaseewh_speaker_milestones.php',
        'iconfile'          => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'icon_tx_wmdbbaseewh_speaker_milestones.gif',
    ),
);
/**
 * ##################################################
 * #		INCLUDE OF CE TYPE DEFINITIONS			#
 * ##################################################
 */
if(file_exists(PATH_site . 'typo3conf/ext/' . $_EXTKEY . '/Configuration/CEDefinition.php')) {
	include(PATH_site . 'typo3conf/ext/' . $_EXTKEY . '/Configuration/CEDefinition.php');
}

$GLOBALS['TCA']['tt_content']['types'][$_EXTKEY . '_uncached'] = $GLOBALS['TCA']['tt_content']['types'][$_EXTKEY . '_cached'];
$GLOBALS['TYPO3_CONF_VARS']['CONF'][$_EXTKEY] = $GLOBALS['TYPO3_CONF_VARS']['EXT'][$_EXTKEY];

/**
 * TypoScript inclusion
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Static/PageDefault/', 'Wmdb Base Entwicklungshilfe - Page default');


// New content element wizard
if (TYPO3_MODE=='BE') {
	$GLOBALS['TBE_MODULES_EXT']['xMOD_db_new_content_el']['addElClasses']['tx_wmdbbaseewh_cached_wizicon'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY, 'Classes/Wizicons/Cached.php');
	$GLOBALS['TBE_MODULES_EXT']['xMOD_db_new_content_el']['addElClasses']['tx_wmdbbaseewh_uncached_wizicon'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY, 'Classes/Wizicons/Uncached.php');
}