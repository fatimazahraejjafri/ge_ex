
-- --------------------------------------------------------
-- Table: filiere
-- --------------------------------------------------------
CREATE TABLE `filiere` (
  `id_filiere` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_filiere`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Add foreign key for users (Assuming users table already exists)
-- --------------------------------------------------------
ALTER TABLE `user`
  ADD COLUMN `id_filiere` INT, -- New foreign key column in 'user' table
  ADD CONSTRAINT `fk_user_filiere`
  FOREIGN KEY (`id_filiere`) REFERENCES `filiere`(`id_filiere`)
  ON DELETE SET NULL
  ON UPDATE CASCADE;

-- --------------------------------------------------------
-- Table: module
-- --------------------------------------------------------
CREATE TABLE `module` (
  `id_module` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `id_filiere` INT NOT NULL,
  PRIMARY KEY (`id_module`),
  CONSTRAINT `fk_module_filiere`
  FOREIGN KEY (`id_filiere`) REFERENCES `filiere`(`id_filiere`)
  ON DELETE CASCADE
  ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table: note
-- --------------------------------------------------------
CREATE TABLE `note` (
  `id_note` INT NOT NULL AUTO_INCREMENT,
  `id_module` INT NOT NULL,
  `id_user` INT NOT NULL,
  `grade` DECIMAL(5,2), -- Assuming grades can have decimals (e.g., 15.50)
  PRIMARY KEY (`id_note`),
  CONSTRAINT `fk_note_module`
  FOREIGN KEY (`id_module`) REFERENCES `module`(`id_module`)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
  CONSTRAINT `fk_note_user`
  FOREIGN KEY (`id_user`) REFERENCES `user`(`id_user`)
  ON DELETE CASCADE
  ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
