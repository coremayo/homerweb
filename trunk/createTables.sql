SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `cs4911` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `cs4911`;

-- -----------------------------------------------------
-- Table `cs4911`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cs4911`.`user` ;

CREATE  TABLE IF NOT EXISTS `cs4911`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `userEmail` VARCHAR(45) NOT NULL ,
  `userFirstName` VARCHAR(45) NULL ,
  `userLastName` VARCHAR(45) NULL ,
  `userPasswdHash` VARCHAR(40) NOT NULL ,
  `userRegistrationDate` DATE NULL ,
  `userActive` TINYINT(1) NOT NULL DEFAULT true ,
  `userConCodeHash` VARCHAR(40) NULL ,
  `userConCodeExpDate` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cs4911`.`group`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cs4911`.`group` ;

CREATE  TABLE IF NOT EXISTS `cs4911`.`group` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `groupName` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cs4911`.`site`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cs4911`.`site` ;

CREATE  TABLE IF NOT EXISTS `cs4911`.`site` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `siteAdmins` INT NULL ,
  `siteName` VARCHAR(45) NULL ,
  INDEX `fk_site_admins_group` (`siteAdmins` ASC) ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_site_admins_group`
    FOREIGN KEY (`siteAdmins` )
    REFERENCES `cs4911`.`group` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cs4911`.`class`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cs4911`.`class` ;

CREATE  TABLE IF NOT EXISTS `cs4911`.`class` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `classTitle` VARCHAR(45) NULL,
  `classDesc` text NULL,
  `classPrice` float NOT NULL,
  `classSubLength` INT NOT NULL,
--  `classUsers` INT NULL ,
  `classAdmins` INT NULL ,
  `classStartDate` DATE NULL ,
  `classEndDate` DATE NULL ,
  `classSite` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
--  INDEX `fk_class_users_group` (`classUsers` ASC) ,
  INDEX `fk_class_admins_group` (`classAdmins` ASC) ,
  INDEX `fk_class_site` (`classSite` ASC) ,
--  CONSTRAINT `fk_class_users_group`
--    FOREIGN KEY (`classUsers` )
--    REFERENCES `cs4911`.`group` (`id` )
--    ON DELETE NO ACTION
--    ON UPDATE NO ACTION,
  CONSTRAINT `fk_class_admins_group`
    FOREIGN KEY (`classAdmins` )
    REFERENCES `cs4911`.`group` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_class_site`
    FOREIGN KEY (`classSite` )
    REFERENCES `cs4911`.`site` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cs4911`.`group_has_user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cs4911`.`group_has_user` ;

