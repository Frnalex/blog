ALTER TABLE `comment`
  DROP COLUMN `pseudo`;
ALTER TABLE `comment`
  ADD COLUMN `user_id` int(11) NOT NULL;
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);