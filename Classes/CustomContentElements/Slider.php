<?php
/**
 * Created by PhpStorm.
 * User: florianpeters
 * Date: 07.11.14
 * Time: 10:53
 */

namespace TYPO3\WmdbBaseEwh\CustomContentElements;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\WmdbFramework\CustomContentElements\Abstracts\CustomContentElement;
use WMDB\WmdbFramework\DatabaseLayer\DatabaseFactory;

class Slider extends CustomContentElement {

    /**
     * This method will be called by the plugin and must return the html-code
     * Use the method "$this->getPObj()->renderContent($data);" to interact with fluid
     *
     * @return string
     */
    public function render() {
        // Data-array from the content element
        $this->pObj->pi_initPIflexForm();
        $data = $this->getPObj()->cObj->data;
        $data['slides'] = $this->loadSlides($this->pObj->pi_getFFvalue($data['pi_flexform'], 'slides'));
        $data['mode'] = intval($this->pObj->pi_getFFvalue($data['pi_flexform'], 'mode'));
        return $this->getPObj()->renderContent($data);
    }

    /**
     * @param $uidList
     *
     * @return array|NULL
     */
    protected function loadSlides($uidList) {
        /** @var \WMDB\WmdbBaseEwh\DatabaseLayer\Tables\tx_wmdbbaseewh_slide $table */
        $table = DatabaseFactory::getTable('tx_wmdbbaseewh_slide', 'WMDB\\WmdbBaseEwh\\DatabaseLayer\\Tables\\');
        $items = $table->findByUidList($uidList);
        foreach($items AS &$item) {
            $item['image'] = $this->pObj->loadFalData($item, 'image', 'tx_wmdbbaseewh_slide');
            if($item['style'] == 2) {
                $descriptionParts = GeneralUtility::trimExplode(LF, $item['description'], 1);
                $tmp = array();
                $leftCnt = $rightCnt = 190;
                $itemOffset = 800;
                foreach($descriptionParts AS $key => $part) {
                    $tmp[($key%2==0?'left':'right')][] = array(
                        'text' => $part,
                        'offset' => ($key%2==0?$leftCnt:$rightCnt),
                        'timeOffset' => $itemOffset
                    );
                    if($key%2 == 0) {
                        $leftCnt += 55;
                    } else {
                        $rightCnt += 55;
                    }
                    $itemOffset += 150;
                }
                $item['split'] = $tmp;
            }
        }
        return $items;
    }

} 