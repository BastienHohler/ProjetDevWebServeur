DROP TABLE IF EXISTS files;

CREATE TABLE files (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, date DATE NOT NULL, extension VARCHAR(255) NOT NULL, metadata VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;
 
DROP TABLE IF EXISTS messages;
    
CREATE TABLE messages (id INT AUTO_INCREMENT NOT NULL, sender_id INT DEFAULT NULL, recipient_id INT DEFAULT NULL, group_id INT DEFAULT NULL, contents VARCHAR(255) NOT NULL, INDEX IDX_DB021E96F624B39D (sender_id), INDEX IDX_DB021E96E92F8F78 (recipient_id), INDEX IDX_DB021E96FE54D947 (group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;
     
DROP TABLE IF EXISTS message_file;

CREATE TABLE message_file (message_id INT NOT NULL, file_id INT NOT NULL, INDEX IDX_250AADC9537A1329 (message_id), INDEX IDX_250AADC993CB796C (file_id), PRIMARY KEY(message_id, file_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;

DROP TABLE IF EXISTS groupParticipants;
     
CREATE TABLE groupParticipants (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, group_id INT DEFAULT NULL, INDEX IDX_125D0655A76ED395 (user_id), INDEX IDX_125D0655FE54D947 (group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;

DROP TABLE IF EXISTS users;
     
CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, address_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, anonyme TINYINT(1) NOT NULL, etat VARCHAR(255) NOT NULL, latitude DOUBLE PRECISION DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, INDEX IDX_1483A5E9F5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;

DROP TABLE IF EXISTS groups;
     
CREATE TABLE groups (id INT AUTO_INCREMENT NOT NULL, board_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_F06D3970E7EC5785 (board_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;

DROP TABLE IF EXISTS boards;
     
CREATE TABLE boards (id INT AUTO_INCREMENT NOT NULL, group_id INT DEFAULT NULL, contends VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_F3EE4D13FE54D947 (group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;

DROP TABLE IF EXISTS adresses;
     
CREATE TABLE adresses (id INT AUTO_INCREMENT NOT NULL, rue VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, cp VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;

DROP TABLE IF EXISTS friends;
     
CREATE TABLE friends (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, friend_id INT DEFAULT NULL, INDEX IDX_21EE7069A76ED395 (user_id), INDEX IDX_21EE70696A5458E8 (friend_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;

     ALTER TABLE messages ADD CONSTRAINT FK_DB021E96F624B39D FOREIGN KEY (sender_id) REFERENCES users (id) ON DELETE CASCADE;
     ALTER TABLE messages ADD CONSTRAINT FK_DB021E96E92F8F78 FOREIGN KEY (recipient_id) REFERENCES users (id) ON DELETE CASCADE;
     ALTER TABLE messages ADD CONSTRAINT FK_DB021E96FE54D947 FOREIGN KEY (group_id) REFERENCES groups (id) ON DELETE CASCADE;
     ALTER TABLE message_file ADD CONSTRAINT FK_250AADC9537A1329 FOREIGN KEY (message_id) REFERENCES messages (id) ON DELETE CASCADE;
     ALTER TABLE message_file ADD CONSTRAINT FK_250AADC993CB796C FOREIGN KEY (file_id) REFERENCES files (id) ON DELETE CASCADE;
     ALTER TABLE groupParticipants ADD CONSTRAINT FK_125D0655A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE;
     ALTER TABLE groupParticipants ADD CONSTRAINT FK_125D0655FE54D947 FOREIGN KEY (group_id) REFERENCES groups (id) ON DELETE CASCADE;
     ALTER TABLE users ADD CONSTRAINT FK_1483A5E9F5B7AF75 FOREIGN KEY (address_id) REFERENCES adresses (id);
     ALTER TABLE groups ADD CONSTRAINT FK_F06D3970E7EC5785 FOREIGN KEY (board_id) REFERENCES boards (id) ON DELETE CASCADE;
     ALTER TABLE boards ADD CONSTRAINT FK_F3EE4D13FE54D947 FOREIGN KEY (group_id) REFERENCES groups (id);
     ALTER TABLE friends ADD CONSTRAINT FK_21EE7069A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE;
     ALTER TABLE friends ADD CONSTRAINT FK_21EE70696A5458E8 FOREIGN KEY (friend_id) REFERENCES users (id) ON DELETE CASCADE;


INSERT INTO users (nom,prenom,login,password,mail,anonyme,etat,latitude,longitude) VALUES 
('Hohler','Bastien','bastienhohler','$2y$10$pRZxFX0USgIhBnl2LuLVnOexbsVn0vJ/zth9a9RgoUicjdbVVtwgy','bastien.hohler@gmail.com',1,1, 48.692054, 6.184417),
('Porayko','Geoffrey','geoffreyporayko','$2y$10$pRZxFX0USgIhBnl2LuLVnOexbsVn0vJ/zth9a9RgoUicjdbVVtwgy','geoffrey.porayko@gmail.com',0,1, 48.656700, 	6.168300),
('Dupont','Michel','dupontmichel','$2y$10$pRZxFX0USgIhBnl2LuLVnOexbsVn0vJ/zth9a9RgoUicjdbVVtwgy','dupont.michel@gmail.com',0,0,NULL,NULL),
('Denis','Franck','denisfranck','$2y$10$pRZxFX0USgIhBnl2LuLVnOexbsVn0vJ/zth9a9RgoUicjdbVVtwgy','franck.denis@gmail.com',0,0,NULL,NULL);
