
drop table if exists posts;
drop table if exists topics;
drop table if exists categories;
drop table if exists users;

CREATE TABLE posts (
post_id  INT(8) NOT NULL AUTO_INCREMENT,
post_content TEXT NOT NULL,
post_date DATETIME NOT NULL,
post_topic INT(8) NOT NULL,
post_by INT(8) NOT NULL,
PRIMARY KEY (post_id)
) TYPE=INNODB;

CREATE TABLE topics (
topic_id INT(8) NOT NULL AUTO_INCREMENT,
topic_subject VARCHAR(255) NOT NULL,
topic_date DATETIME NOT NULL,
topic_cat INT(8) NOT NULL,
topic_by INT(8) NOT NULL,
PRIMARY KEY (topic_id)
) TYPE=INNODB;

CREATE TABLE categories (
cat_id INT(8) NOT NULL AUTO_INCREMENT,
cat_name VARCHAR(255) NOT NULL,
cat_description VARCHAR(255) NOT NULL,
UNIQUE INDEX cat_name_unique (cat_name),
PRIMARY KEY (cat_id)
) TYPE=INNODB;

create table users(
user_id integer(8) not null AUTO_INCREMENT,
user_name varchar(30) not null,
user_pass varchar(255) not null,
user_email varchar(255) not null,
user_date datetime not null,
user_level integer(8) not null,
UNIQUE INDEX user_name_unique(user_name),
primary key(user_id))TYPE=INNODB;

ALTER TABLE posts ADD FOREIGN KEY(post_topic) REFERENCES topics(topic_id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE posts ADD FOREIGN KEY(post_by) REFERENCES users(user_id) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE topics ADD FOREIGN KEY(topic_cat) REFERENCES categories(cat_id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE topics ADD FOREIGN KEY(topic_by) REFERENCES users(user_id) ON DELETE RESTRICT ON UPDATE CASCADE;

INSERT into users values(1,'Beatrizx','1c29cf0ceb89afce131e27b76c18af1e9cf7f5e3','beatriz_luisa@hotmail.com',NOW(),1);