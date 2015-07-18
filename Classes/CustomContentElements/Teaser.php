<?php
/**
 * Created by PhpStorm.
 * User: florianpeters
 * Date: 07.11.14
 * Time: 10:53
 */

namespace TYPO3\WmdbBaseEwh\CustomContentElements;

use TYPO3\WmdbFramework\CustomContentElements\Abstracts\CustomContentElement;
use WMDB\WmdbFramework\DatabaseLayer\DatabaseFactory;

class Teaser extends CustomContentElement {

    /**
     * @var \WMDB\WmdbBaseEwh\DatabaseLayer\Tables\tt_content
     */
    protected $ttContent;

    /**
     * This method will be called by the plugin and must return the html-code
     * Use the method "$this->getPObj()->renderContent($data);" to interact with fluid
     *
     * @return string
     */
    public function render() {
        $this->getPObj()->pi_initPIflexForm();
        // Data-array from the content element
        $data = $this->getPObj()->cObj->data;
        $this->ttContent = DatabaseFactory::getTable('tt_content', 'WMDB\\WmdbBaseEwh\\DatabaseLayer\\Tables\\');
        foreach(explode(',', $data['records']) AS $recordID) {
            $data['items'][] = $this->getOutput(str_replace('tt_content_', '', $recordID));
        }
        $data['mode'] = $this->getPObj()->pi_getFFvalue($data['pi_flexform'], 'what_to_display');
        return $this->getPObj()->renderContent($data);
    }

    /**
     * @param $uid
     *
     * @return array
     */
    protected function getOutput($uid) {
        $rows = $this->ttContent->findByIdentifier('uid', intval($uid));
        $result = array();
        if(is_array($rows) && count($rows) > 0) {
            $row = $rows[0];
            if (stristr($row['CType'], 'wmdb_base_ewh') !== false) {
                $row['content'] = $this->getDefaultOutput('tt_content', $row['uid']);
            }
            $row['image'] = $this->getPObj()->loadFalData($row);
            $result = $row;
        }
        return $result;
    }

    /**
     * @param $table
     * @param $id
     *
     * @return string
     */
    protected function getDefaultOutput($table, $id) {
        $conf = array(
            'tables' => $table,
            'source' => intval($id),
            'dontCheckPid' => 1
        );
        $result = $this->pObj->cObj->cObjGetSingle('RECORDS', $conf);
        return $result;
    }

} 