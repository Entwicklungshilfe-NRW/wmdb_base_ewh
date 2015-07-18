<?php
namespace TYPO3\WmdbBaseEwh\Hooks;
	/***************************************************************
	 *  Copyright notice
	 *
	 *  (c) 2008 Dmitry Dulepov <dmitry@typo3.org>
	 *  All rights reserved
	 *
	 *  This script is part of the TYPO3 project. The TYPO3 project is
	 *  free software; you can redistribute it and/or modify
	 *  it under the terms of the GNU General Public License as published by
	 *  the Free Software Foundation; either version 2 of the License, or
	 *  (at your option) any later version.
	 *
	 *  The GNU General Public License can be found at
	 *  http://www.gnu.org/copyleft/gpl.html.
	 *
	 *  This script is distributed in the hope that it will be useful,
	 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
	 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 *  GNU General Public License for more details.
	 *
	 *  This copyright notice MUST APPEAR in all copies of the script!
	 ***************************************************************/

/**
 * Hook to display verbose information about pi1 plugin in Web>Page module
 *
 * @author	Sebastian Hens <sebastian.hens@wmdb.de>
 * @package	TYPO3
 * @subpackage	wmdb_base_defualt
 */

class CmsLayout implements \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface {
	/**
	 * Preprocesses the preview rendering of a content element.
	 *
	 * @param	\TYPO3\CMS\Backend\View\PageLayoutView		$parentObject: Calling parent object
	 * @param	boolean				$drawItem: Whether to draw the item using the default functionalities
	 * @param	string				$headerContent: Header content
	 * @param	string				$itemContent: Item content
	 * @param	array				$row: Record row of tt_content
	 * @return	void
	 */
	public function preProcess(\TYPO3\CMS\Backend\View\PageLayoutView &$parentObject, &$drawItem, &$headerContent, &$itemContent, array &$row) {
		$cType = str_replace(array('_uncached', '_cached'), '_pi1', $row['CType']);
		$extKey = str_replace('_pi1', '', $cType);
		$listType = $GLOBALS['TYPO3_CONF_VARS']['WmdbCMSLayoutHook'][$cType];
		$innerCes = $GLOBALS['TCA']['tt_content']['columns'][$listType]['config']['items'];
		if( $listType != '') {
			$listLabel = $GLOBALS['LANG']->sL('LLL:EXT:' . $extKey . '/locallang_db.xml:CType.ListLabel');
			$label = $this->getLabelForCE($innerCes, $row[$listType]);
			$headerContent = '
			<span class="t3-page-ce-body" style="border-width:0;border-bottom-width:1px;display: inline-block;padding: 0;background: transparent;width: 100%;padding-bottom: 4px;margin-bottom: 10px;">
				<b>' . $listLabel . '</b> ' . $label . '
			</span>' . $headerContent;
		}
	}

	private function getLabelForCE($ce, $listType) {
		$label = '[no label]';
		foreach($ce AS $item) {
			$search = array_search($listType, $item);
			if( $search !== FALSE) {
				$label = $item[0];
				if(substr($label, 0, 4) == 'LLL:') {
					$label = $GLOBALS['LANG']->sL($label);
				}
				break;
			}
		}
		return $label;
	}
}

?>