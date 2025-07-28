<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

$id = $_GET['id'];

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

  if( isset( $_POST['submit'] ) )
  {
    
    if( isset( $_FILES['photo'] ) && $_FILES['photo']['error'] == 0 )
    {
      
      $file = $_FILES['photo'];
      $file_name = $file['name'];
      $file_size = $file['size'];
      $file_tmp = $file['tmp_name'];
      $file_type = $file['type'];
      
      $allowed_types = array( 'image/jpeg', 'image/jpg', 'image/png', 'image/gif' );
      $max_size = 5 * 1024 * 1024;
      
      if( !in_array( $file_type, $allowed_types ) )
      {
        set_message( 'Please upload only JPG, PNG or GIF images' );
      }
      elseif( $file_size > $max_size )
      {
        set_message( 'File size must be less than 5MB' );
      }
      else
      {
        
        $file_data = file_get_contents( $file_tmp );
        $base64 = 'data:'.$file_type.';base64,'.base64_encode( $file_data );
        
        $query = 'UPDATE employees SET photo = "'.$base64.'" WHERE id = '.$id.' LIMIT 1';
        mysqli_query( $connect, $query );
        
        set_message( 'Photo uploaded successfully!' );
        
        header( 'Location: employees.php' );
        die();
        
      }
      
    }
    else
    {
      set_message( 'Please select a file to upload' );
    }
    
  }

include( 'includes/header.php' );

?>

  <h2>Upload Photo</h2>

<div style="margin-bottom: 20px;">
  <p><strong>Employee:</strong> <?php echo $record['first_name'].' '.$record['last_name']; ?></p>
  <p><strong>Position:</strong> <?php echo $record['position']; ?></p>
  <p><strong>Department:</strong> <?php echo $record['department']; ?></p>
</div>

<?php get_message(); ?>

  <div style="margin-bottom: 20px;">
    <h3>Current Photo:</h3>
    <?php if($record['photo']): ?>
      <img src="<?php echo $record['photo']; ?>" style="max-width: 200px; border: 1px solid #ccc;">
    <?php else: ?>
      <p>No photo uploaded yet.</p>
    <?php endif; ?>
  </div>

  <div style="border: 1px solid #ccc; padding: 20px; border-radius: 5px;">
  <h3>Upload New Photo</h3>
  
  <form method="post" enctype="multipart/form-data">
    
    <table>
      <tr>
        <td>Select Photo:</td>
        <td><input type="file" name="photo" accept="image/*" required></td>
      </tr>
      <tr>
        <td></td>
        <td>
                     <small>
             JPG, PNG, GIF up to 5MB
           </small>
        </td>
      </tr>
    </table>
    
    <br>
    
    <input type="submit" name="submit" value="Upload Photo">
    
  </form>
</div>

<p>
  <a href="employees.php">Back to Employees</a>
</p>

<?php

include( 'includes/footer.php' );

?> 