<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014  <florian.peters@wmdb.de>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * @var TYPO3\CMS\Lang\LanguageService $languageService
 */
$languageService = $GLOBALS['LANG'];
$languageService->includeLLFile('EXT:wmdb_base_ewh/mod1/locallang.xml');

if(isset($MCONF)) {
    /**
     * @var TYPO3\CMS\Core\Authentication\BackendUserAuthentication $beUser
     */
    $beUser = $GLOBALS['BE_USER'];
    $beUser->modAccess($MCONF, 1);    // This checks permissions and exits if the users has no permission for entry.
}

/**
 * Module 'Base Builder' for the 'wmdb_base_ewh' extension.
 *
 * @author     <florian.peters@wmdb.de>
 * @package    TYPO3
 * @subpackage    tx_wmdbbaseewh
 */
class tx_wmdbbaseewh_module1 extends \TYPO3\CMS\Backend\Module\BaseScriptClass {

    protected $extKey = 'wmdb_base_ewh';

    protected $pageinfo;

    /**
     * Language Service property. Used to access localized labels
     *
     * @var TYPO3\CMS\Lang\LanguageService
     */
    protected $languageService;

    /**
     * @var \TYPO3\CMS\Fluid\View\StandaloneView
     */
    protected $view;

    /**
     * @param TYPO3\CMS\Lang\LanguageService $languageService Language Service to inject
     */
    public function __construct(\TYPO3\CMS\Lang\LanguageService $languageService = NULL) {
        $this->languageService = $languageService ?: $GLOBALS['LANG'];
        $this->initViewObject();
    }

    public function initViewObject() {
        $this->view = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
    }

    /**
     * Initializes the module.
     *
     * @return void
     */
    public function init() {
        parent::init();

        /*
        if (t3lib_div::_GP('clear_all_cache'))    {
            $this->include_once[] = PATH_t3lib . 'class.t3lib_tcemain.php';
        }
        */
    }

    /**
     * Adds items to the ->MOD_MENU array. Used for the function menu selector.
     *
     * @return    void
     */
    public function menuConfig() {
        $this->MOD_MENU = array(
            'function' => array(
                '1' => $this->languageService->getLL('function1'),
                '2' => $this->languageService->getLL('function2'),
                '3' => $this->languageService->getLL('function3'),
            )
        );
        parent::menuConfig();
    }

    /**
     * renderContent renders sie given Fluidtemplate an adds the given data to the view helper.
     * Your templates have to be in "Resources/Private/Html/Content/"
     *
     * @param array  $data Daten für das Fluid-Template
     * @param string $templateFile
     *
     * @return string Content
     */
    public function renderContent($data, $templateFile) {
        if (file_exists($templateFile)) {
            $this->view->getRequest()->setControllerExtensionName($this->extKey);
            $this->view->setTemplatePathAndFilename($templateFile);
            $this->view->assign('data', $data);
            $content = $this->view->render();
        } else {
            $content = 'Could not load template!';
        }
        return $content;
    }

