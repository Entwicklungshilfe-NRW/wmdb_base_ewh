<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_wmdbbaseewh_courses'] = array(
	'ctrl' => $TCA['tx_wmdbbaseewh_courses']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'hidden,starttime,endtime,fe_group,headline,category,description,teaser,detaillink'
	),
	'feInterface' => $TCA['tx_wmdbbaseewh_courses']['feInterface'],
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
				'foreign_table' => 'fe_groups',
				'size' => 5,
				'mintems' => 0,
				'maxitems' => 100
			)
		),
		'headline' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_courses.headline',
			'config' => array(
				'type' => 'input',
				'size' => '30',
			)
		),
		'tx_wmdbbasewh_courses_cats' => array(),
		'description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_courses.description',
			'config' => array(
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
		'teaser' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_courses.teaser',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('teaser')
		),
		'detaillink' => $GLOBALS['TCA']['tt_content']['columns']['header_link'],
		'promote' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_courses.promote',
			'config'  => array(
				'type'    => 'check',
				'default' => '0'
			)
		)
	),
	'types' => array(
		'0' => array('showitem' => 'headline, detaillink, description, --div--;Access, hidden;;1;;1-1-1, --div--;Kategorien, promote, tx_wmdbbasewh_courses_cats, --div--;Media, teaser ')
	),
	'palettes' => array(
		'1' => array('showitem' => 'starttime, endtime, fe_group')
	)
);
