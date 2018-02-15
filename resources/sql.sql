create table users (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name varchar(255) not null UNIQUE,
	balance decimal(15,2) not null default 0,
	password varchar(255) not null
);

create table transactions (
	id integer not null AUTO_INCREMENT primary key,
	user_id int not null,
	amount decimal(15,2) not null,
	created_at TIMESTAMP E not null DEFAULT CURRENT_TIMESTAMP,
	CONSTRAINT FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE
);

insert into users (name, password) values ('user_1', '$2y$10$fs7x9PUep4/Jh7aLli/3q.5Rx8ky1pGOC1S7gRnOyFmwm1LINhMMu'), ('user_2', '$2y$10$fs7x9PUep4/Jh7aLli/3q.5Rx8ky1pGOC1S7gRnOyFmwm1LINhMMu');