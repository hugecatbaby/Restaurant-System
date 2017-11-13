<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, shrink-to-fit=no">
    <!-- <meta name="description" content="">
    <meta name="author" content=""> -->
    
    <title>Signin Template for Bootstrap</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="user-man.css" rel="stylesheet">
    
    <script src="lib/jquery-3.2.1.min.js"></script>
    <script src="mindmup-editabletable.js"></script>
    <script src="numeric-input-example.js"></script>
    <script src="table-sort.js"></script>
    <script src="operation.js"></script>
    
</head>

<body>

<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand mr-auto" href="#">Home</a>

    <form class="form-inline"> <!-- mt-2 mt-md-0 -->
      <input class="form-control mr-sm-2" type="text" placeholder="Search by username" aria-label=" Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    <button type="button" class="btn btn-warning"><img src="icon/log-out.svg"> Logout </button>
  </nav>
</header>
<h2>User Management</h2>


<div class="container">
  <div class="hero-unit">
     <table id="mainTable" class="table table-striped">
         <thead><tr>
            <th onclick="columnSort(0)" value="0">ID <img id="asc"></th>
             <th onclick="columnSort(1)" value="0">Firstname <img id="asc"></th>
             <th onclick="columnSort(2)" value="0">Lastname <img id="asc"></th>
             <th onclick="columnSort(3)" value="0">Age<img id="asc"></th>
             <th onclick="columnSort(4)" value="0">Username <img id="asc"></th>
             <th onclick="columnSort(5)" value="0">Password<img id="asc"></th>
             <th onclick="columnSort(6)" value="0">Contact Number<img id="asc"></th>
             <th onclick="columnSort(7)" value="0">Position<img id="asc"></th>
        </tr></thead>
         <tbody>
<?php

// echo "<table style='border: solid 1px black;'>";
// echo "<tr><th>ID</th><th>Firstname</th><th>Lastname</th><th>Age</th><th>Username</th><th>Password</th><th>Contact Number</th><th>Position</th></tr>";

class TableRows extends RecursiveIteratorIterator {
    function __construct($it){
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current(){
        return "<td>".parent::current()."</td>";
    }
    function beginChildren(){
        echo "<tr>";
    }
    function endChildren(){
        echo "</tr>"."\n";
    }
}

$servername="localhost";
$username = "user1";
$password = "123456";
$dbname = "myDBPDO";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("select ID, Fname, LName, Age, Username, Password, `Contact Number`, Position from User");
    $stmt->execute();   // $stmt = PDOStatement class

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); // return associated array
    // create html table
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll() )) as $k=>$v){
        echo $v;
    }

    // echo "success";

} catch (PDOException $e){
    echo $e->getMessage();
}
$conn = null;
// echo "</table>";

?>
</tbody>
<!-- <tfoot><tr><th><strong>TOTAL</strong></th><th></th><th></th><th></th></tr></thead> -->
</table>
</div>
</div>
<!-- <button type="button" id="updateBtn">Update</button><br> -->
<!-- <button type="button" id="addBtn">Add Row</button><br> -->
<!-- <button type="button" id="delBtn">Delete Row</button> -->

<datalist id="productName">
    <option value="Drink">Drink</option>
    <option value="Sides">Sides</option>
    <option value="Noodle">Noodle</option>
</datalist>


<footer class="footer">
    <div class="container">
        <button class="btn btn-info" id="addBtn">Add User</button>
        <button type="button" class="btn btn-primary" id="updateBtn">Update</button><br>
    </div>
</footer>

<script>
$('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
</script>

</body>
</html>