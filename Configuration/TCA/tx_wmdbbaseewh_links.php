<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$TCA['tx_wmdbbaseewh_links'] = array(
    'ctrl' => $TCA['tx_wmdbbaseewh_links']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'hidden,label,link'
    ),
    'feInterface' => $TCA['tx_wmdbbaseewh_links']['feInterface'],
    'columns' => array(
        'hidden' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config'  => array(
                'type'    => 'check',
                'default' => '0'
            )
        ),
        'label' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_links.label',
            'config' => array(
                'type' => 'input',
                'size' => '30',
            )
        ),
        'link' => $GLOBALS['TCA']['tt_content']['columns']['header_link'],
    ),
    'types' => array(
        '0' => array('showitem' => 'hidden;;1;;1-1-1, label, link')
    ),
    'palettes' => array(
        '1' => array('showitem' => '')
    )
);