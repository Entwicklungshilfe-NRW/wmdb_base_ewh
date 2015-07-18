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

class LinkList extends CustomContentElement {

    /**
     * This method will be called by the plugin and must return the html-code
     * Use the method "$this->getPObj()->renderContent($data);" to interact with fluid
     *
     * @return string
     */
    public function render() {
        // Data-array from the content element
        $this->getPObj()->pi_initPIflexForm();
        $data = $this->getPObj()->cObj->data;
        $data['links'] = $this->getLinks($this->getPObj()->pi_getFFvalue($data['pi_flexform'], 'links'));
        return $this->getPObj()->renderContent($data);
    }

    /**
     * @param $uidList
     *
     * @return array|NULL
     * @throws \Exception
     */
    protected function getLinks($uidList) {
        /** @var \WMDB\WmdbBaseEwh\DatabaseLayer\Tables\tx_wmdbbaseewh_links $table */
        $table = DatabaseFactory::getTable('tx_wmdbbaseewh_links', 'WMDB\\WmdbBaseEwh\\DatabaseLayer\\Tables\\');
        return $table->findByUidList($uidList);
    }

} 