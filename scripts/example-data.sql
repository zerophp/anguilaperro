INSERT INTO `anguilaperro`.`users` (`email`, `password`, `name`, `user_state`) VALUES ('anguilaperro@gmail.com', '1234', 'AnguilaPerro', '1');

INSERT INTO `anguilaperro`.`groups` (`name`, `group_state`) VALUES ('Curso PHP', '1');

INSERT INTO `anguilaperro`.`groups_has_users` (`groups_idgroups`, `users_idusers`) VALUES ('1', '1');


INSERT INTO `anguilaperro`.`established_exams` (`ini_date`, `end_date`, `group`, `exam`, `exam_state`) VALUES ('13-11-05', ('13-11-25'), '1', '1', '1');