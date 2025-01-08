drop table if exists users;
create table users (
	id INT primary key not null auto_increment,
    username char(40) NOT NULL UNIQUE,
    password char(60) NOT NULL
);

drop table if exists companies;
create table companies (
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(40)
);

drop table if exists employees;
create table employees (
	company_id INT,
    user_id INT,
    name VARCHAR(50),
    cpf VARCHAR(11),
    rg VARCHAR(20),
    email VARCHAR(30),
    FOREIGN KEY (company_id) REFERENCES companies(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);