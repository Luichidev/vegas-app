CREATE DATABASE `vegas_db` DEFAULT CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;

CREATE TABLE `users`(
  `userid` INT PRIMARY KEY AUTO_INCREMENT,
  `use_nick` VARCHAR (50) NOT NULL UNIQUE,
  `use_pass` VARCHAR (255) NOT NULL,
  `use_email` VARCHAR (100) NOT NULL UNIQUE,
  `use_balance` DECIMAL (10,2) NOT NULL DEFAULT 0,
  `use_roll` INT (10) NOT NULL DEFAULT 1,
  `use_ts` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `use_modificate` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


INSERT INTO users (use_nick, use_pass, use_email, use_balance, use_roll) VALUES ('luichidev', '$2y$10$TCr410PpO22W8Z.OIpowIOdgxuUVNiwbb.ozdd9MyUZd9QZr1b3HS', 'luichidev@gmail.com', 1000, 10);
-- admin123

CREATE TABLE `invitations`(
  `invitationid` INT PRIMARY KEY AUTO_INCREMENT,
  `inv_title` VARCHAR (50) NOT NULL UNIQUE DEFAULT "",
  `inv_balance` DECIMAL (10,2) NOT NULL DEFAULT 0,
  `inv_roll` INT (10) NOT NULL DEFAULT 1,
  `inv_ts` DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO invitations (inv_title, inv_balance, inv_roll) VALUES ("CASINOPHP", 500, 1);


