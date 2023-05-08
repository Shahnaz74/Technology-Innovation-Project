
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
  upload_id int(11) NOT NULL AUTO_INCREMENT,
  file_name char(50) NOT NULL,
  file char(50) NOT NULL,
  contributor char(200) DEFAULT NULL,
  coverage char(200) DEFAULT NULL,
  creator char(200) DEFAULT NULL,
  date date DEFAULT NULL,
  description char(200) DEFAULT NULL,
  format char(200) DEFAULT NULL,
  identifier char(200) DEFAULT NULL,
  language char(200) DEFAULT NULL,
  publisher char(200) DEFAULT NULL,
  relation char(200) DEFAULT NULL,
  rights char(200) DEFAULT NULL,
  source char(200) DEFAULT NULL,
  title char(200) DEFAULT NULL,
  first_name char(50) NOT NULL,
  last_name char(50) NOT NULL,
  email char(50) NOT NULL,
  upload_status int(11) NOT NULL,
  template_id int(11) NOT NULL,
  created timestamp NOT NULL DEFAULT current_timestamp(),
  updated timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (upload_id),
  FOREIGN KEY (upload_status) REFERENCES upload_status(id),
  FOREIGN KEY (template_id) REFERENCES template(template_id)
);

CREATE TABLE keyword (
  id int(11) NOT NULL AUTO_INCREMENT,
  keyword char(50) NOT NULL,
  upload_id int(11) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (upload_id) REFERENCES user_uploads(upload_id)
);

-- Insert sample data
-- Insert data into upload_status table
INSERT INTO upload_status (id, name) VALUES
(1, 'pending'),
(2, 'published'),
(3, 'archived');

-- Insert data into template table
INSERT INTO template (template_name, template_icon, created, updated)
VALUES 
('Advertisement Journal', NULL, NOW(), NOW()),
('Advertisement Newspaper', NULL, NOW(), NOW()),
('Article Journal', NULL, NOW(), NOW()),
('Article Newspaper', NULL, NOW(), NOW()),
('Book Historical', NULL, NOW(), NOW()),
('Book Technical', NULL, NOW(), NOW()),
('Photograph Commercial', NULL, NOW(), NOW()),
('Photograph Personal', NULL, NOW(), NOW()),
('Sales Brochure', NULL, NOW(), NOW()),
('Sales Record', NULL, NOW(), NOW());

-- Insert data into fields table
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

-- Insert data into admin_user table
INSERT INTO admin_user (email, first_name, last_name, password, created, updated)
VALUES 
('lam@example.com', 'Lam', 'Pham', '123456', NOW(), NOW()),
('shahnaz@example.com', 'Shahnaz', 'Akter', '654321', NOW(), NOW()),
('derek@example.com', 'Derek', 'Chan', '567890', NOW(), NOW()),
('beryl@example.com', 'Hiu', 'Leung', '098765', NOW(), NOW());

-- Insert data into user_uploads table
INSERT INTO user_uploads 
(file_name, file, contributor, coverage, creator, date, description, format, identifier, language, publisher, relation, rights, source, title, first_name, last_name, email, upload_status, template_id) 
VALUES 
('sample_file1', 'path/to/sample_file.pdf', 'Harry Potter', NULL, 'Harry Potter', '2022-01-01', NULL, 'PDF', '12345', 'English', 'Random Publishing', NULL, 'All Rights Reserved', 'https://example.com', 'Sample File', 'Harry', 'Potter', 'harry@example.com', 1, 1),
('sample_file2', 'path/to/sample_file.pdf', NULL, NULL, NULL, NULL, NULL, 'PDF', '12345', 'Mandarin', 'Random Publishing', NULL, 'All Rights Reserved', NULL, 'Sample File', 'Creator2', 'Creator2', 'creator2@example.com', 1, 2),
('sample_file3', 'path/to/sample_file.pdf', 'Contributor3', NULL, NULL, NULL, NULL, 'PDF', '12345', NULL, NULL, NULL, 'All Rights Reserved', NULL, 'Sample File', 'Creator3', 'Creator3', 'harry@example.com', 2, 3);

-- Insert data into keyword table
INSERT INTO keyword (keyword, upload_id)
VALUES ('keyword1', 1),
       ('keyword2', 1),
       ('keyword3', 1),
       ('keyword4', 2),
       ('keyword1', 2),
       ('keyword2', 2),
       ('keyword5', 3),
       ('keyword4', 3),
       ('keyword2', 3);
