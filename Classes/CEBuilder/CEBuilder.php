<?php
/**
 * Created by PhpStorm.
 * User: florianpeters
 * Date: 07.11.14
 * Time: 10:50
 */

namespace WMDB\WmdbBaseEwh\CEBuilder;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Exception;

class CEBuilder {

	/**
	 * @var string
	 */
	private $extKey = 'wmdb_base_ewh';

	/**
	 * @var string
	 */
	private $configurationDirectory;

	/**
	 * @var array
	 */
	private $configurationFiles = array();

	/**
	 * @var array
	 */
	private $storageFileContent = array();

	/**
	 * @var array
	 */
	private $possibleOptions = array();

	/**
	 * @var string
	 */
	private $rteSuffix = ';;;richtext:rte_transform[flag=rte_enabled|mode=ts_css]';

	/**
	 * @var string
	 */
	private $CEDefinitionFile;

	/**
	 * @var
	 */
	private $CEDefinitionFileContent;

	/**
	 * @var string
	 */
	private $yamlStoreFile;

	/**
	 * @var string
	 */
	private $currentObjectName;

	/**
	 * @var string
	 */
	private $availableOptions;

	/**
	 * @var array
	 */
	private $allowedFiles = array();

	/**
	 * @param $possibleOptions
	 */
	function __construct($possibleOptions) {
		$this->availableOptions = $possibleOptions;
		$this->CEDefinitionFile = 'EXT:' . $this->extKey . '/Configuration/CEDefinition.php';
		$this->configurationDirectory = 'EXT:' . $this->extKey . '/Configuration/CustomContentElements/';
		$this->yamlStoreFile = GeneralUtility::getFileAbsFileName('EXT:' . $this->extKey . '/Classes/CEBuilder/HashMap.yaml');
		$this->readStorageFile();
	}
	/**
	 * @return array
	 */
	public function getStorageFileContent() {
		return $this->storageFileContent;
	}

	/**
	 * @param array $storageFileContent
	 */
	public function setStorageFileContent($storageFileContent) {
		$this->storageFileContent = $storageFileContent;
	}

	public function addAllowedFile($fileName) {
		$this->allowedFiles[$fileName] = true;
	}

	/**
	 * Start to create or Update Custom Content Elements
	 */
	public function start() {
		$this->readConfigurationFiles();
		$this->preparePossibleOptions($this->availableOptions);
		foreach($this->configurationFiles AS $config) {
			$this->createNewElements($config);
		}
		$this->createStoreFile();
		$this->createCEDefinitionFile();
	}

	/**
	 * @param $options
	 */
	private function preparePossibleOptions($options) {
		$tmp = GeneralUtility::trimExplode(',', $options, 1);
		foreach($tmp AS $field) {
			$this->possibleOptions[str_replace($this->rteSuffix, '', $field)] = $field;
		}
	}

	/**
	 *
	 */
	private function readConfigurationFiles() {
		$dir = GeneralUtility::getFileAbsFileName($this->configurationDirectory);
		if($handle = opendir($dir)) {
			while (false !== ($file = readdir($handle))) {
				if($file != '.' && $file != '..' && isset($this->allowedFiles[$file])) {
					$hash = md5(file_get_contents(GeneralUtility::getFileAbsFileName($this->configurationDirectory . $file)));
					$tmp = explode('.', $file);
					$objectName = ucfirst($tmp[0]);
					if((isset($this->storageFileContent[$objectName]) && $this->storageFileContent[$objectName] !== $hash) || !isset($this->storageFileContent[$objectName])) {
						$fileContent = parse_ini_file($dir . $file);
						$fileContent['fields'] = GeneralUtility::trimexplode(',', $fileContent['fields']);
						$this->configurationFiles[$tmp[0]] = $fileContent;
						$this->configurationFiles[$tmp[0]]['objectName'] = $objectName;
					}
					$this->storageFileContent[$objectName] = $hash;
				}
			}
		}
	}

	/**
	 * @param $configuration
	 */
	private function createNewElements($configuration) {
		$CEDefinitionBlock = array();
		$fieldExcludeArray = $this->possibleOptions;
		$this->currentObjectName = $configuration['objectName'];
		if(isset($configuration['fields']) && is_array($configuration['fields'])) {
			foreach($configuration['fields'] AS $field) {
				if(isset($fieldExcludeArray[$field])) {
					unset($fieldExcludeArray[$field]);
				}
			}
		}
		$this->createTemplateFile();
		$CEDefinitionBlock[] = "\\TYPO3\\CMS\\Core\\Utility\\ExtensionManagementUtility::addPlugin(array('" . $configuration['label'] . "', '" . $this->currentObjectName . "'), 'tx_wmdbbaseewh_list_type','" . $this->extKey . "');";
		$CEDefinitionBlock[] = '$GLOBALS["TCA"]["tt_content"]["types"]["' . $this->extKey . '_cached"]["subtypes_excludelist"]["' . $this->currentObjectName . '"] = "' . implode(',', $fieldExcludeArray) . '";';
		if(isset($configuration['ImplementsCustomRenderingEngine']) && $configuration['ImplementsCustomRenderingEngine'] == 1) {
			$this->createRenderingImplentationClass();
			$CEDefinitionBlock[] = '$GLOBALS["TYPO3_CONF_VARS"]["EXT"]["' . $this->extKey . '"]["specialsMapping"]["' . $this->currentObjectName . '"] = array("class" => \'TYPO3\\WmdbBaseEwh\\CustomContentElements\\' . $this->currentObjectName . '\');';
		}
		if(!isset($fieldExcludeArray['pi_flexform'])) {
			$this->createFlexformFile();
			$CEDefinitionBlock[] = '$GLOBALS["TCA"]["tt_content"]["columns"]["pi_flexform"]["config"]["ds"]["' . $this->currentObjectName . ',' . $this->extKey . '_pi1"] = "FILE:EXT:' . $this->extKey . '/Resources/Private/Flexforms/' . $this->currentObjectName . '.xml";';
		}
		$this->addCEDefinitionBlock($CEDefinitionBlock);
	}

