<?php
/**
 * Created by PhpStorm.
 * User: Florian
 * Date: 25.09.2014
 * Time: 21:42
 */

/**
 * Class tx_wmdbbaseewh_eid_dispatcher
 */
class tx_wmdbbaseewh_eid_dispatcher extends \TYPO3\CMS\Frontend\Plugin\AbstractPlugin {

    private $allowedClasses = array();

    /**
     * @var \TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication
     */
    private $frontendUserAuthentication;

    /**
     * @var \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController
     */
    private $typoScriptFrontendController;

    /**
     * Prints the result as json-string
     */
    public function __construct() {
        $result = false;
        $func = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('func');
        if(isset($this->allowedClasses[$func])) {
            $result = $this->dispatchRequest($func);
        }
        print json_encode($result);
    }

    /**
     * @param $func
     *
     * @return mixed|void
     */
    private function dispatchRequest($func) {
        $className = $this->allowedClasses[$func];
        /**
         * @var \WMDB\WmdbBaseEwh\EIDs\Abstracts\EIDDefaults $eidObject
         */
        $eidObject = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance($className, $this->frontendUserAuthentication, $this->typoScriptFrontendController);
        $eidObject->initiateValidCommands();
        return $eidObject->dispatchRequest();
    }
}

\TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('tx_wmdbbaseewh_eid_dispatcher');