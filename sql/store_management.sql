CREATE DATABASE store_management CHARACTER SET utf8 COLLATE utf8_general_ci;

USE store_management;

CREATE TABLE stores (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    phone_number VARCHAR(16) NOT NULL,
    address VARCHAR(200) NOT NULL,
    PRIMARY KEY(id)
);

INSERT INTO stores (name, phone_number, address)
VALUES ('Simclix', '352-867-8058', '785 Chardonnay Drive, Ocala, FL');

INSERT INTO stores (name, phone_number, address)
VALUES ('Kitybit', '313-249-3400', '3389 Nash Street, Southfield, MI');

INSERT INTO stores (name, phone_number, address)
VALUES ('Devvour', '484-923-8046', '699 Berkley Street, Fort Washington, PA');

INSERT INTO stores (name, phone_number, address)
VALUES ('Thingwill', '562-670-2815', '1186 Thompson Street, Los Angeles, CA');

INSERT INTO stores (name, phone_number, address)
VALUES ('Matejoy', '920-259-1738', '683 Rockford Mountain Lane, Appleton, WI');

INSERT INTO stores (name, phone_number, address)
VALUES ('Opexactly', '302-316-0786', '1970 Argonne Street, Newark, DE');

INSERT INTO stores (name, phone_number, address)
VALUES ('Fixata', '308-687-5603', '1957 Rollins Road, St Libory, NE');

INSERT INTO stores (name, phone_number, address)
VALUES ('Probay', '917-289-2494', '4076 Turkey Pen Road, New York, NY');

INSERT INTO stores (name, phone_number, address)
VALUES ('Gamrise', '865-262-4548', '3606 Wiseman Street, Atlanta, GA');

INSERT INTO stores (name, phone_number, address)
VALUES ('Nothers', '208-893-0676', '563 Modoc Alley, Meridian, ID');

CREATE TABLE products (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    store_id INT UNSIGNED NOT NULL,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    quantity INT UNSIGNED NOT NULL,
    PRIMARY KEY(id),
    CONSTRAINT fk_products_store_id_stores_id
    FOREIGN KEY(store_id) REFERENCES stores(id)
);

INSERT INTO products (store_id, name, price, quantity)
VALUES (1, 'AMD Ryzen 7 3700X', 273.00, 25);

INSERT INTO products (store_id, name, price, quantity)
VALUES (2, 'Redragon K552', 39.99, 32);

INSERT INTO products (store_id, name, price, quantity)
VALUES (3, 'Logitech G600', 42.99, 38);

INSERT INTO products (store_id, name, price, quantity)
VALUES (4, 'TP-Link AC1900', 89.99, 46);

INSERT INTO products (store_id, name, price, quantity)
VALUES (5, 'Gigabyte GeForce GTX 1660 OC', 229.99, 27);

INSERT INTO products (store_id, name, price, quantity)
VALUES (6, 'Corsair Vengeance RGB PRO', 84.99, 51);

INSERT INTO products (store_id, name, price, quantity)
VALUES (7, 'MSI Z390-A PRO LGA1151', 199.00, 29);

INSERT INTO products (store_id, name, price, quantity)
VALUES (8, 'EVGA 750 BQ', 109.99, 35);

INSERT INTO products (store_id, name, price, quantity)
VALUES (9, 'Acer SB220Q bi 21.5', 83.01, 20);

INSERT INTO products (store_id, name, price, quantity)
VALUES (10, 'Samsung 860 QVO', 109.99, 44);

CREATE TABLE users (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(200) NOT NULL,
    email VARCHAR(200) UNIQUE NOT NULL,
    password VARCHAR(200) NOT NULL,
    PRIMARY KEY(id)
);

INSERT INTO users (name, email, password)
VALUES ('William Mccormick', 'william.mccormick@inlook.com', '$argon2i$v=19$m=65536,t=4,p=1$QXRXVG4zb0FXaWh2azBONA$aVn2pmygmgcft/JiSbkMf7tV7ThTCsYqyl83uXwCbpM');

INSERT INTO users (name, email, password)
VALUES ('Serena Fischer', 'serena_fischer@coldmail.com', '$argon2i$v=19$m=65536,t=4,p=1$UjFwN2lyS09yNWxKWTEzbQ$CEQb4wOR+M3VYBSSP2M+LSWW42WBJ3GCiORph3pqjxM');

CREATE TABLE tokens (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id INT UNSIGNED NOT NULL,
    token VARCHAR(1000) NOT NULL,
    refresh_token VARCHAR(1000) NOT NULL,
    expired_at DATETIME NOT NULL,
    active TINYINT UNSIGNED NOT NULL DEFAULT 1,
    PRIMARY KEY(id),
    CONSTRAINT fk_tokens_user_id_users_id
    FOREIGN KEY(user_id) REFERENCES users(id)
);
