<?php
/**
 * Created by PhpStorm.
 * User: Florian
 * Date: 25.09.2014
 * Time: 21:17
 */

class tx_wmdbbaseewh_uncached extends \WMDB\WmdbFramework\Dispatcher\Abstracts\PluginDispatcher {

    /**
     * Same as class name
     *
     * @var string
     */
    public $prefixId = 'tx_wmdbbaseewh_pi1';

    /**
     * Path to this script relative to the extension dir.
     *
     * @var string
     */
    public $scriptRelPath = 'Classes/Dispatcher/Abstracts/PluginDispatcher.php';

    /**
     * The extension key.
     *
     * @var string
     */
    public $extKey  = 'wmdb_base_ewh';

    /**
	 * Main method of your PlugIn
	 *
	 * @param    string $content : The content of the PlugIn
	 * @param    array  $conf    : The PlugIn Configuration
	 *
	 * @return    string        The content that should be displayed on the website
	 */
	public function main($content, $conf) {
		// TODO: Implement main() method.
        $this->conf = $conf;
		$this->pi_USER_INT_obj = 1;
		$this->cObj->data['user_int'] = 1;
        $this->setResourceAndFilePath();

		$this->initFalData();
		$listType = trim($this->cObj->data['tx_wmdbbaseewh_list_type']);
		$cType = trim($this->cObj->data['CType']);
		if(strpos($cType, 'wmdb_base_ewh') !== false) {
			$confVars = $GLOBALS['TYPO3_CONF_VARS']['EXT'][$this->extKey];
			$className = $confVars['specialsMapping'][$listType]['class'];
		} else {
			$className = '';
		}
		if( $className != '') {
			$content = $this->renderSingleSpecialElement($listType);
		} else {
			$content = $this->renderSingleContentElement();
		}

		return $content;
	}

} 