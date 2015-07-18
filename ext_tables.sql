/**
 * tt_content
 */
 CREATE TABLE tt_content {
    tx_wmdbbaseewh_list_type varchar(36) DEFAULT '0' NOT NULL
 };

#
# Table structure for table 'tx_wmdbbaseewh_slide'
#
CREATE TABLE tx_wmdbbaseewh_slide (
    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,
    tstamp int(11) DEFAULT '0' NOT NULL,
    crdate int(11) DEFAULT '0' NOT NULL,
    cruser_id int(11) DEFAULT '0' NOT NULL,
    deleted tinyint(4) DEFAULT '0' NOT NULL,
    hidden tinyint(4) DEFAULT '0' NOT NULL,
    starttime int(11) DEFAULT '0' NOT NULL,
    endtime int(11) DEFAULT '0' NOT NULL,
    fe_group int(11) DEFAULT '0' NOT NULL,
    headline tinytext,
    description text,
    image tinytext,
    author tinytext,
    style int(11) DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid)
) ENGINE=InnoDB;

#
# Table structure for table 'tx_wmdbbaseewh_courses'
#
CREATE TABLE tx_wmdbbaseewh_courses (
    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,
    tstamp int(11) DEFAULT '0' NOT NULL,
    crdate int(11) DEFAULT '0' NOT NULL,
    cruser_id int(11) DEFAULT '0' NOT NULL,
    deleted tinyint(4) DEFAULT '0' NOT NULL,
    hidden tinyint(4) DEFAULT '0' NOT NULL,
    starttime int(11) DEFAULT '0' NOT NULL,
    endtime int(11) DEFAULT '0' NOT NULL,
    fe_group int(11) DEFAULT '0' NOT NULL,
    headline tinytext,
    tx_wmdbbasewh_courses_cats tinytext,
    description text,
    teaser tinytext,
    detaillink tinytext,
    promote int(11) DEFAULT '0' NOT NULL,,
    speaker tinytext,
    downloads tinytext,

    PRIMARY KEY (uid),
    KEY parent (pid)
) ENGINE=InnoDB;

#
# Table structure for table 'tx_wmdbbaseewh_links'
#
CREATE TABLE tx_wmdbbaseewh_links (
    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,
    tstamp int(11) DEFAULT '0' NOT NULL,
    crdate int(11) DEFAULT '0' NOT NULL,
    cruser_id int(11) DEFAULT '0' NOT NULL,
    deleted tinyint(4) DEFAULT '0' NOT NULL,
    hidden tinyint(4) DEFAULT '0' NOT NULL,
    label tinytext,
    link tinytext,

    PRIMARY KEY (uid),
    KEY parent (pid)
) ENGINE=InnoDB;

#
# Table structure for table 'tx_wmdbbaseewh_speaker'
#
CREATE TABLE tx_wmdbbaseewh_speaker (
    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,
    tstamp int(11) DEFAULT '0' NOT NULL,
    crdate int(11) DEFAULT '0' NOT NULL,
    cruser_id int(11) DEFAULT '0' NOT NULL,
    deleted tinyint(4) DEFAULT '0' NOT NULL,
    hidden tinyint(4) DEFAULT '0' NOT NULL,
    starttime int(11) DEFAULT '0' NOT NULL,
    endtime int(11) DEFAULT '0' NOT NULL,
    lastname tinytext,
    firstname tinytext,
    jobtitle tinytext,
    short_description text,
    description text,
    mail tinytext,
    twitter tinytext,
    facebook tinytext,
    googleplus tinytext,
    linkedin tinytext,
    xing tinytext,
    milestones tinytext,
    image int(11) default '0' NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid)
) ENGINE=InnoDB;



#
# Table structure for table 'tx_wmdbbaseewh_speaker_milestones'
#
CREATE TABLE tx_wmdbbaseewh_speaker_milestones (
    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,
    tstamp int(11) DEFAULT '0' NOT NULL,
    crdate int(11) DEFAULT '0' NOT NULL,
    cruser_id int(11) DEFAULT '0' NOT NULL,
    deleted tinyint(4) DEFAULT '0' NOT NULL,
    hidden tinyint(4) DEFAULT '0' NOT NULL,
    title tinytext,
    description tinytext,
    achieved int(11) DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid)
) ENGINE=InnoDB;