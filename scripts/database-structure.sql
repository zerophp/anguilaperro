SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `anguilaperro` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `anguilaperro` ;

-- -----------------------------------------------------
-- Table `anguilaperro`.`group_states`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anguilaperro`.`group_states` (
  `idgroup_state` INT NOT NULL AUTO_INCREMENT,
  `state` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idgroup_state`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anguilaperro`.`groups`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anguilaperro`.`groups` (
  `idgroups` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `group_state` INT NOT NULL,
  PRIMARY KEY (`idgroups`),
  INDEX `fk_groups_group_states1_idx` (`group_state` ASC),
  CONSTRAINT `fk_groups_group_states1`
    FOREIGN KEY (`group_state`)
    REFERENCES `anguilaperro`.`group_states` (`idgroup_state`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anguilaperro`.`user_states`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anguilaperro`.`user_states` (
  `iduser_state` INT NOT NULL AUTO_INCREMENT,
  `state` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`iduser_state`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anguilaperro`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anguilaperro`.`users` (
  `idusers` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NULL,
  `user_state` INT NOT NULL,
  PRIMARY KEY (`idusers`),
  INDEX `fk_users_user_states1_idx` (`user_state` ASC),
  CONSTRAINT `fk_users_user_states1`
    FOREIGN KEY (`user_state`)
    REFERENCES `anguilaperro`.`user_states` (`iduser_state`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anguilaperro`.`exams`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anguilaperro`.`exams` (
  `idexams` INT NOT NULL AUTO_INCREMENT,
  `topic` VARCHAR(255) NOT NULL,
  `difficulty` INT NOT NULL,
  PRIMARY KEY (`idexams`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anguilaperro`.`question_difficulties`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anguilaperro`.`question_difficulties` (
  `idquestion_difficulties` INT NOT NULL AUTO_INCREMENT,
  `question_type` VARCHAR(45) NULL,
  PRIMARY KEY (`idquestion_difficulties`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anguilaperro`.`question_types`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anguilaperro`.`question_types` (
  `idquestion_types` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(255) NULL,
  PRIMARY KEY (`idquestion_types`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anguilaperro`.`questions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anguilaperro`.`questions` (
  `idquestions` INT NOT NULL AUTO_INCREMENT,
  `description` TEXT NOT NULL,
  `question_difficulty` INT NOT NULL,
  `question_type` INT NOT NULL,
  `exam` INT NOT NULL,
  PRIMARY KEY (`idquestions`),
  INDEX `fk_questions_question_difficulties_idx` (`question_difficulty` ASC),
  INDEX `fk_questions_question_types1_idx` (`question_type` ASC),
  INDEX `fk_questions_exams1_idx` (`exam` ASC),
  CONSTRAINT `fk_questions_question_difficulties`
    FOREIGN KEY (`question_difficulty`)
    REFERENCES `anguilaperro`.`question_difficulties` (`idquestion_difficulties`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_questions_question_types1`
    FOREIGN KEY (`question_type`)
    REFERENCES `anguilaperro`.`question_types` (`idquestion_types`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_questions_exams1`
    FOREIGN KEY (`exam`)
    REFERENCES `anguilaperro`.`exams` (`idexams`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anguilaperro`.`answers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anguilaperro`.`answers` (
  `idanswers` INT NOT NULL AUTO_INCREMENT,
  `text` VARCHAR(255) NOT NULL,
  `is_correct` TINYINT(1) NULL,
  `question` INT NOT NULL,
  PRIMARY KEY (`idanswers`),
  INDEX `fk_answers_questions1_idx` (`question` ASC),
  CONSTRAINT `fk_answers_questions1`
    FOREIGN KEY (`question`)
    REFERENCES `anguilaperro`.`questions` (`idquestions`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anguilaperro`.`groups_has_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anguilaperro`.`groups_has_users` (
  `groups_idgroups` INT NOT NULL,
  `users_idusers` INT NOT NULL,
  PRIMARY KEY (`groups_idgroups`, `users_idusers`),
  INDEX `fk_groups_has_users_users1_idx` (`users_idusers` ASC),
  INDEX `fk_groups_has_users_groups1_idx` (`groups_idgroups` ASC),
  CONSTRAINT `fk_groups_has_users_groups1`
    FOREIGN KEY (`groups_idgroups`)
    REFERENCES `anguilaperro`.`groups` (`idgroups`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_groups_has_users_users1`
    FOREIGN KEY (`users_idusers`)
    REFERENCES `anguilaperro`.`users` (`idusers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anguilaperro`.`exam_state`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anguilaperro`.`exam_state` (
  `idexam_state` INT NOT NULL,
  `state` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idexam_state`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anguilaperro`.`established_exams`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anguilaperro`.`established_exams` (
  `idestablished_exams` INT NOT NULL AUTO_INCREMENT,
  `ini_date` DATE NOT NULL,
  `end_date` DATE NOT NULL,
  `group` INT NOT NULL,
  `exam` INT NOT NULL,
  `exam_state` INT NOT NULL,
  PRIMARY KEY (`idestablished_exams`),
  INDEX `fk_established_exams_groups1_idx` (`group` ASC),
  INDEX `fk_established_exams_exams1_idx` (`exam` ASC),
  INDEX `fk_established_exams_exam_state1_idx` (`exam_state` ASC),
  CONSTRAINT `fk_established_exams_groups1`
    FOREIGN KEY (`group`)
    REFERENCES `anguilaperro`.`groups` (`idgroups`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_established_exams_exams1`
    FOREIGN KEY (`exam`)
    REFERENCES `anguilaperro`.`exams` (`idexams`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_established_exams_exam_state1`
    FOREIGN KEY (`exam_state`)
    REFERENCES `anguilaperro`.`exam_state` (`idexam_state`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anguilaperro`.`teacher`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anguilaperro`.`teacher` (
  `idteacher` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idteacher`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anguilaperro`.`teacher_has_groups`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anguilaperro`.`teacher_has_groups` (
  `teacher_idteacher` INT NOT NULL,
  `groups_idgroups` INT NOT NULL,
  PRIMARY KEY (`teacher_idteacher`, `groups_idgroups`),
  INDEX `fk_teacher_has_groups_groups1_idx` (`groups_idgroups` ASC),
  INDEX `fk_teacher_has_groups_teacher1_idx` (`teacher_idteacher` ASC),
  CONSTRAINT `fk_teacher_has_groups_teacher1`
    FOREIGN KEY (`teacher_idteacher`)
    REFERENCES `anguilaperro`.`teacher` (`idteacher`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_teacher_has_groups_groups1`
    FOREIGN KEY (`groups_idgroups`)
    REFERENCES `anguilaperro`.`groups` (`idgroups`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anguilaperro`.`teacher_has_exams`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anguilaperro`.`teacher_has_exams` (
  `teacher_idteacher` INT NOT NULL,
  `exams_idexams` INT NOT NULL,
  PRIMARY KEY (`teacher_idteacher`, `exams_idexams`),
  INDEX `fk_teacher_has_exams_exams1_idx` (`exams_idexams` ASC),
  INDEX `fk_teacher_has_exams_teacher1_idx` (`teacher_idteacher` ASC),
  CONSTRAINT `fk_teacher_has_exams_teacher1`
    FOREIGN KEY (`teacher_idteacher`)
    REFERENCES `anguilaperro`.`teacher` (`idteacher`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_teacher_has_exams_exams1`
    FOREIGN KEY (`exams_idexams`)
    REFERENCES `anguilaperro`.`exams` (`idexams`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anguilaperro`.`exam_done`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anguilaperro`.`exam_done` (
  `users_idusers` INT NOT NULL,
  `established_exams_idestablished_exams` INT NOT NULL,
  `date` DATE NULL,
  `questions_correct` INT NULL,
  `questions_incorrect` INT NULL,
  `mark` FLOAT NULL,
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
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anguilaperro`.`questions_done`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anguilaperro`.`questions_done` (
  `idquestions_done` INT NOT NULL AUTO_INCREMENT,
  `answer` VARCHAR(255) NOT NULL,
  `is_correct` INT NULL,
  `exam_done_users_idusers` INT NOT NULL,
  `exam_done_established_exams_idestablished_exams` INT NOT NULL,
  `questions_idquestions` INT NOT NULL,
  PRIMARY KEY (`idquestions_done`),
  INDEX `fk_questions_done_exam_done1_idx` (`exam_done_users_idusers` ASC, `exam_done_established_exams_idestablished_exams` ASC),
  INDEX `fk_questions_done_questions1_idx` (`questions_idquestions` ASC),
  CONSTRAINT `fk_questions_done_exam_done1`
    FOREIGN KEY (`exam_done_users_idusers` , `exam_done_established_exams_idestablished_exams`)
    REFERENCES `anguilaperro`.`exam_done` (`users_idusers` , `established_exams_idestablished_exams`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_questions_done_questions1`
    FOREIGN KEY (`questions_idquestions`)
    REFERENCES `anguilaperro`.`questions` (`idquestions`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
