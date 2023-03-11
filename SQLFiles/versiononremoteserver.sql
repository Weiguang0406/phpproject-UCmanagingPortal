drop database studentms;
create database studentms;
use studentms;
-- SET SQL_SAFE_UPDATES=0;
-- flush privileges;
CREATE TABLE courses (
   course_id varchar(20) PRIMARY KEY,
   course_name VARCHAR(50) NOT NULL,
   credit_hours INT NOT NULL,
   department VARCHAR(50) NOT NULL,
   semester VARCHAR(50) NOT NULL,
   schedule VARCHAR(50) NOT NULL
);

CREATE TABLE users (
  user_id VARCHAR(20) PRIMARY KEY,
  username VARCHAR(20) ,
  password VARCHAR(255),
  roles varchar(10)
 );
create table  students (
   student_id  varchar(20) primary key,
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
   foreign key (student_id) references users(user_id)
) ;

CREATE TABLE course_enrollment (
   id INT PRIMARY KEY AUTO_INCREMENT,
   student_id varchar(20)  not null,
   course_id varchar(20) NOT NULL,
   enrollment_date DATE,
   grade FLOAT,
   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   FOREIGN KEY (course_id) REFERENCES courses(course_id),
   FOREIGN KEY (student_id) REFERENCES students(student_id)
);

CREATE TABLE teacher (
                        teacher_id VARCHAR(20) PRIMARY KEY,
                         teachername VARCHAR(50) default null,
                         teacheremail VARCHAR(200) default null,
                         department VARCHAR(100) default null,
                         gender VARCHAR(50) default null,
                         contactnumber VARCHAR(20) default null,
                         address VARCHAR(200) default null,
                         FOREIGN KEY (teacher_id) REFERENCES users(user_id)
);
CREATE TABLE  teacher_course (
   id INT AUTO_INCREMENT PRIMARY KEY,
   teacher_id varchar(20),
   course_id varchar(20) NOT NULL,
   FOREIGN KEY (teacher_id) REFERENCES teacher(teacher_id),
   FOREIGN KEY (course_id) REFERENCES courses(course_id)
);


-- Standalone Table for archived courses info, no sensitive data.PII included
CREATE TABLE  IF NOT EXISTS studentms.deletedcourses (
  course_id varchar(20) PRIMARY KEY,
  course_name VARCHAR(50) NOT NULL,
  credit_hours INT NOT NULL,
  department VARCHAR(50) NOT NULL,
  semester VARCHAR(50) NOT NULL,
  schedule VARCHAR(50) NOT NULL
);


INSERT INTO courses (course_name,course_id, semester, credit_hours, department, schedule)
VALUES
 ( 'Introduction to Computer Science', 'CSC101', 'winter',3, 'Computer Science',  'MWF 10:00-11:30am'),
 ( 'English Composition I', 'ENG101','fall', 3, 'English',  'TTH 1:00-2:30pm'),
 ( 'Calculus I', 'MAT201','spring', 4, 'Mathematics', 'MWF 9:00-10:30am');

insert into users(user_id,username,password,roles)
values
    (1,'xu','$2y$10$JYYB0VcZZyPG29rT7osn7uFRpXCRFCq14QO5QzHhISNEimLiXOzQi','teacher'),
    (2,'huang','$10$ozbXrm1lxKmojSPcFQfPTODfed9Q5zn6akRD5MfmHNoYjp/TAFpO.','student'),
    (3,'yang','$2y$10$I11bdQZWjZj/237RRHyeOex/b.iUEDQHQ93g8smAoAREqnvcdY5ba','admin');
insert into students (student_id,studentname, studentemail, studentclass, gender, fathername, mothername, contactnumber, alternatenumber, address,  imagefilename)
values (2,'dag', 'ddicty1@wordpress.org', 'ddicty1@hostgator.com', 'male', 'dag Eyres', 'dag dicty', '9802370940', '5991988972', 'Room 913',  null);

INSERT INTO teacher (teacher_id, teachername, teacheremail,department,gender,contactnumber,address)
VALUES('1', 'XU Cui','xu@email.com','CSC','female','123-456-7890','123 Main St, Anytown USA'),
      ('3', 'Yang','yang@email.com','CSC','male','123-456-7899','120 blainville');
insert into  teacher_course (teacher_id,course_id)
values ('3','CSC101'),
       ('3','ENG101'),('3','MAT201'),('3','4'),('3','5')
