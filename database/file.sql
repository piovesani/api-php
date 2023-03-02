create database devsnotes;

use devsnotes;

create table notes(
id int not null auto_increment primary key,
title varchar(100) not null,
body varchar(200) not null);

INSERT INTO notes (title, body)
VALUES ('testando', '123');


select * from notes;