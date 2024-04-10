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
      <th scope="col">name</th>
      <th scope="col">email</th>
      <th scope="col">subject</th>
      <th scope="col">message</th>
    </tr>
  </thead>
  <tbody>
    <?php
$fetch_query="SELECT * FROM  contact ";
$fetch_query_run= mysqli_query($connee, $fetch_query);


if(mysqli_num_rows($fetch_query_run) >0)
{
foreach($fetch_query_run as $row)
{

         ?>
      <tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['subject']; ?></td>
<td><?php echo $row['message']; ?></td>


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