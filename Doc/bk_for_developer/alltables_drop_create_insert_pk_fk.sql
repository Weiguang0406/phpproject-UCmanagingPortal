create database if nOT EXiSTS studentms;
use studentms;
SET SQL_SAFE_UPDATES=0;
flush privileges;
drop table if exists studentms.course_enrollment;
drop table if exists studentms.courses;
drop table if exists studentms.teachers;
drop table if EXiSTS studentms.students;
drop table if exists studentms.users;
CREATE TABLE  IF NOT EXISTS studentms.courses (
  course_id varchar(20) PRIMARY KEY,
  course_name VARCHAR(50) NOT NULL,
  credit_hours INT NOT NULL,
  department VARCHAR(50) NOT NULL,
  instructor_name VARCHAR(50) NOT NULL,
  schedule VARCHAR(50) NOT NULL
);

INSERT INTO studentms.courses (course_name,course_id, credit_hours, department, instructor_name, schedule)
VALUES
  ( 'Introduction to Computer Science', 'CSC101', 3, 'Computer Science', 'Dr. Smith', 'MWF 10:00-11:30am'),
  ( 'English Composition I', 'ENG101', 3, 'English', 'Prof. Johnson', 'TTH 1:00-2:30pm'),
  ( 'Calculus I', 'MAT201', 4, 'Mathematics', 'Dr. Lee', 'MWF 9:00-10:30am');

-- Updated the course enrollment course; fixed the foreign key not compatable issue;


CREATE TABLE if not exists studentms.users (
    user_id varchar(20),-- NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(20) ,
    password VARCHAR(255),
    roles varchar(10),
    primary key(user_id)
);
insert into studentms.users(user_id,username,password,roles)
values
(1,'xu','xu','student'),
(2,'huang','huang','student'),
(3,'yang','yang','admin');
select * from users;
-- flush privileges;
-- SET SQL_SAFE_UPDATES = 0;
create table if not exists studentms.students (
 student_id  varchar(20), 
 studentname varchar(200) null default null,
 studentemail varchar(200) null default null,
 studentclass varchar(100) null default null,
 gender varchar(50) null default null,
 dob date null default null,
 fathername varchar(50) nuLL,
 mothername varchar(50) nuLL,
 contactnumber varchar(15) null default null,
 alternatenumber varchar(15) null default null,
 address varchar(200) nuLL,
 username varchar(50) null default null,
 Password varchar(50) null default null,
 imagefilename varchar(200) null default null,
 dateofadmission datetime nuLL ,
 primary key (student_id),
  foreign key (student_id) references users(user_id) 
) ;
-- insert into student (student_id, studentname, studentemail, studentclass, gender, fathername, mothername, contactnumber, alternatenumber, address, username, password, imagefilename) values (1, 'Benita', 'bmendel0@amazonaws.com', 'bmendel0@moonfruit.com', 'nonbinary', 'Benita Trengrove', 'Benita mendel', '6752928337', '7471241116', 'Suite 79', 'bmendel0', '111', null);
-- insert into student (student_id, studentname, studentemail, studentclass, gender, fathername, mothername, contactnumber, alternatenumber, address, username, password, imagefilename) values (2, 'dag', 'ddicty1@wordpress.org', 'ddicty1@hostgator.com', 'male', 'dag Eyres', 'dag dicty', '9802370940', '5991988972', 'Room 913', 'ddicty1', '111', null);
-- insert into student (student_id, studentname, studentemail, studentclass, gender, fathername, mothername, contactnumber, alternatenumber, address, username, password, imagefilename) values (3, 'florella', 'fcrippin2@google.com', 'fcrippin2@wordpress.org', 'female', 'florella Gilfether', 'florella crippin', '9082893450', '6247183402', 'apt 1426', 'fcrippin2', '111', null);
-- insert into student (student_id, studentname, studentemail, studentclass, gender, fathername, mothername, contactnumber, alternatenumber, address, username, password, imagefilename) values (4, 'pris', 'pcrigin3@redcross.org', 'pcrigin3@pinterest.com', 'female', 'pris firsby', 'pris crigin', '5452558446', '9707643969', 'apt 306', 'pcrigin3', '111', null);
-- insert into student (student_id, studentname, studentemail, studentclass, gender, fathername, mothername, contactnumber, alternatenumber, address, username, password, imagefilename) values (5, 'Wylie', 'wgittins4@squarespace.com', 'wgittins4@aol.com', 'male', 'Wylie Wastell', 'Wylie Gittins', '6872613798', '9444455356', '19th floor', 'wgittins4', '111', null);
-- insert into student (student_id, studentname, studentemail, studentclass, gender, fathername, mothername, contactnumber, alternatenumber, address, username, password, imagefilename) values (6, 'aurie', 'ajehan5@harvard.edu', 'ajehan5@blogs.com', 'female', 'aurie de Vaan', 'aurie Jehan', '9715793525', '6709620361', 'Room 661', 'ajehan5', '111', null);
-- insert into student (student_id, studentname, studentemail, studentclass, gender, fathername, mothername, contactnumber, alternatenumber, address, username, password, imagefilename) values (7, 'Rodge', 'rlithgow6@spotify.com', 'rlithgow6@marketwatch.com', 'male', 'Rodge Jakolevitch', 'Rodge Lithgow', '7152489021', '2213048176', 'apt 1377', 'rlithgow6', '111', null);
-- insert into student (student_id, studentname, studentemail, studentclass, gender, fathername, mothername, contactnumber, alternatenumber, address, username, password, imagefilename) values (8, 'Jacenta', 'jscotchmer7@china.com.cn', 'jscotchmer7@mapy.cz', 'female', 'Jacenta dinnington', 'Jacenta Scotchmer', '9801446665', '3171239961', 'Suite 55', 'jscotchmer7', '111', null);
-- insert into student (student_id, studentname, studentemail, studentclass, gender, fathername, mothername, contactnumber, alternatenumber, address, username, password, imagefilename) values (9, 'melessa', 'mmee8@cisco.com', 'mmee8@smh.com.au', 'female', 'melessa Hogbourne', 'melessa mee', '6493194429', '4701346922', 'Room 252', 'mmee8', '111', null);
-- insert into student (student_id, studentname, studentemail, studentclass, gender, fathername, mothername, contactnumber, alternatenumber, address, username, password, imagefilename) values (10, 'Waldemar', 'wcasson9@rakuten.co.jp', 'wcasson9@reuters.com', 'male', 'Waldemar Galletley', 'Waldemar casson', '2526064076', '9289412588', 'PO Box 79063', 'wcasson9', '111', null);

