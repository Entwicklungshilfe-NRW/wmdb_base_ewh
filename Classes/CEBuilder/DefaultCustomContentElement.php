<?php
/**
 * Created by PhpStorm.
 * User: florianpeters
 * Date: 07.11.14
 * Time: 10:53
 */

namespace TYPO3\WmdbBaseEwh\CustomContentElements;

use TYPO3\WmdbFramework\CustomContentElements\Abstracts\CustomContentElement;

class DefaultCustomContentElement extends CustomContentElement {

    /**
     * This method will be called by the plugin and must return the html-code
     * Use the method "$this->getPObj()->renderContent($data);" to interact with fluid
     *
     * @return string
     */
    public function render() {
        // Data-array from the content element
        $data = $this->getPObj()->cObj->data;

        return $this->getPObj()->renderContent($data);
    }

} 