<?php
session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit();
}

include("../includes/config.php");

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="applications.csv"');

$output = fopen("php://output", "w");

fputcsv($output, array(
    "ID",
    "Pass ID",
    "Name",
    "Phone",
    "Source",
    "Destination",
    "Pass Type",
    "Status",
    "Expiry Date"
));

$result = mysqli_query($conn,"SELECT * FROM applications ORDER BY id DESC");

while($row=mysqli_fetch_assoc($result)){

    fputcsv($output,array(
        $row['id'],
        $row['pass_id'],
        $row['full_name'],
        $row['phone'],
        $row['source'],
        $row['destination'],
        $row['pass_type'],
        $row['status'],
        $row['expiry_date']
    ));

}

fclose($output);
exit();
?>