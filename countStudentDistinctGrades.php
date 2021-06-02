<html>
<body>

<?php
$hostname = "localhost";
$username = "";
$password = "";
$db = "";
$dbconnect= mysqli_connect($hostname, $username, $password, $db);

if ($dbconnect->connect_error) {
  die("Database connection failed: ".$dbconnect->connect_error);
}
?>

<table border="1" align="center">
<tr>
  <td>Grade</td>
  <td>Count</td>
</tr>


<?php
$course = $_POST["course"]; //'101'
$section = $_POST["section"];//1

$query = mysqli_query($dbconnect, 
"SELECT grade, COUNT(DISTINCT(grade)) FROM 
(SELECT * from course WHERE (course.course_id=$course)) c 
INNER JOIN (SELECT * from section WHERE (section.section_id=$section)) s ON c.course_id = s.course_id 
INNER JOIN enrollment e ON e.section_id = s.section_id GROUP BY grade;"
)
   or die (mysqli_error($dbconnect));

while ($row = mysqli_fetch_array($query)) {
  echo
   "<tr>
    <td>{$row['grade']}</td>
    <td>{$row['COUNT(DISTINCT(grade))']}</td>
   </tr>\n";
}

?>


</table>
</body>
</html>