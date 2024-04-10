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
      <th scope="col">email</th>
      <th scope="col">username</th>
      <th scope="col">password</th>
      <th> EDIT</th>
      <th>DELETE</th>
    </tr>
  </thead>
  <tbody>
    <?php
$fetch_query="SELECT * FROM  users ";
$fetch_query_run= mysqli_query($connee, $fetch_query);


if(mysqli_num_rows($fetch_query_run) >0)
{
foreach($fetch_query_run as $row)
{

         ?>
      <tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['username']; ?></td>
<td><?php echo $row['password']; ?></td>

<td>
            <form action="client_edit.php" method="post">
            <input type="hidden" name="edit_id" value="<?php echo $row['id'];?>">
              <button type="submit"  name="edit_btn"  class="btn btn-success">EDIT</button>
</form>
            </td>
            <td>
            <form action="client_delete.php" method="post">
            
            <input type="hidden" name="delete_id" value="<?php echo $row['id'];?>">
            <button type="submit" name="delete_btn" class="btn btn-danger">DELETE</button>
</form>

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