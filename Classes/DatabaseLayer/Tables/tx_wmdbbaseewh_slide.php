<?php
/**
 * Created by PhpStorm.
 * User: florianpeters
 * Date: 15.07.15
 * Time: 20:14
 */

namespace WMDB\WmdbBaseEwh\DatabaseLayer\Tables;


use TYPO3\CMS\Core\Utility\GeneralUtility;
use WMDB\WmdbFramework\DatabaseLayer\Abstracts\DatabaseDefault;
use WMDB\WmdbFramework\DatabaseLayer\DatabaseFactory;

class tx_wmdbbaseewh_slide extends DatabaseDefault {
	/**
	 * @return null
	 */
	public function setTable() {
		$this->table = 'tx_wmdbbaseewh_slide';
	}

	/**
	 * @param $fieldName
	 * @param $value
	 *
	 * @return array
	 */
	public function findByIdentifier($fieldName, $value) {
	}

	/**
	 * @param $fieldName
	 * @param $value
	 *
	 * @return boolean
	 */
	public function deleteByIdentifier($fieldName, $value)
	{
		// TODO: Implement deleteByIdentifier() method.
	}

	/**
	 * @param $uidList
	 *
	 * @return array|NULL
	 */
	public function findByUidList($uidList) {
		$list = implode(',', GeneralUtility::intExplode(',', $uidList, 1));
		if($list != '') {
			return $this->getDb()->exec_SELECTgetRows(
				'*',
				$this->getTable(),
				'uid IN (' . $list . ')' . DatabaseFactory::enableFields($this->getTable()),
				'',
				'FIELD(uid, ' . $list . ')');
		} else {
			throw new \Exception('Given uid list does not contain uids! Table: ' . $this->getTable());
		}
	}

}