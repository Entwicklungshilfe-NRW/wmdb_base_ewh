<?php
/**
 * Created by PhpStorm.
 * User: florianpeters
 * Date: 07.11.14
 * Time: 10:53
 */

namespace TYPO3\WmdbBaseEwh\CustomContentElements;

use TYPO3\WmdbFramework\CustomContentElements\Abstracts\CustomContentElement;
use WMDB\WmdbBaseEwh\DatabaseLayer\Tables\sys_category;
use WMDB\WmdbBaseEwh\DatabaseLayer\Tables\tx_wmdbbaseewh_courses;
use WMDB\WmdbBaseEwh\DatabaseLayer\Tables\tx_wmdbbaseewh_speaker_milestones;
use WMDB\WmdbFramework\DatabaseLayer\DatabaseFactory;

class Profile extends CustomContentElement {

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
        $data['pluginType'] = $this->getPObj()->pi_getFFvalue($data['pi_flexform'], 'type');
        if($data['pluginType'] == 0) {
            $data['speaker'] = $this->getSpeaker();
        } else {
            $data['speaker'] = $this->getSpeakerProfile();
        }
        return $this->getPObj()->renderContent($data);
    }

    /**
     * @return array
     * @throws \Exception
     */
    protected function getSpeakerProfile() {
        $speaker = array();
        if(isset($this->pObj->piVars['speaker'])) {
            $uid = (int)$this->pObj->piVars['speaker'];

            /** @var \WMDB\WmdbBaseEwh\DatabaseLayer\Tables\tx_wmdbbaseewh_speaker $table */
            $table = DatabaseFactory::getTable('tx_wmdbbaseewh_speaker', 'WMDB\\WmdbBaseEwh\\DatabaseLayer\\Tables\\');

            /** @var tx_wmdbbaseewh_speaker_milestones $milestones */
            $milestones = DatabaseFactory::getTable('tx_wmdbbaseewh_speaker_milestones', 'WMDB\\WmdbBaseEwh\\DatabaseLayer\\Tables\\');

            /** @var tx_wmdbbaseewh_courses $courses */
            $courses = DatabaseFactory::getTable('tx_wmdbbaseewh_courses', 'WMDB\\WmdbBaseEwh\\DatabaseLayer\\Tables\\');
            /** @var sys_category $sysCategory */
            $sysCategory = DatabaseFactory::getTable('sys_category', 'WMDB\\WmdbBaseEwh\\DatabaseLayer\\Tables\\');

            $speakerData = $table->findByUidList($uid);
            if(is_array($speakerData) && count($speakerData) > 0) {
                $speaker = $speakerData[0];
                $speaker['image'] = $this->pObj->loadFalData($speaker, 'image', 'tx_wmdbbaseewh_speaker');
                $milestoneArray = $milestones->findByUidList($speaker['milestones']);
                $speaker['milestones'] = array();
                foreach($milestoneArray AS $key => $milestone) {
                    if($key % 2 == 0) {
                        $speaker['milestones']['leftCol'][] = $milestone;
                    } else {
                        $speaker['milestones']['rightCol'][] = $milestone;
                    }
                }
                $courses = $courses->findCoursesOfSpeaker($speaker['uid']);
                foreach($courses as &$course) {
                    $course['categories'] = $sysCategory->findCategoriesForElement($course['uid'], 'tx_wmdbbaseewh_courses', 'tx_wmdbbasewh_courses_cats');
                }
                $speaker['courses'] = $courses;
            }
        }
        return $speaker;
    }

    /**
     * @return array|NULL
     */
    protected function getSpeaker() {
        /** @var \WMDB\WmdbBaseEwh\DatabaseLayer\Tables\tx_wmdbbaseewh_speaker $table */
        $table = DatabaseFactory::getTable('tx_wmdbbaseewh_speaker', 'WMDB\\WmdbBaseEwh\\DatabaseLayer\\Tables\\');
        $speakerArray = $table->findAll();
        foreach($speakerArray AS &$speaker) {
            $speaker['image'] = $this->pObj->loadFalData($speaker, 'image', 'tx_wmdbbaseewh_speaker');
        }
        return $speakerArray;
    }

} 