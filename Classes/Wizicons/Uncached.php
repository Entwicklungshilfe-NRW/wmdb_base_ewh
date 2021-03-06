<?php
/**
 * Created by PhpStorm.
 * User: Florian
 * Date: 25.09.2014
 * Time: 21:21
 */

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Sebastian Hens <sebastian.hens@wmdb.de>
 *
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
 *  A copy is found in the textfile GPL.txt and important notices to the license
 *  from the author is found in LICENSE.txt distributed with these scripts.
 *
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

class tx_wmdbbaseewh_uncached_wizicon {

	/**
	 * Processing the wizard items array
	 *
	 * @param	array		$wizardItems: The wizard items
	 * @return	array		array with wizard items
	 */
	public function proc($wizardItems)	{
		$LL = $this->includeLocalLang();

		$wizardItems['plugins_wmdb_base_ewh_uncached'] = array(
			'icon' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('wmdb_base_ewh') . 'Resources/Public/images/wmdb_icon_24x24.gif',
			'title' => $GLOBALS['LANG']->getLLL('tt_content.CType.Cached', $LL),
			'description' => $GLOBALS['LANG']->getLLL('tt_content.CType.uncached_description', $LL),
			'params' => '&defVals[tt_content][CType]=wmdb_base_ewh_uncached',
			'tt_content_defValues' => array(
				'CType' => 'wmdb_base_ewh_uncached',
			),
		);

		return $wizardItems;
	}

	/**
	 * Reads the [extDir]/locallang_db.xml and returns the $LOCAL_LANG array found in that file.
	 *
	 * @return	The array with language labels
	 */
	public function includeLocalLang()	{
		$llFile = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('wmdb_base_ewh') . 'locallang_db.xml';
		$parser = new \TYPO3\CMS\Core\Localization\Parser\LocallangXmlParser();
		return $parser->getParsedData($llFile, $GLOBALS['LANG']->lang);
	}
}
?>