	/**
	 * @param array $block
	 */
	private function addCEDefinitionBlock(array $block) {
		$this->loadCEDefinitionFile();
		$flippedArray = array_flip($this->CEDefinitionFileContent);
		if(isset($flippedArray[$block[0]])) {
			$this->replaceInCEDefinitionFile($block);
		} else {
			$this->appendBlockToCEDefinitionFile($block);
		}
	}

	private function createCEDefinitionFile() {
		if(strpos($this->CEDefinitionFileContent[0], '<?php') !== false) {
			$content = implode(LF, $this->CEDefinitionFileContent);
		} else {
			if($this->CEDefinitionFileContent == NULL) {
				$this->CEDefinitionFileContent = array();
			}
			$content = '<?php' . LF . implode(LF, $this->CEDefinitionFileContent);
		}
		if($content != ("<?php" . LF)) {
			file_put_contents(GeneralUtility::getFileAbsFileName($this->CEDefinitionFile), $content);
		}
	}

	/**
	 * @param $block
	 */
	private function appendBlockToCEDefinitionFile($block) {
		$this->CEDefinitionFileContent[] = '';
		$this->CEDefinitionFileContent[] = '';
		foreach($block AS $line) {
			$this->CEDefinitionFileContent[] = $line;
		}
	}

	/**
	 * @param $block
	 */
	private function replaceInCEDefinitionFile($block) {
		$start = false;
		$cnt = 0;
		$blockCnt = 1;

		foreach($this->CEDefinitionFileContent AS $line) {
			if($line == $block[0]) {
				$start = true;
			}
			if($start && $line != $block[0]) {
				if(strpos($line, $this->currentObjectName) === false) {
					$length = 0;
				} else {
					$length = 1;
				}
				array_splice($this->CEDefinitionFileContent, $cnt, $length, $block[$blockCnt]);
				$blockCnt++;
			}
			$cnt++;
		}
	}

	private function loadCEDefinitionFile() {
		if($this->CEDefinitionFileContent == null) {
			$fileContent = '';
			if(file_exists($this->CEDefinitionFile)) {
				$fileContent = file_get_contents(GeneralUtility::getFileAbsFileName($this->CEDefinitionFile));
			}
			$this->CEDefinitionFileContent = explode(LF, $fileContent);
		}
	}

	private function createStoreFile() {
		$content = '';
		foreach($this->storageFileContent AS $objectName => $hash) {
			$content .= $objectName . ':' . $hash . LF;
		}
		file_put_contents($this->yamlStoreFile, $content);
	}

	/**
	 * @param $content
	 *
	 * @return mixed
	 */
	private function prepareContent($content) {
		return str_replace(array('###', 'DefaultCustomContentElement'), $this->currentObjectName, $content);
	}

	/**
	 * @throws \TYPO3\CMS\Fluid\Exception
	 */
	private function createTemplateFile() {
		$this->moveDefaultFile('DefaultTemplate.html', 'Resources/Private/Templates/Content/');
	}

	/**
	 * @param $source
	 * @param $destination
	 *
	 * @throws \TYPO3\CMS\Fluid\Exception
	 */
	private function moveDefaultFile($source, $destination) {
		$sourceFile = GeneralUtility::getFileAbsFileName('EXT:' . $this->extKey . '/Classes/CEBuilder/' . $source);
		if(file_exists($sourceFile)) {
			$content = file_get_contents($sourceFile);
			$targetDir = GeneralUtility::getFileAbsFileName('EXT:' . $this->extKey . '/' . $destination);

			if(!is_dir($targetDir)) {
				GeneralUtility::mkdir_deep($targetDir);
			}
			if(is_dir($targetDir)) {
				$sourceFileInfo = pathinfo($source);
				$destinationFileName = $targetDir . $this->currentObjectName . '.' . $sourceFileInfo['extension'];
				if(!file_exists($destinationFileName)) {
					file_put_contents($destinationFileName, $this->prepareContent($content));
				}
			} else {
				throw new Exception('Could not create Directory: "' . $targetDir . '"! Please check permissions!');
			}
		} else {
			throw new Exception('Source-File "' . htmlspecialchars($sourceFile) . '" does not exist!');
		}
	}

	private function readStorageFile() {
		$fileContent = file_get_contents($this->yamlStoreFile);
		$tmpArray = explode(LF, $fileContent);
		foreach($tmpArray AS $line) {
			$tmp = explode(':', $line);
			if($tmp[0] != '' && $tmp[1] != '') {
				$this->storageFileContent[$tmp[0]] = $tmp[1];
			}
		}
	}

	private function createRenderingImplentationClass() {
		$this->moveDefaultFile('DefaultCustomContentElement.php', 'Classes/CustomContentElements/');
	}

	private function createFlexformFile() {
		$this->moveDefaultFile('DefaultFlexform.xml', 'Resources/Private/Flexforms/');
	}

	public function cleanUp() {

	}
}