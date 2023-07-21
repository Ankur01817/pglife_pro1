CREATE TABLE users(
    id NOT NULL AUTO_INCREMENT,
    full_name VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password varchar(100) NOT NULL,
    college_name VARCHAR(255) NOT NULL,
    gender ENUM('male', 'female') NOT NULL,
    PRIMARY KEY (id)
);
CREATE TABLE cities(
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    PRIMARY KEY(id)
);
CREATE TABLE properties(
    id INT NOT NULL AUTO_INCREMENT,
    citi_id INT NOT NULL,
    name varchar(100) NOT NULL,
    address VARCHAR(255) NOT NULL,
    description LONGTEXT NOT NULL,
    gender ENUM('male', 'female','unisex') NOT NULL,
    rent INT NOT NULL,
    rating_clean float(2,1) NOT NULL,
    rating_food float(2,1) NOT NULL,
    rating_safety float(2,1) NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (citi_id) REFERENCES cities(id)
);

CREATE TABLE amenities (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    type VARCHAR(100) NOT NULL,
    icon VARCHAR(30) NOT NULL,
    PRIMARY KEY(id)
);
CREATE TABLE properties_amenities(
    id INT NOT NULL AUTO_INCREMENT,
    property_id INT NOT NULL,
    amenity_id INT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (property_id) REFERENCES properties(id),
    FOREIGN KEY (amenity_id) REFERENCES amenities(id)

);
CREATE TABLE testimonials(
    id INT NOT NULL AUTO_INCREMENT,
    property_id INT NOT NULL,
    user_name varchar(100) NOT NULL,
    content LONGTEXT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(property_id) REFERENCES properties(id)
);
CREATE TABLE interested_users_properties(
    id INT NOT NULL AUTO_INCREMENT,
    property_id int NOT NULL,
    user_id int NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES users(id),
    FOREIGN KEY(property_id) REFERENCES properties(id)
);