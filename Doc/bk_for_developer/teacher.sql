CREATE TABLE IF NOT EXISTS studentms.teacher (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    TeacherName VARCHAR(200) NOT NULL,
    TeacherEmail VARCHAR(200) NOT NULL,
    Department VARCHAR(100) NOT NULL,
    Gender VARCHAR(50) NOT NULL,
    DOB DATE NOT NULL,
    TeacherID VARCHAR(200) NOT NULL,
    ContactNumber VARCHAR(20) NOT NULL,
    AlternateNumber VARCHAR(20) NULL DEFAULT NULL,
    Address VARCHAR(200) NOT NULL,
    UserName VARCHAR(50) NOT NULL,
    ImageFileName VARCHAR(200) NULL DEFAULT NULL
);
CREATE TABLE IF NOT EXISTS studentms.teacher_course (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    TeacherID INT NOT NULL,
    course_id INT NOT NULL,
    schedule VARCHAR(50) NOT NULL,
    FOREIGN KEY (TeacherID) REFERENCES teacher(id),
    FOREIGN KEY (course_id) REFERENCES courses(id)
);
CREATE TABLE IF NOT EXISTS studentms.teacher_student (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    TeacherID INT NOT NULL,
    StudentID INT NOT NULL,
    FOREIGN KEY (TeacherID) REFERENCES teacher(id),
    FOREIGN KEY (StudentID) REFERENCES student(ID)
);
INSERT INTO studentms.teacher (
        TeacherName,
        TeacherEmail,
        Department,
        Gender,
        DOB,
        TeacherID,
        ContactNumber,
        AlternateNumber,
        Address,
        UserName,
        ImageFileName
    )
VALUES (
        'John Smith',
        'john.smith@jac.com',
        'Math',
        'Male',
        '1990-01-01',
        'T001',
        '1234567890',
        NULL,
        '123 Main St, Anytown USA',
        'jsmith',
        'image1.jpg'
    ),
    (
        'Jane Doe',
        'jane.doe@jac.com',
        'English',
        'Female',
        '1995-02-02',
        'T002',
        '1234567891',
        '0987654321',
        '456 Elm St, Anytown USA',
        'xu',
        'image2.jpg'
    ),
    (
        'Bob Johnson',
        'bob.johnson@jac.com',
        'Science',
        'Male',
        '1985-03-03',
        'T003',
        '1234567892',
        NULL,
        '789 Oak St, Anytown USA',
        'bjohnson',
        'image3.jpg'
    ),
    (
        'Sally Lee',
        'sally.lee@jac.com',
        'History',
        'Female',
        '1992-04-04',
        'T004',
        '1234567893',
        NULL,
        '321 Maple St, Anytown USA',
        'slee',
        'image4.jpg'
    ),
    (
        'Tom Wilson',
        'tom.wilson@jac.com',
        'Art',
        'Male',
        '1991-05-05',
        'T005',
        '1234567894',
        '0123456789',
        '654 Pine St, Anytown USA',
        'twilson',
        'image5.jpg'
    ),
    (
        'Amy Brown',
        'amy.brown@jac.com',
        'Music',
        'Female',
        '1996-06-06',
        'T006',
        '1234567895',
        '9876543210',
        '987 Cedar St, Anytown USA',
        'abrown',
        'image6.jpg'
    ),
    (
        'Bill Davis',
        'bill.davis@jac.com',
        'Physical Education',
        'Male',
        '1993-07-07',
        'T007',
        '1234567896',
        '5555555555',
        '321 Oak St, Anytown USA',
        'bdavis',
        'image7.jpg'
    ),
    (
        'Lucy Kim',
        'lucy.kim@jac.com',
        'Foreign Language',
        'Female',
        '1990-08-08',
        'T008',
        '1234567897',
        NULL,
        '654 Elm St, Anytown USA',
        'lkim',
        'image8.jpg'
    ),
    (
        'Jake Chen',
        'jake.chen@jac.com',
        'Technology',
        'Male',
        '1995-09-09',
        'T009',
        '1234567898',
        '4444444444',
        '123 Maple St, Anytown USA',
        'jchen',
        'image9.jpg'
    ),
    (
        'Emily Adams',
        'emily.adams@jac.com',
        'Social Science',
        'Female',
        '1994-10-10',
        'T010',
        '1234567899',
        NULL,
        '456 Pine St, Anytown USA',
        'eadams',
        'image10.jpg'
    );