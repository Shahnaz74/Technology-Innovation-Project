
-- Create database
CREATE DATABASE document_management;
USE document_management;


-- Create table
CREATE TABLE admin_user (
  id int(11) NOT NULL AUTO_INCREMENT,
  email char(50) NOT NULL,
  first_name char(50) NOT NULL,
  last_name char(50) NOT NULL,
  password char(20) NOT NULL,
  created timestamp NOT NULL DEFAULT current_timestamp(),
  updated timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (id)
);

CREATE TABLE template (
  template_id int(11) NOT NULL AUTO_INCREMENT,
  template_name char(50) NOT NULL,
  template_icon char(50) DEFAULT NULL,
  created timestamp NOT NULL DEFAULT current_timestamp(),
  updated timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (template_id)
);

CREATE TABLE fields (
  id int(11) NOT NULL AUTO_INCREMENT,
  type char(50) NOT NULL,
  title char(50) NOT NULL,
  name char(50) NOT NULL,
  placeholder char(50) NOT NULL,
  is_required boolean NOT NULL,
  template_id int(11) NOT NULL,
  created timestamp NOT NULL DEFAULT current_timestamp(),
  updated timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (id),
  FOREIGN KEY (template_id) REFERENCES template(template_id)
);

CREATE TABLE upload_status (
  id int(11) NOT NULL,
  name char(50) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE user_uploads (
  id int(11) NOT NULL AUTO_INCREMENT,
  file_name char(50) NOT NULL,
  document_type char(50) NOT NULL,
  file char(50) NOT NULL,
  field1 char(200) DEFAULT NULL,
  field2 char(200) DEFAULT NULL,
  field3 char(200) DEFAULT NULL,
  field4 char(200) DEFAULT NULL,
  field5 char(200) DEFAULT NULL,
  field6 char(200) DEFAULT NULL,
  field7 char(200) DEFAULT NULL,
  field8 char(200) DEFAULT NULL,
  field9 char(200) DEFAULT NULL,
  field10 char(200) DEFAULT NULL,
  first_name char(50) NOT NULL,
  last_name char(50) NOT NULL,
  email char(50) NOT NULL,
  upload_status int(11) NOT NULL,
  template_id int(11) NOT NULL,
  created timestamp NOT NULL DEFAULT current_timestamp(),
  updated timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (id),
  FOREIGN KEY (upload_status) REFERENCES upload_status(id),
  FOREIGN KEY (template_id) REFERENCES template(template_id)
);

-- Insert sample data
INSERT INTO upload_status (id, name) VALUES
(1, 'pending'),
(2, 'published'),
(3, 'archived');

INSERT INTO template (template_name, template_icon, created, updated)
VALUES 
('advertisement', NULL, NOW(), NOW()),
('article', NULL, NOW(), NOW()),
('book', NULL, NOW(), NOW()),
('photograph', NULL, NOW(), NOW()),
('sale brochure', NULL, NOW(), NOW()),
('sale record', NULL, NOW(), NOW());

INSERT INTO fields (type, title, name, placeholder, is_required, template_id) VALUES
('text', 'Contributor', 'contributor', 'Enter the name of the contributor', 0, 1),
('text', 'Contributor', 'contributor', 'Enter the name of the contributor', 0, 2),
('text', 'Contributor', 'contributor', 'Enter the name of the contributor', 0, 3),
('text', 'Contributor', 'contributor', 'Enter the name of the contributor', 0, 4),
('text', 'Coverage', 'coverage', 'Enter the spatial or temporal topic of the resource', 0, 1),
('text', 'Creator', 'creator', 'Enter the name of the creator', 1, 2),
('date', 'Date', 'date', 'Enter the date associated with the resource', 1, 2),
('textarea', 'Description', 'description', 'Enter an account of the resource', 1, 2),
('text', 'Format', 'format', 'Enter the file format or physical medium of the resource', 0, 3),
('text', 'Identifier', 'identifier', 'Enter an unambiguous reference to the resource', 1, 3),
('text', 'Language', 'language', 'Enter the language of the resource', 1, 3),
('text', 'Publisher', 'publisher', 'Enter the name of the publisher', 1, 4),
('text', 'Relation', 'relation', 'Enter a related resource', 0, 4),
('textarea', 'Rights', 'rights', 'Enter information about rights held in and over the resource', 0, 5),
('text', 'Source', 'source', 'Enter a related resource from which the described resource is derived', 0, 5),
('text', 'Subject', 'subject', 'Enter the topic of the resource', 1, 6),
('text', 'Title', 'title', 'Enter a name given to the resource', 1, 6),
('text', 'Type', 'type', 'Enter the nature or genre of the resource', 1, 6);


INSERT INTO admin_user (email, first_name, last_name, password, created, updated)
VALUES 
('lam@example.com', 'Lam', 'Pham', '123456', NOW(), NOW()),
('shahnaz@example.com', 'Shahnaz', 'Akter', '654321', NOW(), NOW()),
('derek@example.com', 'Derek', 'Chan', '567890', NOW(), NOW()),
('beryl@example.com', 'Hiu', 'Leung', '098765', NOW(), NOW());

--NSERT INTO user_uploads (file_name, document_type, file, field1, field2, field3, field4, field5, field6, field7, field8, field9, field10, first_name, last_name, email, upload_status, template_id, created, updated)
--VALUES 
