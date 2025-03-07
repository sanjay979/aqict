<?php

session_start();
if ($_SESSION['s_id'] && $_SESSION['position'] == 'iqac') {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add staff details</title>
        <link rel="stylesheet" type="text/css" href="StaffLogin.css">

        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    </head>

    <body>
        <?php include 'sidebar.php'; ?>
        <div class="main-content">
            <?php include 'header.php'; ?>
            <main>
                <h1>Add staff details</h1>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="fields">
                        <div class="input-field">
                            <label>Staff Name</label>
                            <input type="text" name="name" placeholder="Enter your name" required>
                        </div>
                        <div class="input-field">
                            <label>Staff Id</label>
                            <input type="text" name="id" placeholder="Enter Id" required>
                        </div>
                        <div class="input-field">
                            <label>Department</label>
                            <select name="department" required>
                                <option disabled selected>Select Department</option>
                                <option>Computer Science</option>
                                <option>Physics</option>
                                <option>Chemistry</option>
                                <option>botany</option>
                                <option>English</option>
                                <option>Data science</option>
                                <option>commerce</option>
                                <option>Economics</option>
                                <option>ELECTRONICS</option>
                                <option>MATHEMATICS</option>
                                <option>History</option>
                                <option>Information technology</option>
                                <option>B.com Honours</option>

                            </select>
                        </div>
                        <div class="input-field">
                            <label>Date of Birth</label>
                            <input type="date" name="dob" placeholder="DOB" required>
                        </div>
                        <div class="input-field">
                            <label>Shift</label>
                            <select name="shift" required>
                                <option disabled selected>Select shift</option>
                                <option>1</option>
                                <option>2</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <label>position</label>
                            <select name="position" required>
                                <option disabled selected>Select Position</option>
                                <option>staff</option>
                                <option>hod</option>
                                <option>iqac</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="submitBtn">
                        <span class="btnText">Submit</span>
                        <i class="uil uil-navigator"></i>
                    </button>
                </form>
            </main>
            <?php
            if (isset($_POST['submit'])) {
                include '../database/Databasedemo.php';

                $name = $_POST['name'];
                $id = $_POST['id'];
                $department = $_POST['department'];
                $dob = $_POST['dob'];
                $shift = $_POST['shift'];
                $position = $_POST['position'];
                $password = $_POST['password'];



                // Insert form data into the database
                $sql = "INSERT INTO faculty_details (name, s_id,department,dob,shift,position)
                    VALUES ('$name', '$id','$department','$dob','$shift','$position')";

                $login = "INSERT INTO login (s_id,password)
                VALUES ('$id','$password')";

                $fac_details = mysqli_query($conn, $sql);
                $fac_login = mysqli_query($conn, $login);
                if ($fac_details && $fac_login) {
                    echo "<script>alert('application submitted successfully.');window.location='./StaffLogin.php';</script>";
                } else {
                    echo "<script>alert('not submitted');window.location='./StaffLogin.php';</script>";
                }


                // $login = "INSERT INTO login (s_id,password)
                //     VALUES ('$id','$password')";

                // if ($conn->query($login) === TRUE) {
                //     echo "<script>alert('application submitted successfully.');window.location='./StaffLogin.php';</script>";
                // } else {
                //     echo "Error: " . $login . "<br>" . $conn->error;
                // }



                $conn->close();
            }
            ?>
        </div>
    </body>

    </html>
<?php
} else {
    header("location:../Login/home.php");
}
?>