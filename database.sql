CREATE TABLE IF NOT EXISTS users(ID integer PRIMARY KEY NOT NULL AUTO_INCREMENT, Username varchar(20), Password TEXT);

CREATE TABLE IF NOT EXISTS uploads(ID integer PRIMARY KEY NOT NULL AUTO_INCREMENT, user TEXT, url TEXT, CreatedAt datetime NOT NULL DEFAULT CURRENT_TIMESTAMP);

-- INSERT INTO uploads(user, name, url, CreatedAt) VALUES('Anthonym', 'test', 'thebest.pdf', '02/02/25');
