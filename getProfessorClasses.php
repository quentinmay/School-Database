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
  <td>Title</td>
  <td>Classroom</td>
  <td>Meeting days</td>
  <td>Beginning time</td>
  <td>Ending time</td>
</tr>


<?php
$ssn = $_POST["ssn"];

$query = mysqli_query($dbconnect, 
"SELECT title, classroom_num, meet_days, begin_time, end_time FROM 
(SELECT * from professor WHERE (professor.ssn=$ssn)) p 
INNER JOIN section s ON p.ssn = s.professor_ssn 
INNER JOIN course c ON s.course_id = c.course_id;"
)
   or die (mysqli_error($dbconnect));

while ($row = mysqli_fetch_array($query)) {
  echo
   "<tr>
    <td>{$row['title']}</td>
    <td>{$row['classroom_num']}</td>
    <td>{$row['meet_days']}</td>
    <td>{$row['begin_time']}</td>
    <td>{$row['end_time']}</td>
   </tr>\n";
}

?>


</table>
</body>
</html>