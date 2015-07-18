<?php
namespace TYPO3\WmdbBaseEwh\Hooks;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Florian Peters < florian.peters@wmdb.de>
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

/**
 * Hook für t3lib/class.t3lib_befunc.php -> getFlexFormDSClass um Flexforms für unser
 * eigenes list_type-Feld "tx_wmdbbaseewh_list_type" zu ermöglichen.
 *
 * @author Sebastian Hens, Andreas Grunwald
 * @package TYPO3
 * @subpackage EXT:wmdb_base_ewh
 */
class GetFlexFormDSClass {

    public function getFlexFormDS_postProcessDS(&$dataStructArray, $conf, $row, $table, $fieldName) {
		$cType = str_replace(array('_uncached', '_cached'), '_pi1', $row['CType']);
		// Wenn unser eigenes list_type-Feld ausgewählt wurde (tx_wmdbdefaultbase_list_type)
		// UND wir eine Extension haben die mit "wmdb_ewh" anfängt (z.B. wmdb_ewh_base)
		// UND ein Flexform definiert wurde, zeige es an :)
		if (strstr($cType, 'wmdb_base_ewh') !== false && $row['tx_wmdbbaseewh_list_type'] && isset($conf['ds'][$row['tx_wmdbbaseewh_list_type'] . ',' . $cType]) === TRUE) {

			$flexformString = $conf['ds'][$row['tx_wmdbbaseewh_list_type'] . ',' . $cType];
			if (substr($flexformString, 0, 5) == 'FILE:') {
				$file = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(substr($flexformString, 5));

				if ($file && @is_file($file)) {
					$dataStructArray = \TYPO3\CMS\Core\Utility\GeneralUtility::xml2array(\TYPO3\CMS\Core\Utility\GeneralUtility::getUrl($file));
				} else {
					$dataStructArray = 'The file "' . substr($flexformString, 5) . '" in ds-array was not found ("' . $file . '")';
				}
			}
		}
	}
}
?>
