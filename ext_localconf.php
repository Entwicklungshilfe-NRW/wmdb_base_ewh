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


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPItoST43($_EXTKEY, 'Classes/Dispatcher/PluginMainCached.php', '_cached', 'CType', 1);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPItoST43($_EXTKEY, 'Classes/Dispatcher/PluginMainUncached.php', '_uncached', 'CType', 0);

/**
 * Hook um Flexforms für das eigene list_type-Feld zu ermöglichen
 */
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_befunc.php']['getFlexFormDSClass'][] = 'TYPO3\\WmdbBaseEwh\\Hooks\\GetFlexFormDSClass';

$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['wmdb_base_ewh'] = 'EXT:' . $_EXTKEY . '/Classes/Dispatcher/EIDDispatcher.php';

/**
 * ##################################################
 * #		INCLUDE OF CE TYPE DEFINITIONS			#
 * ##################################################
 */
if(file_exists(PATH_site . 'typo3conf/ext/' . $_EXTKEY . '/Configuration/CEDefinition.php')) {
	require_once(PATH_site . 'typo3conf/ext/' . $_EXTKEY . '/Configuration/CEDefinition.php');
}

$GLOBALS['TYPO3_CONF_VARS']['WmdbCMSLayoutHook'][$_EXTKEY . '_pi1'] = 'tx_wmdbbaseewh_list_type';
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['WmdbCMSLayoutHook'] = 'TYPO3\\WmdbBaseEwh\\Hooks\\CmsLayout';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('options.saveDocNew.tx_wmdbbaseewh_slide=1');


?>