<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$TCA['tx_wmdbbaseewh_speaker'] = array(
    'ctrl' => $TCA['tx_wmdbbaseewh_speaker']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'hidden,starttime,endtime,lastname,firstname,jobtitle,short_description,description,mail,twitter,facebook,googleplus,linkedin,xing,milestones'
    ),
    'feInterface' => $TCA['tx_wmdbbaseewh_speaker']['feInterface'],
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
        'lastname' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_speaker.lastname',
            'config' => array(
                'type' => 'input',
                'size' => '30',
            )
        ),
        'firstname' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_speaker.firstname',
            'config' => array(
                'type' => 'input',
                'size' => '30',
            )
        ),
        'jobtitle' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_speaker.jobtitle',
            'config' => array(
                'type' => 'input',
                'size' => '30',
            )
        ),
        'short_description' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_speaker.short_description',
            'config' => array(
                'type' => 'text',
                'cols' => '30',
                'rows' => '5',
            )
        ),
        'description' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_speaker.description',
            'config' => array(
                'type' => 'text',
                'cols' => '30',
                'rows' => '5',
                'wizards' => array(
                    '_PADDING' => 2,
                    'RTE' => array(
                        'notNewRecords' => 1,
                        'RTEonly'       => 1,
                        'type'          => 'script',
                        'title'         => 'Full screen Rich Text Editing|Formatteret redigering i hele vinduet',
                        'icon'          => 'wizard_rte2.gif',
                        'script'        => 'wizard_rte.php',
                    ),
                ),
            )
        ),
        'mail' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_speaker.mail',
            'config' => array(
                'type' => 'input',
                'size' => '30',
            )
        ),
        'twitter' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_speaker.twitter',
            'config' => array(
                'type' => 'input',
                'size' => '30',
            )
        ),
        'facebook' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_speaker.facebook',
            'config' => array(
                'type' => 'input',
                'size' => '30',
            )
        ),
        'googleplus' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_speaker.googleplus',
            'config' => array(
                'type' => 'input',
                'size' => '30',
            )
        ),
        'linkedin' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_speaker.linkedin',
            'config' => array(
                'type' => 'input',
                'size' => '30',
            )
        ),
        'xing' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_speaker.xing',
            'config' => array(
                'type' => 'input',
                'size' => '30',
            )
        ),
        'milestones' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_speaker.milestones',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_wmdbbaseewh_speaker_milestones',
                'foreign_label' => 'title',
                'maxitems' => 20
            )
        ),
        'image' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:wmdb_base_ewh/locallang_db.xml:tx_wmdbbaseewh_speaker.image',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('image')
        )
    ),
    'types' => array(
        '0' => array('showitem' => 'lastname, firstname, jobtitle, --div--;Access, hidden;;1;;1-1-1, --div--;Description, short_description, description;;;richtext[]:rte_transform[mode=ts], --div--;Contact, mail, twitter, facebook, googleplus, linkedin, xing, --div--;Milestones, milestones, --div--;Media, image')
    ),
    'palettes' => array(
        '1' => array('showitem' => 'starttime, endtime')
    )
);