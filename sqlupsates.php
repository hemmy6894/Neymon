<?php

//begin date 29/10/2018 since morning
ALTER TABLE `members` CHANGE `member_id` `memberid_type` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;

//
ALTER TABLE `members` ADD `jobtitle` VARCHAR(300) NOT NULL AFTER `lastname`;
//
ALTER TABLE `members` ADD `memberid_name_issue` VARCHAR(300) NOT NULL AFTER `type_id`;
//
ALTER TABLE `members` ADD `memberid_place_issue` VARCHAR(300) NOT NULL AFTER `memberid_name_issue`;
//
ALTER TABLE `members` ADD `month_salary` VARCHAR(3000) NOT NULL AFTER `memberid_place_issue`;
//
ALTER TABLE `members` ADD `photo_salary` VARCHAR(200) NOT NULL AFTER `month_salary`;
//

ALTER TABLE `member_registrationfee` CHANGE `member_id` `memberid_type` VARCHAR(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
//
ALTER TABLE `general_ledger` CHANGE `member_id` `memberid_type` VARCHAR(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
//
ALTER TABLE `members_contact` CHANGE `email` `contact_house` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL, CHANGE `physicaladdress` `contact_city` VARCHAR(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL, CHANGE `fax` `contact_district` VARCHAR(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
//
ALTER TABLE `members_contact` CHANGE `contact_house` `contact_house` VARCHAR(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
//
ALTER TABLE `members_contact` ADD `contact_street` VARCHAR(300) NOT NULL AFTER `contact_city`, ADD `contact_ward` VARCHAR(300) NOT NULL AFTER `contact_street`;
//day closed 29/10/2018 timeclosed(5:24PM)
ALTER TABLE `members_grouplist` CHANGE `name` `company_name` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE `members_grouplist` ADD `company_city` VARCHAR(300) NOT NULL AFTER `PIN`, ADD `company_distrit` VARCHAR(300) NOT NULL AFTER `company_city`, ADD `company_phone` VARCHAR(300) NOT NULL AFTER `company_distrit`, ADD `company_email` VARCHAR(300) NOT NULL AFTER `company_phone`, ADD `company_ward` VARCHAR(300) NOT NULL AFTER `company_email`, ADD `company_street` VARCHAR(120) NOT NULL AFTER `company_ward`;


ALTER TABLE `members`
  DROP `type_id_number`;

?>
