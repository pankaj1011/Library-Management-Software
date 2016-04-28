# Library-Management-Software
create a database with name librarydb in mysql 
by using command  create database librarydb;
then create tables like that
+---------------------+
| Tables_in_librarydb |
+---------------------+
| ADMIN_TBL           |
| BOOK_DB             |
| ISSUE_DB            |
| STUDENT_REG_TBL     |
+---------------------+
ADMIN_TBL should look like this one
+----------+-------------+------+-----+---------+-------+
| Field    | Type        | Null | Key | Default | Extra |
+----------+-------------+------+-----+---------+-------+
| LOGIN    | varchar(50) | NO   | PRI | NULL    |       |
| PASSWORD | varchar(50) | NO   |     | NULL    |       |
+----------+-------------+------+-----+---------+-------+


BOOK_DB should look like this one
+-----------+-------------+------+-----+---------+-------+
| Field     | Type        | Null | Key | Default | Extra |
+-----------+-------------+------+-----+---------+-------+
| BOOK_NAME | varchar(50) | NO   |     | NULL    |       |
| AUTHOR    | char(50)    | YES  |     | NULL    |       |
| ISBN_NO   | varchar(50) | NO   | PRI | NULL    |       |
| NO_OF_CPY | int(5)      | NO   |     | NULL    |       |
+-----------+-------------+------+-----+---------+-------+

ISSUE_DB should look like this one 
+-------------+-------------+------+-----+---------+-------+
| Field       | Type        | Null | Key | Default | Extra |
+-------------+-------------+------+-----+---------+-------+
| ROLL_NO     | varchar(50) | NO   |     | NULL    |       |
| ISBN_NO     | varchar(50) | NO   |     | NULL    |       |
| ISSUE_DATE  | date        | NO   |     | NULL    |       |
| RETURN_DATE | date        | YES  |     | NULL    |       |
+-------------+-------------+------+-----+---------+-------+

STUDENT_REG_TBL should look like this one 
+-----------+-------------+------+-----+---------+-------+
| Field     | Type        | Null | Key | Default | Extra |
+-----------+-------------+------+-----+---------+-------+
| ROLL_NO   | int(5)      | NO   | PRI | NULL    |       |
| FULL_NAME | varchar(50) | NO   |     | NULL    |       |
| EMAIL_ID  | varchar(50) | NO   |     | NULL    |       |
| PASSWORD  | varchar(50) | NO   |     | NULL    |       |
+-----------+-------------+------+-----+---------+-------+
then create followind entry in ADMIN_TBL
+--------------+----------------------------------+
| LOGIN        | PASSWORD                         |
+--------------+----------------------------------+
| admin        | 21232f297a57a5a743894a0e4a801fc3 |
+--------------+----------------------------------+
Note : the password string is equivalent  to md5(admin). therefore password for admin login is  admin.



create a procedure with name COUNT_BOOKS
DELIMITER $$
CREATE PROCEDURE COUNT_BOOKS(OUT _cnt DECIMAL)
 BEGIN
  SELECT SUM(NO_OF_CPY) INTO _cnt FROM BOOK_DB;
 END
 $$
DELIMITER ;




