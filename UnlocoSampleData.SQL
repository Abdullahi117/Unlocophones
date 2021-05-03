INSERT INTO customer (first_name, last_name, address, city, state, zip, phone, email, credit_card, shipping_address, shipping_city, shipping_state, shipping_zip)
VALUES ('John','Doe', '123 Test Street', 'Woodbury', 'MN', '55125', '1234567890', 'John.Doe@Test.com', '1234567890123456', '789 Test Ave', 'Hudson', 'WI', '54016');

INSERT INTO customer (first_name, last_name, address, city, state, zip, phone, email, credit_card, shipping_address, shipping_city, shipping_state, shipping_zip)
VALUES ('Mark','Basic', '555 Avenue Street', 'Maplewood', 'MN', '55119', '6513871234', 'Mark.Basic@Test.com', '0000111122223333', '500 Home Ave', 'Saint Paul', 'MN', '55104');
SELECT * FROM customer;


INSERT INTO payment (payment_type, allowed)
VALUES ('Credit', '1');
SELECT * FROM payment;



INSERT INTO shipment (company_name, company_phone)
VALUES ('Metrostate','1234567890');
SELECT * FROM shipment;



INSERT INTO orders (customer_id, payment_id, shipment_id, order_date, shipment_date, status)
VALUES (1,1,1,  NOW(),'4/11/21','1');
SELECT * FROM orders;


INSERT INTO brands (brand_id, brand_name, brand_description, brand_pictures)
VALUES ('1', 'Samsung','Samsung Description', NULL);
INSERT INTO brands (brand_id, brand_name, brand_description, brand_pictures)
VALUES ('3', 'Google','Google Description', NULL);
SELECT * FROM brands;


INSERT INTO suppliers (supplier_name, address, phone, product_types, payment_details)
VALUES ('Phones.com', '512 Industrial Ave City of Industry, CA 91745', '5551235555', 'Phones', 'WIRE');
SELECT * FROM suppliers;


INSERT INTO warranties (damagescovered, timeperiod)
VALUES ('1', '12');
INSERT INTO warranties (damagescovered, timeperiod)
VALUES ('0', '18');
SELECT * FROM warranties;


INSERT INTO products (brand_id, warranty_id, supplier_id, name, year_made, type, colors, carriers, price, warranty)
VALUES ('1', '2', '1', 'Samsung Galaxy S20', '2020', 'Phone', 'Silver, Black', 'T-Mobile', '500.00', '1'), 
('1', '2', '1', 'Samsung Galaxy Note 2021', '2021', 'Note', 'Gold, Silver', 'Verizon', '500.00', '1'), 
('1', '2', '1', 'Samsung Galaxy Note 2020', '2020', 'Note', 'Pink, White', 'Sprint', '500.00', '1'), 
('1', '2', '1', 'Samsung Galaxy S21 Ultra 5G', '2021', 'Phone', 'Emerald, Black', 'T-Mobile', '500.00', '1'), 
('1', '2', '1', 'Samsung Galaxy S21+ 5G', '2021', 'Phone', 'Silver, Blue', 'Sprint', '500.00', '1'), 
('1', '2', '1', 'Samsung Galaxy', '2020', 'Phone', 'White, Black', 'Verizon', '500.00', '1'),
('2', '1', '1', 'iPhone 12 Mini', '2020', 'Phone', 'White, Black', 'Sprint', '500.00', '1'), 
('2', '1', '1', 'iPhone 11 Grey', '2020', 'Phone', 'Grey, Black', 'Verizon', '500.00', '1'), 
('2', '1', '1', 'iPhone 12 Pro Max', '2021', 'Phone', 'Gold, Grey', 'Sprint', '500.00', '1'), 
('2', '1', '1', 'iPhone 11', '2020', 'Phone', 'White, Black', 'Sprint', '500.00', '1'), 
('2', '1', '1', 'iPhone XR', '2020', 'Phone', 'White, Gold', 'Verizon', '500.00', '1'), 
('2', '1', '1', 'iPhone X', '2020', 'Phone', 'Pink, Black', 'Sprint', '500.00', '1'), 
('3', '2', '1', 'Google Pixel 4a', '2020', 'Phone', 'Black', 'Verizon, GoogleFi', '500.00', '1'), 
('3', '1', '1', 'Google Pixel 4', '2020', 'Phone', 'Grey', 'Verizon, GoogleFi', '500.00', '1'), 
('3', '2', '1', 'Google Pixel 5', '2020', 'Phone', 'Gold', 'Sprint, GoogleFi', '500.00', '1');

SELECT * FROM products;
('3', '1', '1', 'Google Pixel 4a', '2020', 'Phone', 'Black', 'Verizon, GoogleFi', '500.00', '1')


INSERT INTO orderdetails (order_id, product_id, quantity, discount, color, total)
VALUES (1,5, '1', '0', 'Black', '500.00');
SELECT * FROM orderdetails;


SELECT * FROM customer;
SELECT * FROM payment;
SELECT * FROM shipment;
SELECT * FROM orders;
SELECT * FROM brands;
SELECT * FROM suppliers;
SELECT * FROM warranties;
SELECT * FROM products;
SELECT * FROM orderdetails;

