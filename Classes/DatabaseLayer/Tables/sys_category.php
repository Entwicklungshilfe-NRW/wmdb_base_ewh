<?php
/**
 * Created by PhpStorm.
 * User: florianpeters
 * Date: 18.07.15
 * Time: 10:03
 */

namespace WMDB\WmdbBaseEwh\DatabaseLayer\Tables;


use TYPO3\CMS\Core\Utility\GeneralUtility;
use WMDB\WmdbFramework\DatabaseLayer\Abstracts\DatabaseDefault;
use WMDB\WmdbFramework\DatabaseLayer\DatabaseFactory;

class sys_category extends DatabaseDefault {

	/**
	 * @return null
	 */
	public function setTable() {
		$this->table = 'sys_category';
	}

	/**
	 * @param $fieldName
	 * @param $value
	 *
	 * @return array
	 */
	public function findByIdentifier($fieldName, $value) {
		// TODO: Implement findByIdentifier() method.
	}

	/**
	 * @param $fieldName
	 * @param $value
	 *
	 * @return boolean
	 */
	public function deleteByIdentifier($fieldName, $value) {
		// TODO: Implement deleteByIdentifier() method.
	}

	/**
	 * @param $list
	 *
	 * @return array|NULL
	 */
	public function findByIdList($list) {
		if(!is_array($list)) {
			$list = GeneralUtility::intExplode(',', $list, 1);
		}
		$uidList = implode(',', $list);
		if($uidList != '') {
			$result = $this->getDb()->exec_SELECTgetRows('*', $this->getTable(), 'uid IN (' . $uidList . ')' . DatabaseFactory::enableFields($this->getTable()));
		} else {
			$result = array();
		}
		return $result;
	}

}