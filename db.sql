CREATE SCHEMA `tweet` DEFAULT CHARACTER SET utf8 ;

CREATE TABLE `tweet` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `created_at` VARCHAR(45) NULL,
  `retweet_count` INT NULL,
  `user` VARCHAR(256) NULL,
  `text` TEXT NULL,
  `id_str` VARCHAR(256) NULL,
  PRIMARY KEY (`id`));

  ALTER TABLE `tweet`
  ADD INDEX `user` (`id_str` ASC);

  ALTER TABLE `tweet`
  ADD COLUMN `hashtag` INT NULL AFTER `id_str`,
  ADD INDEX `hashtag_idx` (`hashtag` ASC);
  ALTER TABLE `tweet`
  ADD CONSTRAINT `hashtag`
  FOREIGN KEY (`hashtag`)
  REFERENCES `hashtag` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

  CREATE TABLE `hashtag` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `hashtag` VARCHAR(145) NULL,
    PRIMARY KEY (`id`));

    ALTER TABLE `hashtag`
    ADD INDEX `hashtag` (`hashtag` ASC);
