<?php
/**
 * Created by PhpStorm.
 * User: florianpeters
 * Date: 07.11.14
 * Time: 10:53
 */

namespace TYPO3\WmdbBaseEwh\CustomContentElements;

use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
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
     * @var \WMDB\WmdbBaseEwh\DatabaseLayer\Tables\tx_wmdbbaseewh_speaker
     */
    protected $speaker;

    /**
     * @var \WMDB\WmdbBaseEwh\DatabaseLayer\Tables\tx_wmdbbaseewh_speaker_milestones
     */
    protected $speakerMileStones;

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
        $this->speaker = DatabaseFactory::getTable('tx_wmdbbaseewh_speaker', 'WMDB\\WmdbBaseEwh\\DatabaseLayer\\Tables\\');
        $this->speakerMileStones = DatabaseFactory::getTable('tx_wmdbbaseewh_speaker_milestones', 'WMDB\\WmdbBaseEwh\\DatabaseLayer\\Tables\\');
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

    /**
     * @return array|NULL
     */
    protected function getDataForMetaInformation() {
        $types = explode(',', $this->getPObj()->pi_getFFvalue($this->pObj->cObj->data['pi_flexform'], 'meta_options'));
        $metaTypes = array();
        foreach($types AS $type) {
            $metaTypes[$type] = true;
        }
        return array(
            'courses' => $this->getCourses(),
            'types' => $metaTypes
        );
    }

    /**
     * @return array|NULL
     */
    protected function getDataForTeaser() {
        return $this->getCourses();
    }

    /**
     * @return array|NULL
     */
    protected function getCourses() {
        $courses = $this->table->findByUidList($this->getPObj()->pi_getFFvalue($this->getPObj()->cObj->data['pi_flexform'], 'course'));
        if (is_array($courses)) {
            foreach ($courses as &$course) {
                $course['teaser'] = $this->getPObj()->loadFalData($course, 'teaser', 'tx_wmdbbaseewh_courses');
                $course['downloads'] = $this->getDownloads($course);
                $categories = $this->sysCategory->findCategoriesForElement($course['uid'], 'tx_wmdbbaseewh_courses', 'tx_wmdbbasewh_courses_cats');
                $tmpArray = array();
                foreach ($categories as $category) {
                    $tmpArray[] = $category['title'];
                }
                $course['categories'] = implode(', ', $tmpArray);
                if($course['speaker'] != '') {
                    $speakerArray = $this->speaker->findByUidList($course['speaker']);
                    if (is_array($speakerArray)) {
                        foreach ($speakerArray AS &$speaker) {
                            $speaker['milestones'] = $this->speakerMileStones->findByUidList($speaker['milestones']);
                            $speaker['image'] = $this->getPObj()->loadFalData($speaker, 'image', 'tx_wmdbbaseewh_speaker');
                        }
                    }
                    $course['speaker'] = $speakerArray;
                }
            }
        }
        return $courses;
    }

    /**
     * @param $record
     *
     * @return array
     */
    protected function getDownloads($record) {
        $files = $this->getPObj()->loadFalData($record, 'downloads', 'tx_wmdbbaseewh_courses');
        if(count($files) > 0) {
            foreach($files AS &$file) {
                if($file['reference']['title'] == null) {
                    if($file['original']['title'] == null) {
                        $file['reference']['title'] = array_pop(GeneralUtility::trimExplode('/', $file['original']['identifier'], 1));
                    }
                }
            }
        }
        return $files;
    }

}