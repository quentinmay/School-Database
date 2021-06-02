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
  <td>Course ID</td>
  <td>Section ID</td>
  <td>Course Title</td>
  <td>Grade</td>
</tr>


<?php
$cwid = $_POST["cwid"];

$query = mysqli_query($dbconnect, 
"SELECT c.course_id, s.section_id, c.title, e.grade FROM 
(SELECT * from enrollment WHERE (enrollment.cwid=$cwid)) e 
INNER JOIN section s ON s.section_id = e.section_id 
INNER JOIN course c ON c.course_id = s.course_id;"
)
   or die (mysqli_error($dbconnect));

while ($row = mysqli_fetch_array($query)) {
  echo
   "<tr>
    <td>{$row['course_id']}</td>
    <td>{$row['section_id']}</td>
    <td>{$row['title']}</td>
    <td>{$row['grade']}</td>
   </tr>\n";
}

?>


</table>
</body>
</html>