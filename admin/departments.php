<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

  if( isset( $_GET['delete'] ) )
  {
    
    $id = $_GET['delete'];
    
    $check_query = 'SELECT COUNT(*) as count FROM employees WHERE department = (SELECT name FROM departments WHERE id = '.$id.')';
    $check_result = mysqli_query( $connect, $check_query );
    $check_record = mysqli_fetch_assoc( $check_result );
    
    if( $check_record['count'] > 0 )
    {
      set_message( 'Cannot delete department - it has employees assigned to it' );
    }
    else
    {
      $query = 'DELETE FROM departments WHERE id = '.$id.' LIMIT 1';
      mysqli_query( $connect, $query );
      
      set_message( 'Department has been deleted' );
    }
    
    header( 'Location: departments.php' );
    die();
    
  }
  
  if( isset( $_POST['name'] ) )
  {
    
    $name = $_POST['name'];
    $description = $_POST['description'];
    
    if( empty($name) )
    {
      set_message( 'Please enter department name' );
    }
    else
    {
      
      $check_query = 'SELECT * FROM departments WHERE name = "'.$name.'" LIMIT 1';
      $check_result = mysqli_query( $connect, $check_query );
      
      if( mysqli_num_rows( $check_result ) )
      {
        set_message( 'Department already exists' );
      }
      else
      {
        
        $query = 'INSERT INTO departments (name, description) VALUES ("'.$name.'", "'.$description.'")';
        mysqli_query( $connect, $query );
        
        set_message( 'Department has been added' );
        
        header( 'Location: departments.php' );
        die();
        
      }
      
    }
    
  }

include( 'includes/header.php' );

?>

  <h2>Departments</h2>

    <div style="margin-bottom: 20px; padding: 10px; border: 1px solid #ccc;">
  <h3>Add Department</h3>
  <form method="post">
    <table>
      <tr>
        <td>Department Name:</td>
        <td><input type="text" name="name" required></td>
      </tr>
      <tr>
        <td>Description:</td>
        <td><textarea name="description" rows="3" cols="30"></textarea></td>
      </tr>
    </table>
    <br>
             <input type="submit" value="Add">
  </form>
</div>

<?php get_message(); ?>

<table border="1">
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Description</th>
    <th>Employee Count</th>
    <th>Created Date</th>
    <th></th>
  </tr>
  <?php
  
  $query = 'SELECT d.*, COUNT(e.id) as employee_count 
            FROM departments d 
            LEFT JOIN employees e ON d.name = e.department 
            GROUP BY d.id 
            ORDER BY d.name';
  $result = mysqli_query( $connect, $query );
  
  while( $record = mysqli_fetch_assoc( $result ) )
  {
    
    ?>
    <tr>
      <td><?php echo $record['id']; ?></td>
      <td><?php echo $record['name']; ?></td>
      <td><?php echo $record['description']; ?></td>
      <td><?php echo $record['employee_count']; ?></td>
      <td><?php echo $record['date']; ?></td>
      <td>
        <?php if($record['employee_count'] == 0): ?>
          <a href="departments.php?delete=<?php echo $record['id']; ?>" onclick="return confirm('Are you sure you want to delete this department?')">Delete</a>
        <?php else: ?>
          <span style="color: #999;">Cannot delete (has employees)</span>
        <?php endif; ?>
      </td>
    </tr>
    <?php
    
  }
  
  ?>
</table>

<p>
  <a href="dashboard.php">Back to Dashboard</a>
</p>

<?php

include( 'includes/footer.php' );

?> 