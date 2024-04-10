<?php
include 'ddcon.php';
//include 'index.php';
include('includes/header.php'); 
include('includes/navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#id</th>
      <th scope="col">number</th>
      <th scope="col">region</th>
      <th scope="col">monday_time</th>
      <th scope="col">tuesday_time</th>
      <th scope="col">wednesday_time</th>
      <th scope="col">thursday_time</th>
      <th scope="col">friday_time</th>
      <th scope="col">saturday_time</th>
      <th scope="col">sunday_time</th>
      <th scope="col">services</th>
      <th scope="col">room_types</th>
      <th scope="col">bedroom_count</th>
      <th scope="col">livingroom_count</th>
      <th scope="col">bathroom_count</th>
      <th scope="col">kitchen_count</th>
      <th scope="col">status</th>
  <tbody>
    <?php
$fetch_query="SELECT * FROM  cart ";
$fetch_query_run= mysqli_query($connee, $fetch_query);


if(mysqli_num_rows($fetch_query_run) >0)
{
foreach($fetch_query_run as $row)
{

         ?>
      <tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['number']; ?></td>
<td><?php echo $row['region']; ?></td>
<td><?php echo $row['monday_time']; ?></td>
<td><?php echo $row['tuesday_time']; ?></td>
<td><?php echo $row['wednesday_time']; ?></td>
<td><?php echo $row['thursday_time']; ?></td>
<td><?php echo $row['friday_time']; ?></td>
<td><?php echo $row['saturday_time']; ?></td>
<td><?php echo $row['sunday_time']; ?></td>
<td><?php echo $row['services']; ?></td>
<td><?php echo $row['room_types']; ?></td>
<td><?php echo $row['bedroom_count']; ?></td>
<td><?php echo $row['livingroom_count']; ?></td>
<td><?php echo $row['bathroom_count']; ?></td>
<td><?php echo $row['kitchen_count']; ?></td>
<td><?php echo $row['status']; ?></td>
</tr>

<?php
 }
 }

else
{
    ?>

    <tr>

      <td colspan="3>No Record Found</td>
</tr>
    <?php
}
?>
  </tbody>
</table>
</body>
</html>