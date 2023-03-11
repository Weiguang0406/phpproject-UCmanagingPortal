This is a project for the "Web Development I" course of Elie, to be completed using PHP between February 13, 2023 and March 8, 2023.

Project intro:

Group: Admin

Agile:

 Day1 Progress Meeting:

College Students and course enrollment:
Main feature:
1- Admin portal: Student management(registration, withdraw),Teacher management, Course management(Add/remove courses, change course status(available/unavailable)),profile;
2- Teacher portal: Add courses and managing his/her own courses; Teacher profile(Password..);
3- Student: Check available course, select and unselect courses; modify personal information(Address,phone number, password),check grade;

Optional feature:
1.Adding profile image;

Next:

1. Will design the main page(index);
2. Design admin, teacher and student portal separately;



Meeting 2/24:

Plan: Create a College Students and course management system;

Design: 

Main features:
1- Admin portal: Student management(registration, withdraw),Teacher management, Course management(Add/remove courses, change course status(available/unavailable)),profile;
2- Teacher portal: Add courses and managing his/her own courses; Teacher profile(Password..);
3- Student portal: Check available course, select and unselect courses; modify personal information(Address,phone number, password),check grade;

Develop:  student portal 50% done; 
- Created 4 tables: users, students,courses, course_enrollment(with preassigned sample data)
- Designed web page layout and style;
- Created students portal pages: student_home, student_profile, student_courseenrollment, student_grade

Test: 
display student profile, query courses by selecting course name and schedule works;

Deploy: 
- Current progress: student portal 50% done, be able to  able to display student profile, query courses by selecting course name and schedule;

Review:
- Next steps:
 1- Design Admin portal pages: Admin login page/logic; User management page(Add, udpate, delete),unenroll student;
 2- Teacher portal pages: Teacher table, teacher home page, Add/update/remove course, password-reset
 


Meeting 2/26:

Worked on weekend and made the following progress:
Admin portal:
Admin login/logout>> done;
Course display, update, delete and restore>> done;
Student menagement: Add update, delete >> done;
Teacher portal: 
Designing teacher profile;
Teacher course management ongoing;

Next step:

1. Create student hoem page;
2. Teacher course mangement: course register, check course enrollment status;
3. Admin>> user management(bulk/single enroll user), overall course enrollment status;


For details please refer to our Jira Agile tracking our progress(See attachment).

Jira Link: https://adminprogress.atlassian.net/jira/software/projects/AP/boards/1/roadmap?selectedIssue=AP-4&shared=&atlOrigin=eyJpIjoiMDkxMDM5YzY0ZGVhNDdlZmI0ZjlkYTdiMTRhMTA5NjYiLCJwIjoiaiJ9

Code is shared in group via github. 
Github link:





cuixu's comments
****************************

danli's comments
****************************

Weiguang's comments:
****************************
2/23:
1-Will fix courses select bug(check if the course is already selected);
2- Tidy the code to make into different sections to make it more readable(seperate pages);



