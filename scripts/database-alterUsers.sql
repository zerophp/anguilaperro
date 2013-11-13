SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

ALTER TABLE `anguilaperro`.`groups` 
DROP FOREIGN KEY `fk_groups_group_states1`;

ALTER TABLE `anguilaperro`.`users` 
DROP FOREIGN KEY `fk_users_user_states1`;

ALTER TABLE `anguilaperro`.`groups` 
DROP COLUMN `group_state`,
ADD COLUMN `group_state` INT(11) NOT NULL AFTER `name`,
ADD INDEX `fk_groups_group_states1_idx` (`group_state` ASC),
DROP INDEX `fk_groups_group_states1_idx` ;

ALTER TABLE `anguilaperro`.`users` 
DROP COLUMN `user_state`,
CHANGE COLUMN `timestamp` `timestamp` VARCHAR(255) NULL DEFAULT NULL ,
ADD COLUMN `user_state` INT(11) NOT NULL AFTER `name`,
ADD INDEX `fk_users_user_states1_idx` (`user_state` ASC),
DROP INDEX `fk_users_user_states1_idx` ;

ALTER TABLE `anguilaperro`.`question_difficulties` 
DROP COLUMN `question_type`,
ADD COLUMN `question_type` VARCHAR(45) NULL DEFAULT NULL AFTER `idquestion_difficulties`;

ALTER TABLE `anguilaperro`.`exam_state` 
DROP COLUMN `state`,
ADD COLUMN `state` VARCHAR(255) NOT NULL AFTER `idexam_state`;

ALTER TABLE `anguilaperro`.`teacher_has_groups` 
ADD INDEX `fk_teacher_has_groups_groups1_idx` (`groups_idgroups` ASC),
ADD INDEX `fk_teacher_has_groups_teacher1_idx` (`teacher_idteacher` ASC),
DROP INDEX `fk_teacher_has_groups_teacher1_idx` ,
DROP INDEX `fk_teacher_has_groups_groups1_idx` ;

ALTER TABLE `anguilaperro`.`teacher_has_exams` 
ADD INDEX `fk_teacher_has_exams_exams1_idx` (`exams_idexams` ASC),
ADD INDEX `fk_teacher_has_exams_teacher1_idx` (`teacher_idteacher` ASC),
DROP INDEX `fk_teacher_has_exams_teacher1_idx` ,
DROP INDEX `fk_teacher_has_exams_exams1_idx` ;

ALTER TABLE `anguilaperro`.`questions_done` 
ADD INDEX `fk_questions_done_exam_done1_idx` (`exam_done_users_idusers` ASC, `exam_done_established_exams_idestablished_exams` ASC),
ADD INDEX `fk_questions_done_questions1_idx` (`questions_idquestions` ASC),
DROP INDEX `fk_questions_done_questions1_idx` ,
DROP INDEX `fk_questions_done_exam_done1_idx` ;

CREATE TABLE IF NOT EXISTS `anguilaperro`.`exam_done` (
  `users_idusers` INT(11) NOT NULL,
  `established_exams_idestablished_exams` INT(11) NOT NULL,
  `date` DATE NULL DEFAULT NULL,
  `questions_correct` INT(11) NULL DEFAULT NULL,
  `questions_incorrect` INT(11) NULL DEFAULT NULL,
  `mark` FLOAT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`users_idusers`, `established_exams_idestablished_exams`),
  INDEX `fk_users_has_established_exams_established_exams1_idx` (`established_exams_idestablished_exams` ASC),
  INDEX `fk_users_has_established_exams_users1_idx` (`users_idusers` ASC),
  CONSTRAINT `fk_users_has_established_exams_users1`
    FOREIGN KEY (`users_idusers`)
    REFERENCES `anguilaperro`.`users` (`idusers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_established_exams_established_exams1`
    FOREIGN KEY (`established_exams_idestablished_exams`)
    REFERENCES `anguilaperro`.`established_exams` (`idestablished_exams`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

ALTER TABLE `anguilaperro`.`group_states` 
DROP COLUMN `state`,
DROP COLUMN `idgroup_state`,
ADD COLUMN `idgroup_state` INT(11) NOT NULL AUTO_INCREMENT FIRST,
ADD COLUMN `state` VARCHAR(255) NOT NULL AFTER `idgroup_state`,
DROP PRIMARY KEY,
ADD PRIMARY KEY (`idgroup_state`);

ALTER TABLE `anguilaperro`.`user_states` 
DROP COLUMN `state`,
DROP COLUMN `iduser_state`,
ADD COLUMN `iduser_state` INT(11) NOT NULL AUTO_INCREMENT FIRST,
ADD COLUMN `state` VARCHAR(255) NOT NULL AFTER `iduser_state`,
DROP PRIMARY KEY,
ADD PRIMARY KEY (`iduser_state`);

ALTER TABLE `anguilaperro`.`groups` 
ADD CONSTRAINT `fk_groups_group_states1`
  FOREIGN KEY (`group_state`)
  REFERENCES `anguilaperro`.`group_states` (`idgroup_state`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `anguilaperro`.`users` 
ADD CONSTRAINT `fk_users_user_states1`
  FOREIGN KEY (`user_state`)
  REFERENCES `anguilaperro`.`user_states` (`iduser_state`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
