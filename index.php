<?php

include( 'admin/includes/database.php' );
include( 'admin/includes/config.php' );
include( 'admin/includes/functions.php' );

?>
<!doctype html>
<html>
<head>
  
  <meta charset="UTF-8">
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
  
  <title>Employee Management System - Company Portal</title>
  
  <style>
    body {
      font-family: Arial, sans-serif;
      max-width: 1200px;
      margin: auto;
      padding: 20px;
      background-color: #f5f5f5;
    }
         .header {
       background: #007bff;
       color: white;
       padding: 20px;
       margin-bottom: 30px;
       text-align: center;
     }
    .stats-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      margin-bottom: 30px;
    }
         .stat-card {
       background: white;
       padding: 20px;
       text-align: center;
     }
    .stat-number {
      font-size: 2.5em;
      font-weight: bold;
      color: #007bff;
    }
    .employees-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 20px;
    }
         .employee-card {
       background: white;
       padding: 20px;
       border: 1px solid #ccc;
     }
    .employee-name {
      font-size: 1.2em;
      font-weight: bold;
      color: #333;
      margin-bottom: 10px;
    }
    .employee-info {
      color: #666;
      margin: 5px 0;
    }
    .department-badge {
      background: #e9ecef;
      padding: 4px 8px;
      border-radius: 12px;
      font-size: 0.8em;
      color: #495057;
    }
         .admin-link {
       text-align: center;
       margin-top: 30px;
       padding: 20px;
       background: #f8f9fa;
     }
    .admin-link a {
      color: #007bff;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
  
</head>
<body>

  <div class="header">
    <h1>Employee Portal</h1>
    <p>Employee Management System</p>
  </div>

  <div class="stats-container">
    <?php
    $query = 'SELECT COUNT(*) as total FROM employees';
    $result = mysqli_query( $connect, $query );
    $total_employees = mysqli_fetch_assoc($result)['total'];
    
    $query = 'SELECT COUNT(*) as total FROM employees WHERE status = "Active"';
    $result = mysqli_query( $connect, $query );
    $active_employees = mysqli_fetch_assoc($result)['total'];
    
    $query = 'SELECT COUNT(*) as total FROM departments';
    $result = mysqli_query( $connect, $query );
    $total_departments = mysqli_fetch_assoc($result)['total'];
    
    $query = 'SELECT AVG(salary) as avg_salary FROM employees WHERE status = "Active"';
    $result = mysqli_query( $connect, $query );
    $avg_salary = mysqli_fetch_assoc($result)['avg_salary'];
    ?>
    
    <div class="stat-card">
      <div class="stat-number"><?php echo $total_employees; ?></div>
      <div>Total Employees</div>
    </div>
    
    <div class="stat-card">
      <div class="stat-number"><?php echo $active_employees; ?></div>
      <div>Active Employees</div>
    </div>
    
    <div class="stat-card">
      <div class="stat-number"><?php echo $total_departments; ?></div>
      <div>Departments</div>
    </div>
    
    <div class="stat-card">
      <div class="stat-number">$<?php echo number_format($avg_salary, 0); ?></div>
      <div>Average Salary</div>
    </div>
  </div>

  <h2>Employee Directory</h2>
  <p>Our team:</p>

  <div class="employees-grid">
    <?php
    $query = 'SELECT * FROM employees WHERE status = "Active" ORDER BY last_name, first_name';
    $result = mysqli_query( $connect, $query );
    
    while($record = mysqli_fetch_assoc($result)):
    ?>
    
    <div class="employee-card">
      <?php if($record['photo']): ?>
        <div style="text-align: center; margin-bottom: 15px;">
          <img src="<?php echo $record['photo']; ?>" style="width: 100px; height: 100px; border: 1px solid #ccc;">
        </div>
      <?php endif; ?>
      <div class="employee-name"><?php echo $record['first_name'] . ' ' . $record['last_name']; ?></div>
      <div class="employee-info">
        <strong>Position:</strong> <?php echo $record['position']; ?>
      </div>
      <div class="employee-info">
        <strong>Department:</strong> 
        <span class="department-badge"><?php echo $record['department']; ?></span>
      </div>
      <div class="employee-info">
        <strong>Email:</strong> <?php echo $record['email']; ?>
      </div>
      <div class="employee-info">
        <strong>Hired:</strong> <?php echo date('M Y', strtotime($record['hire_date'])); ?>
      </div>
    </div>
    
    <?php endwhile; ?>
  </div>

  <h2>Department Overview</h2>
  <div class="employees-grid">
    <?php
    $query = 'SELECT d.name, d.description, COUNT(e.id) as employee_count 
              FROM departments d 
              LEFT JOIN employees e ON d.name = e.department AND e.status = "Active"
              GROUP BY d.id 
              ORDER BY d.name';
    $result = mysqli_query( $connect, $query );
    
    while($record = mysqli_fetch_assoc($result)):
    ?>
    
    <div class="employee-card">
      <div class="employee-name"><?php echo $record['name']; ?> Department</div>
      <div class="employee-info"><?php echo $record['description']; ?></div>
      <div class="employee-info">
        <strong>Employees:</strong> <?php echo $record['employee_count']; ?>
      </div>
    </div>
    
    <?php endwhile; ?>
  </div>

  <div class="admin-link">
    <p><a href="admin/">Admin Login</a> - For authorized personnel only</p>
  </div>

</body>
</html>
