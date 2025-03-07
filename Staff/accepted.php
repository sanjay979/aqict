<?php

session_start();
if ($_SESSION['s_id'] && $_SESSION['position'] == 'staff') {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="accepted.css">
        <link rel="stylesheet" href="accepted1.css">
        <title>History of Applications</title>
    </head>

    <body>
        <?php include "Sidebar.php"; ?>
        <div class="main-content">
            <?php include "header.php"; ?>
            <main>
            <h2>Pre-leave History</h2>
                <?php include("..//database/Databasedemo.php");
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $id = $_SESSION['s_id'];


                $sql = "SELECT * FROM faculty1 WHERE id='$id' and (principal=1 or hod=0 or aqict=0 or principal=0)";
                $result = mysqli_query($conn, $sql);
                // Generate the HTML table
                $html = '<div class="table-responsive">';
                $html .= '<table class="table table-striped table-bordered">';
                $html .= '<thead class="thead-dark">';
                $html .= '<tr>';
                $html .= '<th>S.N</th>';
                $html .= '<th>Staff Name</th>';
                $html .= '<th>Staff ID</th>';
                $html .= '<th>Leave Type</th>';
                $html .= '<th>shift</th>';
                $html .= '<th>Start Date</th>';
                $html .= '<th>End Date</th>';
                $html .= '<th>No of Days</th>';
                $html .= '<th>Reason</th>';
                $html .= '<th>Document</th>';
                $html .= '<th>Status</th>';

                $html .= '</tr>';
                $html .= '</thead>';
                $html .= '<tbody>';

                $serialNumber = 1; // Initialize the serial number

                while ($row = mysqli_fetch_assoc($result)) {
                    $html .= '<tr id="row_' . $row['application_id'] . '">';
                    $html .= '<td>' . $serialNumber . '</td>'; // Add the serial number column
                    $html .= '<td>' . $row['name'] . '</td>';
                    $html .= '<td>' . $row['id'] . '</td>';
                    $html .= '<td>' . $row['LType'] . '</td>';
                    $html .= '<td>' . $row['shift'] . '</td>';
                    $html .= '<td>' . $row['start'] . '</td>';
                    $html .= '<td>' . $row['end'] . '</td>';
                    $html .= '<td>' . $row['ndays'] . '</td>';

                    $html .= '<td>' . $row['reason'] . '</td>';

                    $html .= '<td>';

                    if (!empty($row['file'])) {
                        $html .= '<a href="' . $row['file'] . '" target="_blank">View File</a>';
                    } else {
                        $html .= 'No File Available';
                    }
                    $html .= '</td>';
                    $html .= '<td>';
                    if($row['principal']==1){
                    $html .= '<p class="completed">completed</p>';
                    }elseif ($row['hod']==0) {
                        $html .= '<p class="rejected" >Rejected by HOD</p>';
                    }elseif ($row['aqict']==0) {
                        $html .= '<p class="rejected" >Rejected by IQAC</p>';
                    }elseif ($row['principal']==0) {
                        $html .= '<p class="rejected" >Rejected by Principal</p>';
                    }else{
                        $html .= '<p>Rejected</p>';
                    }
                    $html .= '</td>';

                    $html .= '</tr>';

                    $serialNumber++; // Increment the serial number
                }

                $html .= '</tbody>';
                $html .= '</table>';
                $html .= '</div>';

                // Output the generated HTML table
                echo $html;

                ?>
            </main>
        </div>
    </body>

    </html>
<?php
} else {
    header("location:../Login/home.php");
}
?>