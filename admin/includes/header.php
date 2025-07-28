<!doctype html>
<html>
<head>
  
  <meta charset="UTF-8">
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
  
  <title>Employee Management System - Admin</title>
  
  <link href="styles.css" type="text/css" rel="stylesheet">
  
  <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
  
  <style>
         .nav-menu {
       background-color: #f0f0f0;
       padding: 10px;
       margin-bottom: 20px;
     }
     .nav-menu a {
       margin-right: 15px;
       text-decoration: none;
       color: #333;
     }
    .dashboard-container {
      max-width: 1200px;
      margin: auto;
      padding: 20px;
    }
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      margin: 20px 0;
    }
         .stat-box {
       background: #f8f9fa;
       padding: 20px;
       text-align: center;
       border: 1px solid #dee2e6;
     }
    .stat-number {
      font-size: 2em;
      font-weight: bold;
      color: #007bff;
    }
    .action-buttons {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
      margin: 20px 0;
    }
         .btn {
       padding: 10px 20px;
       background: #007bff;
       color: white;
       text-decoration: none;
       border: none;
     }
    .data-table {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
    }
    .data-table th, .data-table td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }
    .data-table th {
      background-color: #f2f2f2;
    }
  </style>
  
</head>
<body>
  
  <h1>Employee Management System</h1>
  <p>PHP CMS Assignment</p>
  
  <?php if(isset($_SESSION['id'])): ?>

    <div class="nav-menu">
      <a href="dashboard.php">Dashboard</a> | 
      <a href="employees.php">Employees</a> | 
      <a href="departments.php">Departments</a> | 
      <a href="projects.php">Projects</a> | 
      <a href="users.php">Users</a> | 
      <a href="logout.php">Logout</a>
    </div>
  
  <?php endif; ?>
  
  <hr>
  
  <?php echo get_message(); ?>
  
  <div class="dashboard-container">
  
