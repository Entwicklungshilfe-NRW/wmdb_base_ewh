<?php
/**
 * Created by PhpStorm.
 * User: florianpeters
 * Date: 07.11.14
 * Time: 10:53
 */

namespace TYPO3\WmdbBaseEwh\CustomContentElements;

use TYPO3\WmdbFramework\CustomContentElements\Abstracts\CustomContentElement;

class TextElement extends CustomContentElement {

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
        $data['contentLeft'] = $this->getPObj()->pi_getFFvalue($data['pi_flexform'], 'content');
        $data['contentRight'] = $this->getPObj()->pi_getFFvalue($data['pi_flexform'], 'content2');
        return $this->getPObj()->renderContent($data);
    }

} 