<?php
/**
 * Created by PhpStorm.
 * User: florianpeters
 * Date: 07.11.14
 * Time: 10:53
 */

namespace TYPO3\WmdbBaseEwh\CustomContentElements;

use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\WmdbFramework\CustomContentElements\Abstracts\CustomContentElement;
use WMDB\WmdbFramework\DatabaseLayer\DatabaseFactory;

class Courses extends CustomContentElement {

    /**
     * @var \WMDB\WmdbBaseEwh\DatabaseLayer\Tables\tx_wmdbbaseewh_courses
     */
    protected $table;
    /**
     * @var \WMDB\WmdbBaseEwh\DatabaseLayer\Tables\sys_category
     */
    protected $sysCategory;

    /**
     * This method will be called by the plugin and must return the html-code
     * Use the method "$this->getPObj()->renderContent($data);" to interact with fluid
     *
     * @return string
     */
    public function render() {
        $this->pObj->pi_initPIflexForm();
        // Data-array from the content element
        $data = $this->getPObj()->cObj->data;
        $this->table = DatabaseFactory::getTable('tx_wmdbbaseewh_courses', 'WMDB\\WmdbBaseEwh\\DatabaseLayer\\Tables\\');
        $this->sysCategory = DatabaseFactory::getTable('sys_category', 'WMDB\\WmdbBaseEwh\\DatabaseLayer\\Tables\\');
        switch($this->pObj->pi_getFFvalue($data['pi_flexform'], 'what_to_display')) {
            case 0: // Teaser
                $data['teaser'] = $this->getDataForTeaser();
                break;
            case 1: // List
                $data['list'] = $this->getDataForList();
                break;
            case 2: // Meta Information
                $data['meta'] = $this->getDataForMetaInformation();
                break;
            default:
                return $this->getPObj()->renderFlashMessage(
                    'Invalid dislay mode detected!',
                    'The selected display mode "' . htmlspecialchars($this->pObj->pi_getFFvalue($data['pi_flexform'], 'what_to_display')) . '" is not supported!',
                    FlashMessage::ERROR);
        }
        return $this->getPObj()->renderContent($data);
    }

    protected function getDataForList() {

    }

    protected function getDataForMetaInformation() {

    }

    /**
     * @return array|NULL
     */
    protected function getDataForTeaser() {
        $courses = $this->table->findByUidList($this->getPObj()->pi_getFFvalue($this->getPObj()->cObj->data['pi_flexform'], 'course'));
        if(is_array($courses)) {
            foreach($courses as &$course) {
                $course['teaser'] = $this->getPObj()->loadFalData($course, 'teaser', 'tx_wmdbbaseewh_courses');
                $course['categories'] = $this->sysCategory->findByIdList($course['tx_wmdbbasewh_courses_cats']);
            }
        }
        return $courses;
    }

}