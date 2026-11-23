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

create table products (
		product_id INT auto_increment primary key,
		user_id INT not null,
		name VARCHAR(255) not null,
		description TEXT,
		price DECIMAL(10, 2) not null check (price >= 0),
		image_url VARCHAR(255) not null,
		created_at TIMESTAMP default CURRENT_TIMESTAMP(),
		
		foreign key (user_id) references users(user_id)
);

create table cart_items (
		user_id INT not null,
		product_id INT not null,
		quantity INT not null default 1,
		check (quantity > 0),
		
		
		primary key (user_id, product_id),
		foreign key (user_id) references users(user_id),
		foreign key (product_id) references products(product_id)
);