-- fix the table name to match with the created table name with capital letter "S" and combined mulitple inserts into one query;

insert into studentms.students (student_id,studentname, studentemail, studentclass, gender, fathername, mothername, contactnumber, alternatenumber, address, username, password, imagefilename) 
values (1,'Benita', 'bmendel0@amazonaws.com', 'bmendel0@moonfruit.com', 'nonbinary', 'Benita Trengrove', 'Benita mendel', '6752928337', '7471241116', 'Suite 79', 'xu', '111', null),
 
 (2,'dag', 'ddicty1@wordpress.org', 'ddicty1@hostgator.com', 'male', 'dag Eyres', 'dag dicty', '9802370940', '5991988972', 'Room 913', 'huang', '111', null),
 (3,'florella', 'fcrippin2@google.com', 'fcrippin2@wordpress.org', 'female', 'florella Gilfether', 'florella crippin', '9082893450', '6247183402', 'apt 1426', 'yang', '111', null);
 
  CREATE TABLE studentms.course_enrollment (
    id INT PRIMARY KEY AUTO_INCREMENT,
    student_id varchar(20)  not null,
    course_id varchar(20) NOT NULL,
    enrollment_date DATE,
    grade FLOAT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   -- ,
    -- FOREIGN KEY (course_id) REFERENCES courses(course_id),
    -- FOREIGN KEY (Student_ID) REFERENCES Students(student_ID)
);
select * from studentms.course_enrollment;


select * from studentms.students where username='huang';
select * from studentms.users;