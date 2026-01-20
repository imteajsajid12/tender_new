-- /cron/tender-file-reject-mail-notification

ALTER TABLE `tenders` ADD `has_salary` TINYINT NOT NULL DEFAULT '0' AFTER `tender_status`;
ALTER TABLE `tenders` ADD `salary` INT(255) NOT NULL DEFAULT '0' AFTER `has_salary`;
CREATE TABLE `tender_user` (`id` INT NOT NULL AUTO_INCREMENT , `tender_id` INT NOT NULL , `user_id` INT NOT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `tenders` ADD `note` LONGTEXT NULL AFTER `salary`;
ALTER TABLE `tenders` ADD `job_details` JSON NULL AFTER `note`;
ALTER TABLE `tenders` CHANGE `job_details` `job_details` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;
ALTER TABLE `tenders` ADD `additional_salary` INT(255) NOT NULL DEFAULT '0' AFTER `salary`;
ALTER TABLE `tenders` ADD `functional_level` TINYINT NOT NULL DEFAULT '0' AFTER `job_details`;
ALTER TABLE `tenders` ADD `is_test_required` TINYINT NOT NULL DEFAULT '0' COMMENT '0=no, 1=yes' AFTER `functional_level`;
ALTER TABLE `app_decisions` ADD `grade` VARCHAR(255) NULL DEFAULT NULL AFTER `tenderval`;
ALTER TABLE `app_decisions` ADD `test_result` INT NULL DEFAULT NULL COMMENT 'null=no result, 0=fail,1=pass' AFTER `tenderval`;
ALTER TABLE `tenders` ADD `is_recommended` TINYINT NOT NULL DEFAULT '0' COMMENT '0=no, 1=yes' AFTER `is_test_required`;
ALTER TABLE `apps_file` ADD `canceled_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP AFTER `status`;
ALTER TABLE `app_decisions` ADD `is_star` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0=no,1=yes' AFTER `grade`;

ALTER TABLE `tenders` ADD `is_drushim` TINYINT NOT NULL DEFAULT '0' AFTER `is_recommended`;
ALTER TABLE `apps_logs` ADD `is_note` TINYINT NOT NULL DEFAULT '0' AFTER `tender_id`;
ALTER TABLE `app_decisions` ADD `has_salary` TINYINT NULL DEFAULT '0' AFTER `decision_committee`, ADD `salary` INT NOT NULL DEFAULT '0' AFTER `has_salary`, ADD `accept_salary` TINYINT NOT NULL DEFAULT '0' AFTER `salary`;


CREATE TABLE `tender_protocol_maker` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `tender_id` VARCHAR(255) NOT NULL,
 `decision_maker` longtext NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci
ALTER TABLE `apps_file` ADD `is_cv` TINYINT NULL DEFAULT '0';

ALTER TABLE `tender_protocol_maker` ADD `signature` LONGTEXT NULL AFTER `decision_maker`;
CREATE TABLE `tender_decision` (
 `id` int(11) NOT NULL,
 `decision_on` longtext DEFAULT NULL,
 `suitable_pos` longtext DEFAULT NULL,
 `proposed_pos` longtext DEFAULT NULL,
 `second_pos` longtext DEFAULT NULL,
 `third_pos` longtext DEFAULT NULL,
 `tender_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

ALTER TABLE `app_decisions` ADD `selected_interview_time` VARCHAR(255) NULL AFTER `accept_salary`;
ALTER TABLE `app_decisions` ADD `approved_interview_time` VARCHAR(255) NULL AFTER `selected_interview_time`;
ALTER TABLE `app_decisions` ADD `selected_interview_place` VARCHAR(255) NULL AFTER `selected_interview_time`;
ALTER TABLE `app_decisions` ADD `approved_interview_place` VARCHAR(255) NULL AFTER `selected_interview_place`;


ALTER TABLE `tender_decision` ADD PRIMARY KEY(`id`)
ALTER TABLE `tender_decision` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tender_decision` CHANGE `decision_on` `decision_on` LONGTEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL;
----- if signature do no exists on tender_protocol_maker table
ALTER TABLE `tender_protocol_maker` ADD `signature` LONGTEXT NULL AFTER `decision_maker`;

ALTER TABLE `app_decisions` ADD `last_invitation_send` TIMESTAMP NULL DEFAULT NULL AFTER `approved_interview_time`;

-------- 01 aug

ALTER TABLE `tenders` ADD `input_manager` VARCHAR(255) NULL AFTER `is_canceled`;
ALTER TABLE `tenders` ADD `job_scope` VARCHAR(255) NULL AFTER `input_manager`;
ALTER TABLE `tenders` ADD `subordinations` VARCHAR(255) NULL AFTER `job_scope`;
ALTER TABLE `tenders` ADD `grades_voltage` VARCHAR(255) NULL AFTER `subordinations`;


--tenders_stat

select `automas`.`tenders`.`id` AS `id`,`automas`.`tenders`.`start_date` AS `start_date`,`automas`.`tenders`.`has_salary` AS `has_salary`,`automas`.`tenders`.`is_test_required` AS `is_test_required`,`automas`.`tenders`.`is_recommended` AS `is_recommended`,`automas`.`tenders`.`is_drushim` AS `is_drushim`,`automas`.`tenders`.`ttype` AS `ttype`,`automas`.`tenders`.`job_details` AS `job_details`,`automas`.`tenders`.`functional_level` AS `functional_level`,`automas`.`tenders`.`input_manager` AS `input_manager`,`automas`.`tenders`.`job_scope` AS `job_scope`,`automas`.`tenders`.`subordinations` AS `subordinations`,`automas`.`tenders`.`grades_voltage` AS `grades_voltage`,`automas`.`tenders`.`finish_date` AS `finish_date`,`automas`.`tenders`.`tname` AS `tname`,`automas`.`tenders`.`generated_id` AS `generated_id`,`automas`.`tenders`.`status` AS `status`,`automas`.`tenders`.`created_date` AS `created_date`,`automas`.`tenders`.`stopped` AS `stopped`,`automas`.`tenders`.`deleted` AS `deleted`,`automas`.`tenders`.`conditions` AS `conditions`,`automas`.`tenders`.`tender_type` AS `tender_type`,`automas`.`tenders`.`tender_status` AS `tender_status`,`count`.`ccount` AS `ccount`,`pending`.`pendingcount` AS `pendingcount`,`accepted`.`accepted` AS `accepted`,`rejected`.`trejected` AS `trejected`,`tf`.`file_name` AS `tender_file_name`,`tf`.`url` AS `tender_file_url` from (((((`automas`.`tenders` left join `automas`.`app_count_val` `count` on(`count`.`tenderval` = `automas`.`tenders`.`generated_id`)) left join `automas`.`app_count_pending` `pending` on(`pending`.`tenderval` = `automas`.`tenders`.`generated_id`)) left join `automas`.`app_accepted` `accepted` on(`accepted`.`tenderval` = `automas`.`tenders`.`generated_id`)) left join `automas`.`app_rejected` `rejected` on(`rejected`.`tenderval` = `automas`.`tenders`.`generated_id`)) left join `automas`.`tenders_active_files` `tf` on(`automas`.`tenders`.`id` = `tf`.`tender_id`)) where `automas`.`tenders`.`deleted` = 0


--tenders_applications

select `cnf`.`ccv` AS `decision_6`,`crf`.`ccv` AS `decision_7`,`cnaf`.`ccv` AS `decision_8`,`cnzf`.`ccv` AS `decision_9`,`cn_touched_f`.`ccv` AS `decision_10`,`automas`.`tenders`.`generated_id` AS `generated_id`,`automas`.`tenders`.`start_date` AS `start_date`,`automas`.`tenders`.`finish_date` AS `finish_date`,`automas`.`tenders`.`tname` AS `tname`,`automas`.`tenders`.`status` AS `status`,`automas`.`tenders`.`created_date` AS `created_date`,`automas`.`app_decisions`.`crdate` AS `crdate`,`automas`.`app_decisions`.`id` AS `id`,`automas`.`app_decisions`.`id_tz` AS `id_tz`,`automas`.`app_decisions`.`tenderval` AS `tenderval`,`automas`.`app_decisions`.`p1_id` AS `p1_id`,`automas`.`app_decisions`.`p2_id` AS `p2_id`,`automas`.`app_decisions`.`p3_id` AS `p3_id`,`automas`.`app_decisions`.`p5_id` AS `p5_id`,`automas`.`app_decisions`.`decision_1` AS `decision_1`,`automas`.`app_decisions`.`decision_1_a` AS `decision_1_a`,`automas`.`app_decisions`.`decision_1_b` AS `decision_1_b`,`automas`.`app_decisions`.`decision_1_comment` AS `decision_1_comment`,`automas`.`app_decisions`.`decision_2` AS `decision_2`,`automas`.`app_decisions`.`decision_2_comment` AS `decision_2_comment`,`automas`.`app_decisions`.`decision_3` AS `decision_3`,`automas`.`app_decisions`.`decision_3_a` AS `decision_3_a`,`automas`.`app_decisions`.`decision_3_b` AS `decision_3_b`,`automas`.`app_decisions`.`test_result` AS `test_result`,`automas`.`app_decisions`.`is_star` AS `is_star`,`automas`.`app_decisions`.`decision_3_comment` AS `decision_3_comment`,`automas`.`app_decisions`.`decision_4` AS `decision_4`,`automas`.`app_decisions`.`decision_4_comment` AS `decision_4_comment`,`automas`.`app_decisions`.`decision_committee` AS `decision_committee`,`automas`.`app_decisions`.`decision_5` AS `decision_5`,`automas`.`app_decisions`.`decision_rejectedbyuser` AS `decision_rejectedbyuser`,`automas`.`app_decisions`.`email` AS `email`,`automas`.`app_decisions`.`rejected` AS `rejected`,`automas`.`app_decisions`.`applicant_name` AS `applicant_name`,`automas`.`app_decisions`.`generated_dec_id` AS `generated_dec_id`,case when `automas`.`app_decisions`.`decision_3` + `automas`.`app_decisions`.`decision_3_a` + `automas`.`app_decisions`.`decision_3_b` + `automas`.`app_decisions`.`decision_4` = 0 and `automas`.`app_decisions`.`decision_committee` = 1 then 'Committee' when `automas`.`app_decisions`.`decision_rejectedbyuser` = 1 then 'RejUser' when `automas`.`app_decisions`.`decision_1` = 1 and `automas`.`app_decisions`.`decision_1_a` <> 1 and `automas`.`app_decisions`.`decision_1_b` <> 1 and `automas`.`app_decisions`.`decision_2` <> 1 and `automas`.`app_decisions`.`decision_3` + `automas`.`app_decisions`.`decision_3_a` + `automas`.`app_decisions`.`decision_3_b` + `automas`.`app_decisions`.`decision_4` + `automas`.`app_decisions`.`decision_committee` = 0 then 'Interview' when `automas`.`app_decisions`.`decision_1_a` = 1 and `automas`.`app_decisions`.`decision_1_b` <> 1 and `automas`.`app_decisions`.`decision_2` <> 1 and `automas`.`app_decisions`.`decision_3` + `automas`.`app_decisions`.`decision_3_a` + `automas`.`app_decisions`.`decision_3_b` + `automas`.`app_decisions`.`decision_4` + `automas`.`app_decisions`.`decision_committee` = 0 then 'Interview A' when `automas`.`app_decisions`.`decision_1_a` = 1 and `automas`.`app_decisions`.`decision_1_b` = 1 and `automas`.`app_decisions`.`decision_2` <> 1 and `automas`.`app_decisions`.`decision_3` + `automas`.`app_decisions`.`decision_3_a` + `automas`.`app_decisions`.`decision_3_b` + `automas`.`app_decisions`.`decision_4` + `automas`.`app_decisions`.`decision_committee` = 0 then 'Interview B' when `automas`.`app_decisions`.`decision_2` = 1 then 'Rejected due to conditions' when `automas`.`app_decisions`.`decision_4` = 1 then 'Rejected' when `automas`.`app_decisions`.`decision_3_a` = 1 then 'Accepted A' when `automas`.`app_decisions`.`decision_3_b` = 1 then 'Accepted B' when `automas`.`app_decisions`.`decision_3` = 1 then 'Accepted' when `automas`.`app_decisions`.`decision_1` + `automas`.`app_decisions`.`decision_1_a` + `automas`.`app_decisions`.`decision_1_b` + `automas`.`app_decisions`.`decision_2` + `automas`.`app_decisions`.`decision_3_a` + `automas`.`app_decisions`.`decision_3_b` + `automas`.`app_decisions`.`decision_3` + `automas`.`app_decisions`.`decision_4` + `automas`.`app_decisions`.`decision_5` + `automas`.`app_decisions`.`decision_committee` = 0 and `cn_touched_f`.`ccv` is null then 'New' when `crf`.`ccv` is not null then 'newfiles' when `cnaf`.`ccv` is not null then 'Waiting for files' when `cnaf`.`ccv` is null and `automas`.`app_decisions`.`decision_1` <> 1 and `automas`.`app_decisions`.`decision_1_a` <> 1 and `automas`.`app_decisions`.`decision_1_b` <> 1 and `automas`.`app_decisions`.`decision_2` <> 1 then 'Waiting' else 'Other' end AS `app_status`,case when `automas`.`app_decisions`.`decision_3` + `automas`.`app_decisions`.`decision_3_a` + `automas`.`app_decisions`.`decision_3_b` + `automas`.`app_decisions`.`decision_4` = 0 and `automas`.`app_decisions`.`decision_committee` = 1 then 10 when `automas`.`app_decisions`.`decision_rejectedbyuser` = 1 then 7 when `automas`.`app_decisions`.`decision_1` = 1 and `automas`.`app_decisions`.`decision_1_a` <> 1 and `automas`.`app_decisions`.`decision_1_b` <> 1 and `automas`.`app_decisions`.`decision_2` <> 1 and `automas`.`app_decisions`.`decision_3` + `automas`.`app_decisions`.`decision_3_a` + `automas`.`app_decisions`.`decision_3_b` + `automas`.`app_decisions`.`decision_4` + `automas`.`app_decisions`.`decision_committee` = 0 then 3 when `automas`.`app_decisions`.`decision_1_a` = 1 and `automas`.`app_decisions`.`decision_1_b` <> 1 and `automas`.`app_decisions`.`decision_2` <> 1 and `automas`.`app_decisions`.`decision_3` + `automas`.`app_decisions`.`decision_4` + `automas`.`app_decisions`.`decision_committee` = 0 then 11 when `automas`.`app_decisions`.`decision_1_a` = 1 and `automas`.`app_decisions`.`decision_1_b` = 1 and `automas`.`app_decisions`.`decision_2` <> 1 and `automas`.`app_decisions`.`decision_3` + `automas`.`app_decisions`.`decision_4` + `automas`.`app_decisions`.`decision_committee` = 0 then 12 when `automas`.`app_decisions`.`decision_4` = 1 then 4 when `automas`.`app_decisions`.`decision_3_a` = 1 then 13 when `automas`.`app_decisions`.`decision_3_b` = 1 then 14 when `automas`.`app_decisions`.`decision_3` = 1 then 5 when `automas`.`app_decisions`.`decision_2` = 1 then 6 when `automas`.`app_decisions`.`decision_1` + `automas`.`app_decisions`.`decision_1_a` + `automas`.`app_decisions`.`decision_1_b` + `automas`.`app_decisions`.`decision_3_a` + `automas`.`app_decisions`.`decision_3_b` + `automas`.`app_decisions`.`decision_2` + `automas`.`app_decisions`.`decision_3` + `automas`.`app_decisions`.`decision_4` + `automas`.`app_decisions`.`decision_5` + `automas`.`app_decisions`.`decision_committee` = 0 and `cn_touched_f`.`ccv` is null then 1 when `crf`.`ccv` is not null then 2 when `cnaf`.`ccv` is not null then 8 when `cnaf`.`ccv` is null and `automas`.`app_decisions`.`decision_1` <> 1 and `automas`.`app_decisions`.`decision_1_a` <> 1 and `automas`.`app_decisions`.`decision_1_b` <> 1 and `automas`.`app_decisions`.`decision_2` <> 1 then 9 else 0 end AS `app_statusnum` from (((((((`automas`.`app_decisions` join `automas`.`tenders` on(`automas`.`tenders`.`generated_id` = `automas`.`app_decisions`.`tenderval`)) left join `automas`.`count_newfiles` `cnf` on(`automas`.`app_decisions`.`p5_id` = `cnf`.`app_id`)) left join `automas`.`count_rejectedfiles` `crf` on(`automas`.`app_decisions`.`p5_id` = `crf`.`app_id`)) left join `automas`.`count_notapproved` `cnaf` on(`automas`.`app_decisions`.`p5_id` = `cnaf`.`app_id`)) left join `automas`.`count_zerofiles` `cnzf` on(`automas`.`app_decisions`.`p5_id` = `cnzf`.`app_id`)) left join `automas`.`count_touchedfiles` `cn_touched_f` on(`automas`.`app_decisions`.`p5_id` = `cn_touched_f`.`app_id`)) left join `automas`.`count_justaploaded` on(`automas`.`app_decisions`.`p5_id` = `count_justaploaded`.`app_id`))

--------------------
ALTER TABLE `app_decisions` ADD `invitation_accept_time` TIMESTAMP NULL AFTER `last_invitation_send`;
ALTER TABLE `tenders` ADD `created_by` INT NOT NULL AFTER `grades_voltage`;



ALTER TABLE `apps_file` CHANGE `canceled_at` `canceled_at` TIMESTAMP NULL DEFAULT NULL;
----------
ALTER TABLE `apps_file` ADD `app_dec_id` INT NOT NULL DEFAULT 0 AFTER `id`;


ALTER TABLE `tender_decision` CHANGE `decision_on` `decision_on` LONGTEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL;
ALTER TABLE `tender_decision` CHANGE `suitable_pos` `suitable_pos` LONGTEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL;
ALTER TABLE `tender_decision` CHANGE `proposed_pos` `proposed_pos` LONGTEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL;
ALTER TABLE `tender_decision` CHANGE `second_pos` `second_pos` LONGTEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL;
ALTER TABLE `tender_decision` CHANGE `third_pos` `third_pos` LONGTEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL;


ALTER TABLE `apps_file` ADD `is_cv` TINYINT NOT NULL DEFAULT '0' AFTER `canceled_at`;
--------------------------
ALTER TABLE `tenders` CHANGE `functional_level` `functional_level` VARCHAR(255) NOT NULL DEFAULT '0';

ALTER TABLE `tender_decision` ADD `select_dec` VARCHAR(255) NULL AFTER `tender_id`;
--------------
ALTER TABLE `app_decisions` ADD `approved_committee_time` TIMESTAMP NULL DEFAULT NULL;

ALTER TABLE `app_decisions` ADD `is_appeared` TINYINT NULL DEFAULT NULL AFTER `approved_committee_time`;

-----------------
ALTER TABLE `app_decisions` ADD `committee_selected_place` VARCHAR(255) NULL AFTER `is_appeared`;
------------
ALTER TABLE `app_decisions` ADD `committee_invitation_approved_time` TIMESTAMP NULL DEFAULT NULL AFTER `committee_selected_place`;
--------
ALTER TABLE `app_decisions` CHANGE `2nd_invitation_rejected` `2nd_invitation_rejected` TINYINT(2) NULL DEFAULT '0';

