<?php 
session_start();
require 'file/connection.php';
if(isset($_GET['search'])){
    $searchKey = $_GET['search'];
    $sql = "select bloodinfo.*, hospitals.* from bloodinfo, hospitals where bloodinfo.hid=hospitals.id && bg LIKE '%$searchKey%'";
}else{
    $sql = "select bloodinfo.*, hospitals.* from bloodinfo, hospitals where bloodinfo.hid=hospitals.id";
}
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin </title>
<?php require 'head.php'; ?>
</head>
<body>
    <!-- As a link -->
<nav class="navbar navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Admin Panel </a>
  <a class="nav-link btn btn-primary btn-sm font-weight-bold" href="adminLogout.php">Logout</a>

</nav>

<table class="table table-responsive table-striped rounded mb-5">
            <tr><th colspan="7" class="title">Available Blood Samples</th></tr>
            <tr>
                
                <th>Hospital Name</th>
                <th>Hospital City</th>
                <th>Hospital Email</th>
                <th>Hospital Phone</th>
                <th>Blood Group</th>
                <th>Action</th>
            </tr>

            <div>
                <?php
                if ($result) {
                    $row =mysqli_num_rows( $result);
                    if ($row) { //echo "<b> Total ".$row." </b>";
                }else echo '<b style="color:white;background-color:red;padding:7px;border-radius: 15px 50px;">Nothing to show.</b>';
            }
            ?>
            </div>

        <?php while($row = mysqli_fetch_array($result)) { ?>

            <tr>
                
                <td><?php echo $row['hname'];?></td>
                <td><?php echo ($row['hcity']); ?></td>
                <td><?php echo ($row['hemail']); ?></td>
                <td><?php echo ($row['hphone']); ?></td>
                <td><?php echo ($row['bg']); ?></td>
                <td><a href="file/deleteitem.php?id=<?php echo $row['id']?>"><button class="btn btn-primary">Delete</button></a></td>

                <!-- <?php $bid= $row['bid'];?>
                <?php $hid= $row['hid'];?>
                <?php $bg= $row['bg'];?>
                <form action="file/request.php" method="post">
                    <input type="hidden" name="bid" value="<?php echo $bid; ?>">
                    <input type="hidden" name="hid" value="<?php echo $hid; ?>">
                    <input type="hidden" name="bg" value="<?php echo $bg; ?>">

                <?php if (isset($_SESSION['hid'])) { ?>
                <td><a href="javascript:void(0);" class="btn btn-info hospital">Request Sample</a></td>
                <?php } else {(isset($_SESSION['rid']))  ?>
                <td><input type="submit" name="request" class="btn btn-info" value="Delete"></td>
                <?php } ?>
                
                </form> -->
            </tr>

        <?php } ?>
        </table>

<!-- As a heading -->

</body>
</html>