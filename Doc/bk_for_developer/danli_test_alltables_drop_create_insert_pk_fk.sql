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
(1,'xu','xu','admin'),
(2,'huang','huang','admin'),
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
use studentms;
select c.course_name from courses  c
inner join course_enrollment c_e
on  c_e.course_id = c.course_id 
inner join students s
on s.student_id=c_e.student_id
select * from students;
select s.student_id, studentname, s.username,dateofadmission,address 
        from students s
        inner join users u
        on u.user_id = s.student_id;
        use studentms;
        select s.student_id, studentname, s.username,dateofadmission, c_e.course_id
        from students s
        inner join users u;
        
        use studentms;
        select * from course_enrollment;
        on u.user_id = s.student_id
        inner join course_enrollment c_e
        group by s.student_id;
        use studentms;
        select count(course_id) from  course_enrollment c_e
        group by student_id;
        select * from course_enrollment;
        
        
        insert into course_enrollment(student_id,course_id) 
        values(1,1),
        (1,2),
        (1,3),
        (1,4),
        (1,5),
        (1,6);
           insert into course_enrollment(student_id,course_id) 
        values(2,1),
        (2,2),
        (2,3),
        (2,4);
        select * from course_enrollment;
        
        select s.student_id, studentname, s.username,dateofadmission,count(c_e.student_id) as course_count
        from students s
        inner join users u
        on u.user_id = s.student_id
        inner join course_enrollment c_e
        on c_e.student_id=s.student_id

        select s.student_id, studentname, s.username,dateofadmission,count(c_e.student_id) as course_count
        from students s
        inner join users u
        on u.user_id = s.student_id
        inner join course_enrollment c_e
        on c_e.student_id=s.student_id
        group by c_e.student_id
        use studentms;
        delete  from users where user_id='1';
        select * from users;
        delete  from students where student_id='1';
      23:25:56	delete  from users where user_id='1'	Error Code: 1451. Cannot delete or update a parent row: a foreign key constraint fails (`studentms`.`students`, CONSTRAINT `students_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`))	0.000 sec
  
        
        flush privileges;
        
    select * from users;
    select * from students
    select s.student_id, studentname, s.username,dateofadmission,count(c_e.student_id) as course_count
        from students s
        inner join users u
        on u.user_id = s.student_id
        inner join course_enrollment c_e
        on c_e.student_id=s.student_id
        group by c_e.student_id
        select * from users;
        select * from students
        select s.student_id, studentname, s.username,dateofadmission,count(c_e.student_id) as course_count
        from students s
        inner join users u
        on u.user_id = s.student_id
        left join course_enrollment c_e
        on c_e.student_id=s.student_id
        group by c_e.student_id
        
        
        select s.student_id, s.studentname, s.username,s.dateofadmission,count(c_e.student_id) as course_count
        from students s
        inner join users u
        on u.user_id = s.student_id
        left join course_enrollment c_e
        on c_e.student_id=s.student_id
      
     where u.roles='student'
     group by c_e.student_id
     select * from users;
     select * from students;
     
     
     select s.student_id, s.studentname, s.username,s.dateofadmission,count(c_e.student_id) as course_count
        from students s
        inner join users u
        on u.user_id = s.student_id
        left join course_enrollment c_e
        on c_e.student_id=s.student_id
       where u.roles='student'
     group by c_e.student_id
     
     delete from students where student_id=1; 
     select s.student_id, s.studentname, s.username,s.dateofadmission,
     count(c_e.student_id) as course_count
        from students s
        inner join users u
        on u.user_id = s.student_id
        left join course_enrollment c_e
        on c_e.student_id=s.student_id
       where u.roles='student'
     group by c_e.student_id
     
     select s.student_id,s.studentname,s.username,c_e.student_id,  u.user_id
     c_e.course_id
             from students s
        inner join users u
        on u.user_id = s.student_id
        left join course_enrollment c_e
        on c_e.student_id=s.student_id
       where u.roles='student';
select * from users;
select * from students;
     
     select * from course_enrollment;
     
     
     select u.user_id,u.username,s.studentname from users u
     inner join  students s
     on  u.user_id=s.student_id
     and u.roles='student'
     left join course_enrollment c_e
     on c_e.student_id=s.student_id
     
     
     select s.student_id, s.studentname, 
     s.username,s.dateofadmission, count(c_e.course_id)
        from students s
        inner join users u
        on u.user_id = s.student_id
       
        left join course_enrollment c_e
         on c_e.student_id=s.student_id
          where u.roles='student'
      group by c_e.student_id
     select * from students
     select * from users;
     01:45:57	select s.student_id, s.studentname, s.username,s.dateofadmission c_e.course_id,         from students s         inner join users u         on u.user_id = s.student_id         where u.roles='student'         left join course_enrollment c_e          on c_e.student_id=s.student_id	Error Code: 1064. You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '.course_id,         from students s         inner join users u         on u.user' at line 1	0.000 sec
select * from course_enrollment;
insert into course_enrollment (student_id,course_id) values('4','AA');
insert into course_enrollment (student_id,course_id) values('4','BB');
insert into course_enrollment (student_id,course_id) values('4','CC');
insert into course_enrollment (student_id,course_id) values('4','DD');
insert into course_enrollment (student_id,course_id) values('5','AA');
insert into course_enrollment (student_id,course_id) values('5','BB');
