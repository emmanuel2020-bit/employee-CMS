<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

  if( isset( $_GET['delete'] ) )
  {
    
    $id = $_GET['delete'];
    
    $query = 'DELETE FROM employees WHERE id = '.$id.' LIMIT 1';
    mysqli_query( $connect, $query );
    
    set_message( 'Employee has been deleted' );
    
    header( 'Location: employees.php' );
    die();
    
  }

include( 'includes/header.php' );

?>

  <h2>Employees</h2>

  <p>
    <a href="employees_add.php">Add Employee</a>
  </p>

<?php get_message(); ?>

<!-- Search Form -->
<form method="GET" action="" style="margin-bottom: 20px;">
  <input type="text" name="search" placeholder="Search by name, email, or department..." 
         value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" 
         style="padding: 8px; width: 300px; border: 1px solid #ccc; border-radius: 4px;">
  <button type="submit" style="padding: 8px 16px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Search</button>
  <?php if(isset($_GET['search']) && !empty($_GET['search'])): ?>
    <a href="employees.php" style="margin-left: 10px; color: #666;">Clear Search</a>
  <?php endif; ?>
</form>

<table border="1">
  <tr>
    <th>ID</th>
    <th>Photo</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Department</th>
    <th>Position</th>
    <th>Hire Date</th>
    <th>Salary</th>
    <th>Status</th>
    <th></th>
    <th></th>
  </tr>
  <?php
  
  // Build the query with search functionality
  $query = 'SELECT * FROM employees';
  if( isset( $_GET['search'] ) && !empty( $_GET['search'] ) )
  {
    $search = mysqli_real_escape_string( $connect, $_GET['search'] );
    $query .= ' WHERE first_name LIKE "%'.$search.'%" OR last_name LIKE "%'.$search.'%" OR email LIKE "%'.$search.'%" OR department LIKE "%'.$search.'%"';
  }
  $query .= ' ORDER BY last_name, first_name';
  
  $result = mysqli_query( $connect, $query );
  
  while( $record = mysqli_fetch_assoc( $result ) )
  {
    
    ?>
    <tr>
      <td><?php echo $record['id']; ?></td>
      <td>
        <?php if($record['photo']): ?>
          <img src="<?php echo $record['photo']; ?>" width="50">
        <?php else: ?>
          <p>No photo</p>
        <?php endif; ?>
      </td>
      <td><?php echo $record['first_name'].' '.$record['last_name']; ?></td>
      <td><?php echo $record['email']; ?></td>
      <td><?php echo $record['phone']; ?></td>
      <td><?php echo $record['department']; ?></td>
      <td><?php echo $record['position']; ?></td>
      <td><?php echo $record['hire_date']; ?></td>
      <td>$<?php echo number_format($record['salary'], 2); ?></td>
      <td><?php echo $record['status']; ?></td>
      <td>
        <a href="employees_edit.php?id=<?php echo $record['id']; ?>">Edit</a> |
        <a href="employees_photo.php?id=<?php echo $record['id']; ?>">Photo</a>
      </td>
      <td>
        <a href="employees.php?delete=<?php echo $record['id']; ?>" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</a>
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