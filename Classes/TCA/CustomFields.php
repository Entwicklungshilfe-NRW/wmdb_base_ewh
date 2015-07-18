<?php
/**
 * Created by PhpStorm.
 * User: Florian
 * Date: 25.09.2014
 * Time: 21:34
 */
namespace TYPO3\WmdbBaseEwh\TCA;

class CustomFields {

	/**
	 * @param array                              $PA
	 * @param \TYPO3\CMS\Backend\Form\FormEngine $fObj
	 *
	 * @return mixed
	 */
	public function getFieldTxWmdbBaseEwhListType($PA, $fObj) {
		$itemsToShow = array();
		$cType = $PA['row']['CType'];

		$items = $PA['fieldConf']['config']['items'];

		foreach ($items as $key => $item) {
			if(stristr($item[1], '--div--') === FALSE && stristr($cType, 'wmdb_base_ewh') !== false ) {
				// reset icon
				unset($item[2]);
				$itemsToShow[] = $item;
			}

			/**
			 * <rupert.germann>, 18.07.2012
			 * wenn man für optgroups nur das keyword '--div--' verwendet, werden die optgroups von extmgm::addPlugin wieder ausgefiltert.
			 * um das zu vermeiden, schreiben wir optgroups in der Form '--div--[zahl]'. Diese werden hier erkannt und wieder in die korrekte
			 * Schreibweise umgewandelt. Die folgende Funktion getSingleField_typeSelect() kann die wieder interpretieren.
			 */

			if(stristr($item[1], '--div--') !== FALSE) {
				$item[1] = '--div--';
				// reset icon
				unset($item[2]);
				$itemsToShow[] = $item;
			}
		}

		// add empty item to the beginning of the list
		if($itemsToShow[0][0] != '') {
			array_unshift($itemsToShow, $PA['fieldConf']['config']['items'][0]);
		}
		$PA['fieldConf']['config']['items'] = $itemsToShow;
		return $fObj->getSingleField_typeSelect('tt_content', 'tx_wmdbbaseewh_list_type', $PA['row'], $PA);
	}
}