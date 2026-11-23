create database if not exists olde_catalog;

use olde_catalog;

create table users (
        user_id INT auto_increment primary key,
        username VARCHAR(24) not null unique,
        email VARCHAR(255) not null unique,
        password_hash VARCHAR(255) not null,
        phone VARCHAR(30),
        country CHAR(2) not null default 'US',
        state CHAR(2) not null,
        address VARCHAR(255),
        created_at TIMESTAMP default CURRENT_TIMESTAMP()
    );