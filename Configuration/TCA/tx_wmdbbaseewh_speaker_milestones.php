<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$TCA['tx_wmdbbaseewh_speaker_milestones'] = array(
    'ctrl' => $TCA['tx_wmdbbaseewh_speaker_milestones']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'hidden,title,description,achieved'
    ),
    'feInterface' => $TCA['tx_wmdbbaseewh_speaker_milestones']['feInterface'],
    'columns' => array(
        'hidden' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config'  => array(
                'type'    => 'check',
                'default' => '0'
            )
        ),
        'title' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_speaker_milestones.title',
            'config' => array(
                'type' => 'input',
                'size' => '30',
            )
        ),
        'description' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_speaker_milestones.description',
            'config' => array(
                'type' => 'input',
                'size' => '30',
            )
        ),
        'achieved' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_speaker_milestones.achieved',
            'config' => array(
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'checkbox' => '0',
                'default'  => '0'
            )
        ),
    ),
    'types' => array(
        '0' => array('showitem' => 'hidden;;1;;1-1-1, title;;;;2-2-2, description;;;richtext[]:rte_transform[mode=ts];3-3-3, achieved')
    ),
    'palettes' => array(
        '1' => array('showitem' => '')
    )
);