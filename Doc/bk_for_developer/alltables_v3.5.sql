drop database studentms;
create database studentms;
use studentms;
SET SQL_SAFE_UPDATES=0;
flush privileges;
drop table if exists course_enrollment;
drop table if exists teacher_course;
drop table if exists courses;
drop table if exists teachers;
drop table if EXiSTS students;
drop table if exists teacher;
drop table if exists users;


CREATE TABLE courses (
                         course_id varchar(20) PRIMARY KEY,
                         course_name VARCHAR(50) NOT NULL,
                         credit_hours INT NOT NULL,
                         department VARCHAR(50) NOT NULL,
                         semester VARCHAR(50) NOT NULL,
                         schedule VARCHAR(50) NOT NULL
);

-- 2/27: Added semester column into course table(no effect to current pages);

INSERT INTO courses (course_name,course_id, semester, credit_hours, department, schedule)
VALUES
    ( 'Introduction to Computer Science', 'CSC101', 'winter',3, 'Computer Science',  'MWF 10:00-11:30am'),
    ( 'English Composition I', 'ENG101','fall', 3, 'English',  'TTH 1:00-2:30pm'),
    ( 'Calculus I', 'MAT201','spring', 4, 'Mathematics', 'MWF 9:00-10:30am');

-- Updated the course enrollment course; fixed the foreign key not compatable issue;


CREATE TABLE users (
                       user_id varchar(20),-- NOT NULL PRIMARY KEY AUTO_INCREMENT,
                       username VARCHAR(20) ,
                       password VARCHAR(255),
                       roles varchar(10),
                       primary key(user_id)
);
insert into users(user_id,username,password,roles)
values
    (1,'xu','xu','teacher'),
    (2,'huang','huang','student'),
    (3,'yang','yang','admin');
select * from users;
-- flush privileges;
-- SET SQL_SAFE_UPDATES = 0;
create table  students (
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
                           imagefilename varchar(200) null default null,
                           dateofadmission date nuLL ,
                           primary key (student_id),
                           foreign key (student_id) references users(user_id)
) ;

insert into students (student_id,studentname, studentemail, studentclass, gender, fathername, mothername, contactnumber, alternatenumber, address,  imagefilename)
values (2,'dag', 'ddicty1@wordpress.org', 'ddicty1@hostgator.com', 'male', 'dag Eyres', 'dag dicty', '9802370940', '5991988972', 'Room 913',  null);
      

-- (1,'Benita', 'bmendel0@amazonaws.com', 'bmendel0@moonfruit.com', 'nonbinary', 'Benita Trengrove', 'Benita mendel', '6752928337', '7471241116', 'Suite 79', null),
-- (3,'florella', 'fcrippin2@google.com', 'fcrippin2@wordpress.org', 'female', 'florella Gilfether', 'florella crippin', '9082893450', '6247183402', 'apt 1426',  null);



CREATE TABLE course_enrollment (
                                   id INT PRIMARY KEY AUTO_INCREMENT,
                                   student_id varchar(20)  not null,
                                   course_id varchar(20) NOT NULL,
                                   enrollment_date DATE,
                                   grade FLOAT,
                                   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ,
                                   FOREIGN KEY (course_id) REFERENCES courses(course_id),
                                   FOREIGN KEY (student_id) REFERENCES students(student_id)
);



-- CREATE TABLE teacher (
--     -- id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
--                          teacher_id VARCHAR(20) PRIMARY KEY,
--                          teachername VARCHAR(50) NOT NULL,
--                          teacheremail VARCHAR(200) NOT NULL,
--                          department VARCHAR(100) NOT NULL,
--                          gender VARCHAR(50) NOT NULL,
--                          contactnumber VARCHAR(20) NOT NULL,
--                          address VARCHAR(200) NOT NULL,
--                          FOREIGN KEY (teacher_id) REFERENCES users(user_id)
-- );

CREATE TABLE teacher (
    -- id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                         teacher_id VARCHAR(20) PRIMARY KEY,
                         teachername VARCHAR(50) default null,
                         teacheremail VARCHAR(200) default null,
                         department VARCHAR(100) default null,
                         gender VARCHAR(50) default null,
                         contactnumber VARCHAR(20) default null,
                         address VARCHAR(200) default null,
                         FOREIGN KEY (teacher_id) REFERENCES users(user_id)
);

INSERT INTO teacher (teacher_id, teachername, teacheremail,department,gender,contactnumber,address) 
  VALUES('1', 'XU Cui','xu@email.com','CSC','female','123-456-7890','123 Main St, Anytown USA'),
  ('3', 'Yang','yang@email.com','CSC','male','123-456-7899','120 blainville');

CREATE TABLE  teacher_course (
                                 id INT AUTO_INCREMENT PRIMARY KEY,
                                 teacher_id varchar(20),
                                 course_id varchar(20) NOT NULL,
                                 FOREIGN KEY (teacher_id) REFERENCES teacher(teacher_id),
                                 FOREIGN KEY (course_id) REFERENCES courses(course_id)
);