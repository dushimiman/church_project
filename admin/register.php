<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../config.php';
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $church_id = $_POST['church_id'];
    $baptized = isset($_POST['baptized']) ? 1 : 0;
    $phone_number = $_POST['phone_number'];
    $ministry = $_POST['ministry'];
    $category = $_POST['category'];

    // Prepare the SQL statement
    $sql = "INSERT INTO christians (name, church_id, baptized, phone_number, ministry, category) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die("Error preparing the statement: " . $conn->error);
    }

    // Bind the parameters
    $stmt->bind_param("ssisss", $name, $church_id, $baptized, $phone_number, $ministry, $category);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        echo "New Christian registered successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <title>Register New Christian</title>
    
    <style>
        * {
            box-sizing: border-box;
        }
        .register-form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
            max-width: 1000px;
            margin: 0 auto;
        }
        .register-form input[type="text"],
        .register-form input[type="checkbox"],
        .register-form button {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            flex: 1 1 calc(100% / 7 - 20px);
        }
        .register-form label {
            display: flex;
            align-items: center;
            font-size: 16px;
            flex: 1 1 calc(100% / 7 - 20px);
        }
        .register-form button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            flex: 1 1 auto;
        }
        .register-form button:hover {
            background-color: #0056b3;
        }
        @media (max-width: 768px) {
            .register-form {
                flex-direction: column;
            }
            .register-form input[type="text"],
            .register-form input[type="checkbox"],
            .register-form label,
            .register-form button {
                flex: 1 1 100%;
            }
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto ml-">
    <li class="nav-item active">
      <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Dropdown
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="#">Action</a>
        <a class="dropdown-item" href="#">Another action</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Something else here</a>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link disabled" href="#">Disabled</a>
    </li>
  </ul>
 
</div>
</nav>

    <div class="row mt-5 ml-5 ml-5">
  <div class="col-md-4 mb-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Register New Christian</h5>
        <p class="card-text"></p>
        <a href="register.php" class="btn btn-primary">Register new</a>
      </div>
    </div>
  </div>
  <div class="col-md-4 mb-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">View All Christians</h5>
        <i class="fas fa-eye"></i>
        <a href="view_all.php" class="btn btn-primary">View All Christians</a>
      </div>
    </div>
  </div>
  <div class="col-md-4 mb-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">View Baptized Christians</h5>
        <p class="card-text"></p>
        <a href="view_baptized.php" class="btn btn-primary">View Baptized Christians</a>
      </div>
    </div>
  </div>
  <div class="col-md-4 mb-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">View Unbaptized Christians</h5>
        <p class="card-text"></p>
        <a href="view_unbaptized.php" class="btn btn-primary">View Unbaptized Christians</a>
      </div>
    </div>
  </div>
  <div class="col-md-4 mb-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Upload Report</h5>
        <p class="card-text"></p>
        <a href="upload_report.php" class="btn btn-primary">Upload Report</a>
      </div>
    </div>
  </div>
  <div class="col-md-4 mb-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">View Report</h5>
        <p class="card-text"></p>
        <a href="view_report.php" class="btn btn-primary">View Report</a>
      </div>
    </div>
  </div>
  <div class="col-md-4 mb-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Download Report</h5>
        <p class="card-text"></p>
        <a href="download.php" class="btn btn-primary">Download</a>
      </div>
    </div>
  </div>
  <div class="col-md-4 mb-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Upload Report</h5>
        <p class="card-text"></p>
        <a href="logout.php" class="btn btn-primary">Logout</a>
      </div>
    </div>
  </div>
  
  </div>
</div>
    <form method="POST" class="register-form">
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="church_id" placeholder="Church ID" required>
        <label>
            <input type="checkbox" name="baptized"> Baptized
        </label>
        <input type="text" name="phone_number" placeholder="Phone Number" required>
        <input type="text" name="ministry" placeholder="Ministry" required>
        <input type="text" name="category" placeholder="Category" required>
        <button type="submit">Register</button>
    </form>
</body>
</html>
