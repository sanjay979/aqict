<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
    <title>HOD Profile</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Goblin+One&display=swap" rel="stylesheet">
    <!--font2 -->
    <script src="https://kit.fontawesome.com/668b4cc612.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="Hodsidebar.css">
    <link rel="stylesheet" type="text/css" href="../Staff/sidebar.css">
</head>

<body>
    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <?php $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1) ?>
        <div class="sidebar-head">
            <h2><span><img src="../assets/About_logo-removebg-preview.png" height="100px" width="120px" ;></span></h2>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li><a href="index.php" class="<?= $page == 'index.php' ? 'active' : '' ?>"><span class="las la-igloo"></span> <span>Dashboard</span></a></li>
                <?php
                $aposition = $_SESSION['aposition'];
                if ($aposition == 'Active') {
                } else {
                    echo '<li><a href="profile.php" class="<?= $page == \'profile.php\' ? \'active\' : \'\' ?>"><span class="las la-user"></span><span>Profile</span> </a></li>';
                    echo '<li><a href="leaveform.php" class="<?= $page == \'leaveform.php\' ? \'active\' : \'\' ?>"><span class="las la-clipboard-list"></span><span>Apply Leave</span> </a></li>';
                }
                ?>
                <li><a href="ApproveForm.php" class="<?= $page == 'ApproveForm.php' ? 'active' : '' ?>"><span class="las la-receipt"></span> <span>Leave Requests</span></a></li>
                <?php
                $aposition = $_SESSION['aposition'];
                if ($aposition == 'Active') {
                } else {
                    echo '<li><a href="pending.php" class="<?= $page == \'pending.php\' ? \'active\' : \'\' ?>"><span class="las la-receipt"></span> <span>Pending</span></a></li>';
                }
                ?>
                <li><a class="dropdown-btn"><span class="fa fa-backward"></span> &nbsp;<span>Pre-Leave <i class="fa fa-caret-down"></i></span> </a>
                    <ul class="dropdown-content">
                        <a href="leaveform.php" class="<?= $page == 'leaveform.php' ? 'active' : '' ?>"><span class="las la-clipboard-list"></span><span>Apply Leave</span> </a>
                        <a href="pending.php" class="<?= $page == 'pending.php' ? 'active' : '' ?>"><span class="las la-receipt"></span> <span>Pending</span></a>
                        <a href="accepted.php" class="<?= $page == 'accepted.php' ? 'active' : '' ?>"><span class="fa fa-history"></span><span>History</span></a>
                    </ul>
                </li>
                <li><a class="dropdown-btn"><span class="fa fa-forward"></span> &nbsp;<span>Post-Leave <i class="fa fa-caret-down"></i></span> </a>
                    <ul class="dropdown-content">

                        <a href="apply.php" class="<?= $page == 'apply.php' ? 'active' : '' ?>"><span class="fa fa-history"></span><span>To Apply</span></a>
                        <a href="postleave.php" class="<?= $page == 'postleave.php' ? 'active' : '' ?>"><span class="las la-clipboard-list"></span><span>Apply Leave</span> </a>
                        <a href="post_pending.php" class="<?= $page == 'post_pending.php' ? 'active' : '' ?>"><span class="las la-receipt"></span> <span>Pending</span></a>
                        <a href="history.php" class="<?= $page == 'history.php' ? 'active' : '' ?>"><span class="fa fa-history"></span><span>History</span></a>
                    </ul>
                </li>
                <li><a href="WaitingForms.php" class="<?= $page == 'WaitingForms.php' ? 'active' : '' ?>"><span class="las la-receipt"></span> <span>Waiting</span></a></li>
                <?php
                $aposition = $_SESSION['aposition'];
                if ($aposition == 'Active') {
                } else {
                    echo '<li><a href="ChangeHod.php" class="<?= $page == \'ChangeHod.php\' ? \'active\' : \'\' ?>"><span class="las la-receipt"></span> <span>ChangeHod</span></a></li>';
                }
                ?>
                <li><a href="../Login/logout.php" class=""><span class="las la-igloo"></span> <span>Logout</span></a></li>

            </ul>
        </div>
    </div>




</body>

</html>