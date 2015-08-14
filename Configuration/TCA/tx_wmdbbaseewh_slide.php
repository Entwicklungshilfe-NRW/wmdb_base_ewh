<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_wmdbbaseewh_slide'] = array(
	'ctrl' => $TCA['tx_wmdbbaseewh_slide']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'hidden,starttime,endtime,fe_group,headline,description,image,style'
	),
	'feInterface' => $TCA['tx_wmdbbaseewh_slide']['feInterface'],
	'columns' => array(
		'hidden' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array(
				'type'    => 'check',
				'default' => '0'
			)
		),
		'starttime' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config'  => array(
				'type'     => 'input',
				'size'     => '8',
				'max'      => '20',
				'eval'     => 'date',
				'default'  => '0',
				'checkbox' => '0'
			)
		),
		'endtime' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config'  => array(
				'type'     => 'input',
				'size'     => '8',
				'max'      => '20',
				'eval'     => 'date',
				'checkbox' => '0',
				'default'  => '0',
				'range'    => array(
					'upper' => mktime(3, 14, 7, 1, 19, 2038),
					'lower' => mktime(0, 0, 0, date('m')-1, date('d'), date('Y'))
				)
			)
		),
		'fe_group' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
			'config'  => array(
				'type'  => 'select',
				'items' => array(
					array('', 0),
					array('LLL:EXT:lang/locallang_general.xml:LGL.hide_at_login', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.any_login', -2),
					array('LLL:EXT:lang/locallang_general.xml:LGL.usergroups', '--div--')
				),
				'foreign_table' => 'fe_groups'
			)
		),
		'headline' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_slide.headline',
			'config' => array(
				'type' => 'input',
				'size' => '30',
			)
		),
		'author' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_slide.author',
			'config' => array(
				'type' => 'input',
				'size' => '30',
			)
		),
		'description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_slide.description',
			'config' => array(
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
		'image' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_slide.image',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('image')
		),
		'style' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_slide.style',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_slide.style.I.0', '0'),
					array('LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_slide.style.I.1', '1'),
					array('LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_slide.style.I.2', '2'),
				),
				'size' => 1,
				'maxitems' => 1,
			)
		),
		'link' => $GLOBALS['TCA']['tt_content']['columns']['header_link']
	),
	'types' => array(
		'0' => array('showitem' => 'hidden;;1;;1-1-1, headline, link, description, author, --div--;Media, image, --div--;Extended, style')
	),
	'palettes' => array(
		'1' => array('showitem' => 'starttime, endtime, fe_group')
	)
);