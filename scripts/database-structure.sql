SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`group_states`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`group_states` (
  `idgroup_state` INT NOT NULL AUTO_INCREMENT,
  `state` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idgroup_state`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`groups`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`groups` (
  `idgroups` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `group_state` INT NOT NULL,
  PRIMARY KEY (`idgroups`),
  INDEX `fk_groups_group_states1_idx` (`group_state` ASC),
  CONSTRAINT `fk_groups_group_states1`
    FOREIGN KEY (`group_state`)
    REFERENCES `mydb`.`group_states` (`idgroup_state`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`user_states`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`user_states` (
  `iduser_state` INT NOT NULL AUTO_INCREMENT,
  `state` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`iduser_state`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`users` (
  `idusers` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NULL,
  `user_state` INT NOT NULL,
  PRIMARY KEY (`idusers`),
  INDEX `fk_users_user_states1_idx` (`user_state` ASC),
  CONSTRAINT `fk_users_user_states1`
    FOREIGN KEY (`user_state`)
    REFERENCES `mydb`.`user_states` (`iduser_state`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`exams`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`exams` (
  `idexams` INT NOT NULL AUTO_INCREMENT,
  `topic` VARCHAR(255) NOT NULL,
  `difficulty` INT NOT NULL,
  PRIMARY KEY (`idexams`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`question_difficulties`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`question_difficulties` (
  `idquestion_difficulties` INT NOT NULL AUTO_INCREMENT,
  `question_type` VARCHAR(45) NULL,
  PRIMARY KEY (`idquestion_difficulties`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`question_types`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`question_types` (
  `idquestion_types` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(255) NULL,
  PRIMARY KEY (`idquestion_types`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`questions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`questions` (
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
    REFERENCES `mydb`.`question_difficulties` (`idquestion_difficulties`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_questions_question_types1`
    FOREIGN KEY (`question_type`)
    REFERENCES `mydb`.`question_types` (`idquestion_types`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_questions_exams1`
    FOREIGN KEY (`exam`)
    REFERENCES `mydb`.`exams` (`idexams`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`answers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`answers` (
  `idanswers` INT NOT NULL AUTO_INCREMENT,
  `text` VARCHAR(255) NOT NULL,
  `is_correct` TINYINT(1) NULL,
  `question` INT NOT NULL,
  PRIMARY KEY (`idanswers`),
  INDEX `fk_answers_questions1_idx` (`question` ASC),
  CONSTRAINT `fk_answers_questions1`
    FOREIGN KEY (`question`)
    REFERENCES `mydb`.`questions` (`idquestions`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`groups_has_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`groups_has_users` (
  `groups_idgroups` INT NOT NULL,
  `users_idusers` INT NOT NULL,
  PRIMARY KEY (`groups_idgroups`, `users_idusers`),
  INDEX `fk_groups_has_users_users1_idx` (`users_idusers` ASC),
  INDEX `fk_groups_has_users_groups1_idx` (`groups_idgroups` ASC),
  CONSTRAINT `fk_groups_has_users_groups1`
    FOREIGN KEY (`groups_idgroups`)
    REFERENCES `mydb`.`groups` (`idgroups`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_groups_has_users_users1`
    FOREIGN KEY (`users_idusers`)
    REFERENCES `mydb`.`users` (`idusers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`exam_state`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`exam_state` (
  `idexam_state` INT NOT NULL,
  `state` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idexam_state`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`established_exams`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`established_exams` (
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
    REFERENCES `mydb`.`groups` (`idgroups`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_established_exams_exams1`
    FOREIGN KEY (`exam`)
    REFERENCES `mydb`.`exams` (`idexams`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_established_exams_exam_state1`
    FOREIGN KEY (`exam_state`)
    REFERENCES `mydb`.`exam_state` (`idexam_state`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`teacher`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`teacher` (
  `idteacher` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idteacher`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`teacher_has_groups`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`teacher_has_groups` (
  `teacher_idteacher` INT NOT NULL,
  `groups_idgroups` INT NOT NULL,
  PRIMARY KEY (`teacher_idteacher`, `groups_idgroups`),
  INDEX `fk_teacher_has_groups_groups1_idx` (`groups_idgroups` ASC),
  INDEX `fk_teacher_has_groups_teacher1_idx` (`teacher_idteacher` ASC),
  CONSTRAINT `fk_teacher_has_groups_teacher1`
    FOREIGN KEY (`teacher_idteacher`)
    REFERENCES `mydb`.`teacher` (`idteacher`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_teacher_has_groups_groups1`
    FOREIGN KEY (`groups_idgroups`)
    REFERENCES `mydb`.`groups` (`idgroups`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`teacher_has_exams`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`teacher_has_exams` (
  `teacher_idteacher` INT NOT NULL,
  `exams_idexams` INT NOT NULL,
  PRIMARY KEY (`teacher_idteacher`, `exams_idexams`),
  INDEX `fk_teacher_has_exams_exams1_idx` (`exams_idexams` ASC),
  INDEX `fk_teacher_has_exams_teacher1_idx` (`teacher_idteacher` ASC),
  CONSTRAINT `fk_teacher_has_exams_teacher1`
    FOREIGN KEY (`teacher_idteacher`)
    REFERENCES `mydb`.`teacher` (`idteacher`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_teacher_has_exams_exams1`
    FOREIGN KEY (`exams_idexams`)
    REFERENCES `mydb`.`exams` (`idexams`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`exam_done`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`exam_done` (
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
    REFERENCES `mydb`.`users` (`idusers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_established_exams_established_exams1`
    FOREIGN KEY (`established_exams_idestablished_exams`)
    REFERENCES `mydb`.`established_exams` (`idestablished_exams`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`questions_done`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`questions_done` (
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
    REFERENCES `mydb`.`exam_done` (`users_idusers` , `established_exams_idestablished_exams`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_questions_done_questions1`
    FOREIGN KEY (`questions_idquestions`)
    REFERENCES `mydb`.`questions` (`idquestions`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
