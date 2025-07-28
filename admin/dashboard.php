<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

?>

<div class="dashboard-container">
  
  <h1>Employee Management Dashboard</h1>
  <p>Welcome to my Employee Management System!</p>
  
  <div class="stats-grid">
    
    <div class="stat-box">
      <h3>Total Employees</h3>
      <?php
      $query = 'SELECT COUNT(*) as total FROM employees';
      $result = mysqli_query($connect, $query);
      $record = mysqli_fetch_assoc($result);
      ?>
      <div class="stat-number"><?php echo $record['total']; ?></div>
    </div>
    
    <div class="stat-box">
      <h3>Departments</h3>
      <?php
      $query = 'SELECT COUNT(*) as total FROM departments';
      $result = mysqli_query($connect, $query);
      $record = mysqli_fetch_assoc($result);
      ?>
      <div class="stat-number"><?php echo $record['total']; ?></div>
    </div>
    
    <div class="stat-box">
      <h3>Active Employees</h3>
      <?php
      $query = 'SELECT COUNT(*) as total FROM employees WHERE status = "Active"';
      $result = mysqli_query($connect, $query);
      $record = mysqli_fetch_assoc($result);
      ?>
      <div class="stat-number"><?php echo $record['total']; ?></div>
    </div>
    
    <div class="stat-box">
      <h3>Projects</h3>
      <?php
      $query = 'SELECT COUNT(*) as total FROM projects';
      $result = mysqli_query($connect, $query);
      $record = mysqli_fetch_assoc($result);
      ?>
      <div class="stat-number"><?php echo $record['total']; ?></div>
    </div>
    
  </div>
  
  <div class="quick-actions">
    <h2>Quick Actions</h2>
    <div class="action-buttons">
      <a href="employees.php" class="btn">Employees</a>
      <a href="departments.php" class="btn">Departments</a>
      <a href="projects.php" class="btn">Projects</a>
      <a href="users.php" class="btn">Users</a>
    </div>
  </div>
  
  <div class="recent-section">
    <h2>Recent Employees</h2>
    <?php
    $query = 'SELECT * FROM employees ORDER BY date DESC LIMIT 5';
    $result = mysqli_query($connect, $query);
    ?>
    <table class="data-table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Department</th>
          <th>Position</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php while($record = mysqli_fetch_assoc($result)): ?>
        <tr>
          <td><?php echo $record['first_name'] . ' ' . $record['last_name']; ?></td>
          <td><?php echo $record['department']; ?></td>
          <td><?php echo $record['position']; ?></td>
          <td><?php echo $record['status']; ?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

</div>

<?php

include( 'includes/footer.php' );

?>
