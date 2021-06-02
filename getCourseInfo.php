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
  <td>Section</td>
  <td>Classroom #</td>
  <td>Meeting days</td>
  <td>Begin time</td>
  <td>End time</td>
  <td># of students enrolled</td>
</tr>


<?php
$course = $_POST["course"]; //'101'

$query = mysqli_query($dbconnect, 
"SELECT e.section_id, classroom_num, meet_days, begin_time, end_time, COUNT(e.section_id) FROM 
(SELECT * from course 
WHERE (course.course_id=$course)) c 
INNER JOIN section s ON c.course_id = s.course_id 
INNER JOIN enrollment e ON s.section_id = e.section_id 
GROUP BY e.section_id;"
)
   or die (mysqli_error($dbconnect));

while ($row = mysqli_fetch_array($query)) {
  echo
   "<tr>
    <td>{$row['section_id']}</td>
    <td>{$row['classroom_num']}</td>
    <td>{$row['meet_days']}</td>
    <td>{$row['begin_time']}</td>
    <td>{$row['end_time']}</td>
    <td>{$row['COUNT(e.section_id)']}</td>
   </tr>\n";
}

?>


</table>
</body>
</html>