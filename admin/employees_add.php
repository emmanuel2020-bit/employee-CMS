<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

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
  
  $photo = '';
  if( isset( $_FILES['photo'] ) && $_FILES['photo']['error'] == 0 )
  {
    $file = $_FILES['photo'];
    $file_type = $file['type'];
    $file_size = $file['size'];
    $file_tmp = $file['tmp_name'];
    
    $allowed_types = array( 'image/jpeg', 'image/jpg', 'image/png', 'image/gif' );
    $max_size = 5 * 1024 * 1024;
    
    if( in_array( $file_type, $allowed_types ) && $file_size <= $max_size )
    {
      $file_data = file_get_contents( $file_tmp );
      $photo = 'data:'.$file_type.';base64,'.base64_encode( $file_data );
    }
  }
  
  if( empty($first_name) || empty($last_name) || empty($email) )
  {
    set_message( 'Please fill in all required fields' );
  }
  else
  {
    
    $check_query = 'SELECT * FROM employees WHERE email = "'.$email.'" LIMIT 1';
    $check_result = mysqli_query( $connect, $check_query );
    
    if( mysqli_num_rows( $check_result ) )
    {
      set_message( 'Email already exists' );
    }
    else
    {
      
      $query = 'INSERT INTO employees (first_name, last_name, email, phone, department, position, hire_date, salary, status, photo) VALUES (
        "'.$first_name.'",
        "'.$last_name.'",
        "'.$email.'",
        "'.$phone.'",
        "'.$department.'",
        "'.$position.'",
        "'.$hire_date.'",
        "'.$salary.'",
        "'.$status.'",
        "'.$photo.'"
      )';
      
      mysqli_query( $connect, $query );
      
      set_message( 'Employee has been added' );
      
      header( 'Location: employees.php' );
      die();
      
    }
    
  }
  
}

include( 'includes/header.php' );

?>

  <h2>Add Employee</h2>

<form method="post" enctype="multipart/form-data">
  
  <table>
    <tr>
      <td>First Name:</td>
      <td><input type="text" name="first_name" value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : ''; ?>" required></td>
    </tr>
    <tr>
      <td>Last Name:</td>
      <td><input type="text" name="last_name" value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : ''; ?>" required></td>
    </tr>
    <tr>
      <td>Email:</td>
      <td><input type="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required></td>
    </tr>
    <tr>
      <td>Phone:</td>
      <td><input type="text" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>"></td>
    </tr>
    <tr>
      <td>Department:</td>
      <td>
        <select name="department">
          <option value="">Select Department</option>
          <option value="IT" <?php echo (isset($_POST['department']) && $_POST['department'] == 'IT') ? 'selected' : ''; ?>>IT</option>
          <option value="HR" <?php echo (isset($_POST['department']) && $_POST['department'] == 'HR') ? 'selected' : ''; ?>>HR</option>
          <option value="Marketing" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Marketing') ? 'selected' : ''; ?>>Marketing</option>
          <option value="Finance" <?php echo (isset($_POST['department']) && $_POST['department'] == 'Finance') ? 'selected' : ''; ?>>Finance</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>Position:</td>
      <td><input type="text" name="position" value="<?php echo isset($_POST['position']) ? $_POST['position'] : ''; ?>"></td>
    </tr>
    <tr>
      <td>Hire Date:</td>
      <td><input type="date" name="hire_date" value="<?php echo isset($_POST['hire_date']) ? $_POST['hire_date'] : ''; ?>"></td>
    </tr>
    <tr>
      <td>Salary:</td>
      <td><input type="number" name="salary" step="0.01" value="<?php echo isset($_POST['salary']) ? $_POST['salary'] : ''; ?>"></td>
    </tr>
    <tr>
      <td>Status:</td>
      <td>
        <select name="status">
          <option value="Active" <?php echo (isset($_POST['status']) && $_POST['status'] == 'Active') ? 'selected' : ''; ?>>Active</option>
          <option value="Inactive" <?php echo (isset($_POST['status']) && $_POST['status'] == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
          <option value="On Leave" <?php echo (isset($_POST['status']) && $_POST['status'] == 'On Leave') ? 'selected' : ''; ?>>On Leave</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>Photo:</td>
      <td>
        <input type="file" name="photo" accept="image/*">
                 <br><small>Optional - JPG, PNG, GIF up to 5MB</small>
      </td>
    </tr>
  </table>
  
  <br>
  
  <input type="submit" value="Add Employee">
  
</form>

<p>
  <a href="dashboard.php">Back to Dashboard</a> |
  <a href="employees.php">Back to Employees</a>
</p>

<?php

include( 'includes/footer.php' );

?> 