<?php
/**
 * Created by PhpStorm.
 * User: Florian
 * Date: 23.09.2014
 * Time: 07:55
 */

namespace WMDB\WmdbBaseEwh\DatabaseLayer\Tables;

use TYPO3\CMS\Core\FormProtection\Exception;
use WMDB\WmdbFramework\DatabaseLayer\Abstracts\DatabaseDefault;
use WMDB\WmdbFramework\DatabaseLayer\DatabaseFactory;

class tt_content extends DatabaseDefault {

	/**
     * @return null
     */
    public function setTable() {
        // TODO: Implement setTable() method.
        $this->table = 'tt_content';
    }

    /**
	 * @param $fieldName
	 * @param $value
	 *
	 * @return array
	 */
	public function findByIdentifier($fieldName, $value) {
        if($this->checkFieldName($fieldName)) {
            $rows = $this->getDb()->exec_SELECTgetRows(
                '*',
                $this->table,
                $fieldName . '=' . $this->getDb()->fullQuoteStr($value, $this->table) . DatabaseFactory::enableFields($this->table)
            );
            if ($rows == NULL) {
                $rows = array();
            }
        } else {
            throw new Exception('Invalid fieldname "' . htmlspecialchars($fieldName) . '" detected!');
        }
		return $rows;
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

} 