    /**
     * Main function of the module. Write the content to $this->content
     * If you chose "web" as main module, you will need to consider the $this->id parameter which will contain the uid-number of the page clicked in the page tree
     *
     * @return void
     */
    public function main() {
        // Access check!
        // The page will show only if there is a valid page and if this page may be viewed by the user
        $this->pageinfo = \TYPO3\CMS\Backend\Utility\BackendUtility::readPageAccess($this->id, $this->perms_clause);
        $access = is_array($this->pageinfo) ? 1 : 0;

        if (($this->id && $access) || ($GLOBALS['BE_USER']->user['admin'] && !$this->id)) {

            // Draw the header.
            $this->doc = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Backend\\Template\\DocumentTemplate');
            $this->doc->backPath = $GLOBALS['BACK_PATH'];
            $this->doc->form = '<form action="" method="post" enctype="multipart/form-data">';

            // JavaScript
            $this->doc->JScode = '
                <script language="javascript" type="text/javascript">
                    script_ended = 0;
                    function jumpToUrl(URL)    {
                        document.location = URL;
                    }
                </script>
            ';
            $this->doc->postCode = '
                <script language="javascript" type="text/javascript">
                    script_ended = 1;
                    if (top.fsMod) top.fsMod.recentIds["web"] = 0;
                </script>
            ';

            $headerSection = $this->doc->getHeader('pages', $this->pageinfo, $this->pageinfo['_thePath']) . '<br />'
                . $this->languageService->sL('LLL:EXT:lang/locallang_core.xml:labels.path') . ': ' . \TYPO3\CMS\Core\Utility\GeneralUtility::fixed_lgd_cs($this->pageinfo['_thePath'], -50);

            $this->content .= $this->doc->startPage($this->languageService->getLL('title'));
            $this->content .= $this->doc->header($this->languageService->getLL('title'));
            $this->content .= $this->doc->spacer(5);
            $this->content .= $this->doc->section('',$this->doc->funcMenu($headerSection, \TYPO3\CMS\Backend\Utility\BackendUtility::getFuncMenu($this->id, 'SET[function]', $this->MOD_SETTINGS['function'], $this->MOD_MENU['function'])));
            $this->content .= $this->doc->divider(5);

            // Render content:
            $this->moduleContent();

            // Shortcut
            /**
             * @var TYPO3\CMS\Core\Authentication\BackendUserAuthentication $beUser
             */
            $beUser = $GLOBALS['BE_USER'];
            if ($beUser->mayMakeShortcut()) {
                $this->content .= $this->doc->spacer(20) . $this->doc->section('', $this->doc->makeShortcutIcon('id', implode(',', array_keys($this->MOD_MENU)), $this->MCONF['name']));
            }

            $this->content .= $this->doc->spacer(10);
        } else {
            // If no access or if ID == zero

            $this->doc = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Backend\\Template\\DocumentTemplate');
            $this->doc->backPath = $GLOBALS['BACK_PATH'];

            $this->content .= $this->doc->startPage($this->languageService->getLL('title'));
            $this->content .= $this->doc->header($this->languageService->getLL('title'));
            $this->content .= $this->doc->spacer(5);
            $this->content .= $this->doc->spacer(10);
        }

    }

    /**
     * Prints out the module HTML.
     *
     * @return void
     */
    public function printContent() {
        $this->content .= $this->doc->endPage();
        echo $this->content;
    }

    /**
     * Generates the module content.
     *
     * @return void
     */
    protected function moduleContent() {
        switch ((string)$this->MOD_SETTINGS['function']) {
            case 1:
				$availableTypes = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('availableTypes');
				$CEBuilder = new \WMDB\WmdbBaseEwh\CEBuilder\CEBuilder($availableTypes);
				if($availableTypes != '') {
					$files = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('file');
					if(is_array($files)) {
						foreach($files AS $file) {
							$CEBuilder->addAllowedFile($file);
						}
					}
					$CEBuilder->start();
				}
				$data = array();
				$data['configFiles'] = $this->readConfigurationFiles($CEBuilder);
				$content = $this->renderContent($data, \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:wmdb_base_ewh/mod1/Templates/CustomContentElements/Form.html'));
				$this->content .= $this->doc->section('Custom content elements:', $content, 0, 1);
				break;
            case 2:
                $content = '<div align=center><strong>Menu item #2...</strong></div>';
                $this->content .= $this->doc->section('Message #2:', $content, 0, 1);
                break;
            case 3:
                $content = '<div align=center><strong>Menu item #3...</strong></div>';
                $this->content .= $this->doc->section('Message #3:', $content, 0, 1);
                break;
        }
    }

	/**
	 * @param \WMDB\WmdbBaseEwh\CEBuilder\CEBuilder $CEBuilder
	 *
	 * @return array
	 */
    private function readConfigurationFiles($CEBuilder) {
        $dir = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:wmdb_base_ewh/Configuration/CustomContentElements/');
		$keys = array_keys($CEBuilder->getStorageFileContent());
		$stored = array();
		foreach($keys AS $key) {
			$stored[$key . '.ini'] = true;
		}
		$result = array();
		if($handle = opendir($dir)) {
			while (false !== ($file = readdir($handle))) {
				if($file != '.' && $file != '..') {
					$tmp = array();
					$tmp['filename'] = $file;
					$tmp['checked'] = isset($stored[$file]) ? 'checked="checked"' : '';
					$result[] = $tmp;
				}
			}
		}
		return $result;
    }

}




// Make instance:
/** @var $SOBE tx_wmdbbaseewh_module1 */
$SOBE = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('tx_wmdbbaseewh_module1');
$SOBE->init();


$SOBE->main();
$SOBE->printContent();
