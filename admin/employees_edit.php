<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

$id = $_GET['id'];

if( isset( $_POST['first_name'] ) )
{
  
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $department = $_POST['department'];
  $position = $_POST['position'];
  $hire_date = $_POST['hire_date'];
  $salary = $_POST['salary'];
  $status = $_POST['status'];
  
  if( empty($first_name) || empty($last_name) || empty($email) )
  {
    set_message( 'Please fill in all required fields' );
  }
  else
  {
    
    $check_query = 'SELECT * FROM employees WHERE email = "'.$email.'" AND id != '.$id.' LIMIT 1';
    $check_result = mysqli_query( $connect, $check_query );
    
    if( mysqli_num_rows( $check_result ) )
    {
      set_message( 'Email already exists' );
    }
    else
    {
      
      $query = 'UPDATE employees SET 
        first_name = "'.$first_name.'",
        last_name = "'.$last_name.'",
        email = "'.$email.'",
        phone = "'.$phone.'",
        department = "'.$department.'",
        position = "'.$position.'",
        hire_date = "'.$hire_date.'",
        salary = "'.$salary.'",
        status = "'.$status.'"
        WHERE id = '.$id.' LIMIT 1';
      
      mysqli_query( $connect, $query );
      
      set_message( 'Employee has been updated' );
      
      header( 'Location: employees.php' );
      die();
      
    }
    
  }
  
}

$query = 'SELECT * FROM employees WHERE id = '.$id.' LIMIT 1';
$result = mysqli_query( $connect, $query );

if( mysqli_num_rows( $result ) )
{
  
  $record = mysqli_fetch_assoc( $result );
  
}
else
{
  
  set_message( 'Employee not found' );
  header( 'Location: employees.php' );
  die();
  
}

include( 'includes/header.php' );

?>

<h2>Edit Employee</h2>

<form method="post">
  
  <table>
    <tr>
      <td>First Name:</td>
      <td><input type="text" name="first_name" value="<?php echo $record['first_name']; ?>" required></td>
    </tr>
    <tr>
      <td>Last Name:</td>
      <td><input type="text" name="last_name" value="<?php echo $record['last_name']; ?>" required></td>
    </tr>
    <tr>
      <td>Email:</td>
      <td><input type="email" name="email" value="<?php echo $record['email']; ?>" required></td>
    </tr>
    <tr>
      <td>Phone:</td>
      <td><input type="text" name="phone" value="<?php echo $record['phone']; ?>"></td>
    </tr>
    <tr>
      <td>Department:</td>
      <td>
        <select name="department">
          <option value="">Select Department</option>
          <option value="IT" <?php echo ($record['department'] == 'IT') ? 'selected' : ''; ?>>IT</option>
          <option value="HR" <?php echo ($record['department'] == 'HR') ? 'selected' : ''; ?>>HR</option>
          <option value="Marketing" <?php echo ($record['department'] == 'Marketing') ? 'selected' : ''; ?>>Marketing</option>
          <option value="Finance" <?php echo ($record['department'] == 'Finance') ? 'selected' : ''; ?>>Finance</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>Position:</td>
      <td><input type="text" name="position" value="<?php echo $record['position']; ?>"></td>
    </tr>
    <tr>
      <td>Hire Date:</td>
      <td><input type="date" name="hire_date" value="<?php echo $record['hire_date']; ?>"></td>
    </tr>
    <tr>
      <td>Salary:</td>
      <td><input type="number" name="salary" step="0.01" value="<?php echo $record['salary']; ?>"></td>
    </tr>
    <tr>
      <td>Status:</td>
      <td>
        <select name="status">
          <option value="Active" <?php echo ($record['status'] == 'Active') ? 'selected' : ''; ?>>Active</option>
          <option value="Inactive" <?php echo ($record['status'] == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
          <option value="On Leave" <?php echo ($record['status'] == 'On Leave') ? 'selected' : ''; ?>>On Leave</option>
        </select>
      </td>
    </tr>
  </table>
  
  <br>
  
  <input type="submit" value="Update Employee">
  
</form>

<p>
  <a href="employees.php">Back to Employees</a>
</p>

<?php

include( 'includes/footer.php' );

?> 