CREATE  TABLE IF NOT EXISTS `cs4911`.`group_has_user` (
  `group_id` INT NOT NULL ,
  `user_id` INT NOT NULL ,
  PRIMARY KEY (`group_id`, `user_id`) ,
  INDEX `fk_group_has_user_group` (`group_id` ASC) ,
  INDEX `fk_group_has_user_user` (`user_id` ASC) ,
  CONSTRAINT `fk_group_has_user_group`
    FOREIGN KEY (`group_id` )
    REFERENCES `cs4911`.`group` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_group_has_user_user`
    FOREIGN KEY (`user_id` )
    REFERENCES `cs4911`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cs4911`.`lecture`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cs4911`.`lecture` ;

CREATE  TABLE IF NOT EXISTS `cs4911`.`lecture` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `lectureTopic` VARCHAR(60) NULL ,
  `lectureClass` INT NOT NULL ,
  `lectureStartTime` DATETIME NULL ,
  `lectureEndTime` DATETIME NULL ,
  `lectureAdmin` INT NULL ,
  `eventType` ENUM('Lecture', 'Other') DEFAULT 'Lecture',
  PRIMARY KEY (`id`) ,
  INDEX `fk_lecture_class` (`lectureClass` ASC) ,
  INDEX `fk_lecture_user` (`lectureAdmin` ASC) ,
  CONSTRAINT `fk_lecture_class`
    FOREIGN KEY (`lectureClass` )
    REFERENCES `cs4911`.`class` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lecture_user`
    FOREIGN KEY (`lectureAdmin` )
    REFERENCES `cs4911`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cs4911`.`resource`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cs4911`.`resource` ;

CREATE  TABLE IF NOT EXISTS `cs4911`.`resource` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `resourceTitle` VARCHAR(45) NULL ,
  `resourceDescription` TEXT NULL ,
  `resourceLocation` VARCHAR(300) NULL ,
  `resourceType` ENUM('ppt', 'pptx', 'wmv', 'flv', 'doc', 'docx', 'txt', 'pdf', 'url') NULL ,
  `resourceCreatedDate` DATE NULL ,
  `download` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cs4911`.`class_has_resource`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cs4911`.`class_has_resource` ;

CREATE  TABLE IF NOT EXISTS `cs4911`.`class_has_resource` (
  `class_id` INT NOT NULL ,
  `resource_id` INT NOT NULL ,
  PRIMARY KEY (`class_id`, `resource_id`) ,
  INDEX `fk_class_has_resource_class1` (`class_id` ASC) ,
  INDEX `fk_class_has_resource_resource1` (`resource_id` ASC) ,
  CONSTRAINT `fk_class_has_resource_class1`
    FOREIGN KEY (`class_id` )
    REFERENCES `cs4911`.`class` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_class_has_resource_resource1`
    FOREIGN KEY (`resource_id` )
    REFERENCES `cs4911`.`resource` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cs4911`.`lecture_has_resource`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cs4911`.`lecture_has_resource` ;

CREATE  TABLE IF NOT EXISTS `cs4911`.`lecture_has_resource` (
  `lecture_id` INT NOT NULL ,
  `resource_id` INT NOT NULL ,
  PRIMARY KEY (`lecture_id`, `resource_id`) ,
  INDEX `fk_lecture_has_resource_lecture1` (`lecture_id` ASC) ,
  INDEX `fk_lecture_has_resource_resource1` (`resource_id` ASC) ,
  CONSTRAINT `fk_lecture_has_resource_lecture1`
    FOREIGN KEY (`lecture_id` )
    REFERENCES `cs4911`.`lecture` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lecture_has_resource_resource1`
    FOREIGN KEY (`resource_id` )
    REFERENCES `cs4911`.`resource` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cs4911`.`tag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cs4911`.`tag` ;

CREATE  TABLE IF NOT EXISTS `cs4911`.`tag` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `tagName` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cs4911`.`resource_has_tag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cs4911`.`resource_has_tag` ;

CREATE  TABLE IF NOT EXISTS `cs4911`.`resource_has_tag` (
  `resource_id` INT NOT NULL ,
  `tag_id` INT NOT NULL ,
  PRIMARY KEY (`resource_id`, `tag_id`) ,
  INDEX `fk_resource_has_tag_resource1` (`resource_id` ASC) ,
  INDEX `fk_resource_has_tag_tag1` (`tag_id` ASC) ,
  CONSTRAINT `fk_resource_has_tag_resource1`
    FOREIGN KEY (`resource_id` )
    REFERENCES `cs4911`.`resource` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_resource_has_tag_tag1`
    FOREIGN KEY (`tag_id` )
    REFERENCES `cs4911`.`tag` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cs4911`.`class_has_tag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cs4911`.`class_has_tag` ;

CREATE  TABLE IF NOT EXISTS `cs4911`.`class_has_tag` (
  `class_id` INT NOT NULL ,
  `tag_id` INT NOT NULL ,
  PRIMARY KEY (`class_id`, `tag_id`) ,
  INDEX `fk_class_has_tag_class1` (`class_id` ASC) ,
  INDEX `fk_class_has_tag_tag1` (`tag_id` ASC) ,
  CONSTRAINT `fk_class_has_tag_class1`
    FOREIGN KEY (`class_id` )
    REFERENCES `cs4911`.`class` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_class_has_tag_tag1`
    FOREIGN KEY (`tag_id` )
    REFERENCES `cs4911`.`tag` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cs4911`.`lecture_has_tag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cs4911`.`lecture_has_tag` ;

CREATE  TABLE IF NOT EXISTS `cs4911`.`lecture_has_tag` (
  `lecture_id` INT NOT NULL ,
  `tag_id` INT NOT NULL ,
  PRIMARY KEY (`lecture_id`, `tag_id`) ,
  INDEX `fk_lecture_has_tag_lecture1` (`lecture_id` ASC) ,
  INDEX `fk_lecture_has_tag_tag1` (`tag_id` ASC) ,
  CONSTRAINT `fk_lecture_has_tag_lecture1`
    FOREIGN KEY (`lecture_id` )
    REFERENCES `cs4911`.`lecture` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lecture_has_tag_tag1`
    FOREIGN KEY (`tag_id` )
    REFERENCES `cs4911`.`tag` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cs4911`.`subscription`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cs4911`.`subscription` ;

CREATE  TABLE IF NOT EXISTS `cs4911`.`subscription` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `subscriptionStartDate` DATE NOT NULL ,
  `subscriptionEndDate` DATE NOT NULL ,
  `subscriptionClass` INT NOT NULL ,
  `subscriptionUser` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_subscription_class` (`subscriptionClass` ASC) ,
  INDEX `fk_subscription_user` (`subscriptionUser` ASC) ,
  CONSTRAINT `fk_subscription_class`
    FOREIGN KEY (`subscriptionClass` )
    REFERENCES `cs4911`.`class` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_subscription_user`
    FOREIGN KEY (`subscriptionUser` )
    REFERENCES `cs4911`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cs4911`.`announcement`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cs4911`.`announcement` ;

CREATE  TABLE IF NOT EXISTS `cs4911`.`announcement` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `announcementCreatedDate` DATE NULL ,
  `announcementTitle` VARCHAR(60) NOT NULL ,
  `announcementMessage` VARCHAR(150) NOT NULL ,
  `announcementFrom` INT NULL ,
  `announcementClass` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_announcement_user` (`announcementFrom` ASC) ,
  INDEX `fk_announcement_class` (`announcementClass` ASC) ,
  CONSTRAINT `fk_announcement_user`
    FOREIGN KEY (`announcementFrom` )
    REFERENCES `cs4911`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_announcement_class`
    FOREIGN KEY (`announcementClass` )
    REFERENCES `cs4911`.`class` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cs4911`.`payment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cs4911`.`payment` ;

CREATE TABLE IF NOT EXISTS `cs4911`.`payment` (
    `id` INT NOT NULL AUTO_INCREMENT ,
    `txn_id` VARCHAR(45) ,
    `item_number` INT ,
    `mc_gross` DECIMAL(9,2) ,
    `mc_currency` VARCHAR(45) ,
    `payer_email` VARCHAR(45) ,
    `payment_date` DATETIME ,
    `paypalVerified` ENUM('Y', 'N') ,
    `autoApproved` ENUM('Y', 'N') ,
    `paymentUser` INT ,
    PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cs4911`.`settings`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cs4911`.`settings` ;

CREATE TABLE IF NOT EXISTS `cs4911`.`settings` (
    `id` INT NOT NULL AUTO_INCREMENT ,
    `key` VARCHAR(45) NOT NULL UNIQUE ,
    `value` VARCHAR (500) ,
    PRIMARY KEY (`id`) )
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
