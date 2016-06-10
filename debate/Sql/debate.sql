create database debate;

use debate;

create table user( 
	username varchar(16) not null primary key,
	passwd char(40) not null,
	email varchar(100) not null 
);

create table header(
	parent int not null,
	poster char(16) not null ,
	title char(20) not null,
	children int default 0 not null,
	area int default 1 not null,
	posted datetime not null,
	postid int unsigned not null auto_increment primary key,
	foreign key(poster) references user(username) on update cascade
);

create table body(
	postid int unsigned not null primary key,
	message text
);

grant select, delete, insert, update
on debate.*
to debate@localhost identified by 'debate';
