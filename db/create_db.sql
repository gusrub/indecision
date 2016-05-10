-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema indecision_maker
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `indecision_maker` ;

-- -----------------------------------------------------
-- Schema indecision_maker
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `indecision_maker` DEFAULT CHARACTER SET utf8 ;
USE `indecision_maker` ;

-- -----------------------------------------------------
-- Table `indecision_maker`.`countries`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `indecision_maker`.`countries` ;

CREATE TABLE IF NOT EXISTS `indecision_maker`.`countries` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NOT NULL,
  `code` VARCHAR(3) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC),
  UNIQUE INDEX `code_UNIQUE` (`code` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `indecision_maker`.`states`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `indecision_maker`.`states` ;

CREATE TABLE IF NOT EXISTS `indecision_maker`.`states` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NOT NULL,
  `country_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_states_countries_idx` (`country_id` ASC),
  CONSTRAINT `fk_states_countries`
    FOREIGN KEY (`country_id`)
    REFERENCES `indecision_maker`.`countries` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `indecision_maker`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `indecision_maker`.`users` ;

CREATE TABLE IF NOT EXISTS `indecision_maker`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(150) NOT NULL,
  `last_name` VARCHAR(150) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `state_id` INT NOT NULL,
  `city` VARCHAR(150) NOT NULL,
  `role` ENUM('ADMIN', 'NORMAL') NOT NULL DEFAULT 'NORMAL',
  `password_reset_token` VARCHAR(50) NULL,
  `password_reset_expiration` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  INDEX `fk_users_states_idx` (`state_id` ASC),
  UNIQUE INDEX `password_reset_token_UNIQUE` (`password_reset_token` ASC),
  CONSTRAINT `fk_users_states`
    FOREIGN KEY (`state_id`)
    REFERENCES `indecision_maker`.`states` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `indecision_maker`.`places`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `indecision_maker`.`places` ;

CREATE TABLE IF NOT EXISTS `indecision_maker`.`places` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` TEXT NOT NULL,
  `address` TEXT NOT NULL,
  `google_place_id` VARCHAR(255) NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_places_users_idx` (`user_id` ASC),
  CONSTRAINT `fk_places_users`
    FOREIGN KEY (`user_id`)
    REFERENCES `indecision_maker`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SET SQL_MODE = '';
GRANT USAGE ON *.* TO indecision_maker_user;
 DROP USER indecision_maker_user;
SET SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';
CREATE USER 'indecision_maker_user' IDENTIFIED BY 'Str0ngP4ss@tij!';

GRANT SELECT, INSERT, TRIGGER ON TABLE `indecision_maker`.* TO 'indecision_maker_user';
GRANT SELECT, INSERT, TRIGGER, UPDATE, DELETE ON TABLE `indecision_maker`.* TO 'indecision_maker_user';

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `indecision_maker`.`countries`
-- -----------------------------------------------------
START TRANSACTION;
USE `indecision_maker`;
INSERT INTO `indecision_maker`.`countries` (`id`, `name`, `code`) VALUES (DEFAULT, 'United States', 'USA');
INSERT INTO `indecision_maker`.`countries` (`id`, `name`, `code`) VALUES (DEFAULT, 'Mexico', 'MEX');
INSERT INTO `indecision_maker`.`countries` (`id`, `name`, `code`) VALUES (DEFAULT, 'Canada', 'CAN');

COMMIT;


-- -----------------------------------------------------
-- Data for table `indecision_maker`.`states`
-- -----------------------------------------------------
START TRANSACTION;
USE `indecision_maker`;
INSERT INTO `indecision_maker`.`states` (`id`, `name`, `country_id`) VALUES (DEFAULT, 'California', 1);
INSERT INTO `indecision_maker`.`states` (`id`, `name`, `country_id`) VALUES (DEFAULT, 'Arizona', 1);
INSERT INTO `indecision_maker`.`states` (`id`, `name`, `country_id`) VALUES (DEFAULT, 'Nevada', 1);
INSERT INTO `indecision_maker`.`states` (`id`, `name`, `country_id`) VALUES (DEFAULT, 'Texas', 1);
INSERT INTO `indecision_maker`.`states` (`id`, `name`, `country_id`) VALUES (DEFAULT, 'Baja California', 2);
INSERT INTO `indecision_maker`.`states` (`id`, `name`, `country_id`) VALUES (DEFAULT, 'Sonora', 2);
INSERT INTO `indecision_maker`.`states` (`id`, `name`, `country_id`) VALUES (DEFAULT, 'Alberta', 3);
INSERT INTO `indecision_maker`.`states` (`id`, `name`, `country_id`) VALUES (DEFAULT, 'Quebec', 3);

COMMIT;


-- -----------------------------------------------------
-- Data for table `indecision_maker`.`users`
-- -----------------------------------------------------
START TRANSACTION;
USE `indecision_maker`;
INSERT INTO `indecision_maker`.`users` (`id`, `first_name`, `last_name`, `email`, `password`, `state_id`, `city`, `role`, `password_reset_token`, `password_reset_expiration`) VALUES (DEFAULT, 'Gustavo', 'Rubio', 'gus@ahivamos.net', '$2y$10$iVnV8QgouC2Vrvrve0buKODGkbuANo8302uHlkYvbee9z.lsAr0Y.', 5, 'Tijuana', 'ADMIN', NULL, NULL);
INSERT INTO `indecision_maker`.`users` (`id`, `first_name`, `last_name`, `email`, `password`, `state_id`, `city`, `role`, `password_reset_token`, `password_reset_expiration`) VALUES (DEFAULT, 'John', 'Wayne', 'john@example.com', '$2y$10$iVnV8QgouC2Vrvrve0buKODGkbuANo8302uHlkYvbee9z.lsAr0Y.', 1, 'San Diego', 'NORMAL', NULL, NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `indecision_maker`.`places`
-- -----------------------------------------------------
START TRANSACTION;
USE `indecision_maker`;
INSERT INTO `indecision_maker`.`places` (`id`, `name`, `address`, `google_place_id`, `user_id`) VALUES (DEFAULT, 'Sonata Services MX', 'Blvrd Gustavo Díaz Ordaz 12415, El Paraiso, 22106 Tijuana, B.C., Mexico', 'ChIJxSgLB0RI2YARzgcwNsxk2uE', 1);
INSERT INTO `indecision_maker`.`places` (`id`, `name`, `address`, `google_place_id`, `user_id`) VALUES (DEFAULT, 'FortuneBuilders, Inc', '960 Grand Ave, San Diego, CA 92109, United States', 'ChIJH_oy8ewB3IAR9k9dBOsRZXA', 2);
INSERT INTO `indecision_maker`.`places` (`id`, `name`, `address`, `google_place_id`, `user_id`) VALUES (DEFAULT, 'Caesar\'s Restaurant-Bar', 'Av. Revolución 1059, Zona Centro, 22000 Tijuana, B.C., Mexico', 'ChIJYYQENqpJ2YARDl5QUJV_zUg\\', 1);
INSERT INTO `indecision_maker`.`places` (`id`, `name`, `address`, `google_place_id`, `user_id`) VALUES (DEFAULT, 'La Cabaña Del Abuelo', 'Carretera Mexicali-Tecate Km. 71.5, 21505 La Rumorosa, B.C., Mexico', 'ChIJd8sROcC32YARVm0ZMWyjW4o', 1);
INSERT INTO `indecision_maker`.`places` (`id`, `name`, `address`, `google_place_id`, `user_id`) VALUES (DEFAULT, 'Buca di Beppo - San Diego', '705 Sixth Ave, San Diego, CA 92101, United States', 'ChIJu5QhVFhT2YAR--UiSXXY_rY', 1);

COMMIT;

