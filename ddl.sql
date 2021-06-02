
CREATE TABLE professor (
  ssn INT,
  name VARCHAR(100),
  address VARCHAR(100),
  telephone INT,
  sex VARCHAR(6),
  teacher_title VARCHAR(100),
  college_degrees VARCHAR(200),
  salary INT,
  PRIMARY KEY (ssn)
  );

  CREATE TABLE department (
  dept_id INT,
  professor_ssn INT,
  dept_name VARCHAR(100),
  telephone INT,
  office_location VARCHAR(100),
  PRIMARY KEY (dept_id),
  FOREIGN KEY (professor_ssn) REFERENCES professor (ssn)
  );

  CREATE TABLE course (
  course_id INT,
  department_id INT,
  title VARCHAR(100),
  textbook VARCHAR(100),
  unit INT,
  prereq_course VARCHAR(100),
  PRIMARY KEY (course_id),
  FOREIGN KEY (department_id) REFERENCES department (dept_id)
  );

  CREATE TABLE section (
  section_id INT,
  course_id INT,
  professor_ssn INT,
  classroom_num INT,
  num_of_seats INT,
  meet_days VARCHAR(100),
  begin_time INT,
  end_time INT,
  PRIMARY KEY (section_id),
  FOREIGN KEY (course_id) REFERENCES course (course_id),
  FOREIGN KEY (professor_ssn) REFERENCES professor (ssn)
  );

  CREATE TABLE student (
  cwid INT,
  department_id INT,
  name VARCHAR(100),
  address VARCHAR(100),
  telephone INT,
  PRIMARY KEY (cwid),
  FOREIGN KEY (department_id) REFERENCES department (dept_id)
  );

  CREATE TABLE enrollment (
  cwid INT,
  section_id INT,
  grade VARCHAR(2),
  FOREIGN KEY (cwid) REFERENCES student (cwid),
  FOREIGN KEY (section_id) REFERENCES section (section_id)
  );

