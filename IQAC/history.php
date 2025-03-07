<?php
session_start();
if ($_SESSION['s_id'] && $_SESSION['position'] == 'iqac') {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Filter Data</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
            }

            .main-content-inner {
                border-collapse: collapse;
            }

            .data_table {
                margin-top: 30px;
            }

            .filter-box {
                border: 1px solid #ddd;
                border-radius: 5px;
                padding: 10px;
                background-color: #fff;
                margin-bottom: 15px;
            }

            .filter-box label {
                font-weight: bold;
            }

            .leave-type-options {
                display: none;
            }

            .leave-type-options.active {
                display: block;
            }

            @media (max-width: 576px) {
                .data_table {
                    margin-left: 0;
                }

                #filters {
                    padding: 15px;
                }

                #search-input {
                    margin-top: 10px;
                }
            }

            @media (min-width: 576px) {
                .text-right {
                    text-align: right !important;
                }

                /* Additional CSS for filter box */
                .form-group {
                    margin-bottom: 10px;
                }

                .col-form-label {
                    padding-top: 8px;
                    padding-right: 16px;
                    text-align: right;
                }

                .form-control {
                    display: block;
                    width: 100%;
                    padding: 0.375rem 0.75rem;
                    font-size: 1rem;
                    line-height: 1.5;
                    color: #495057;
                    background-color: #fff;
                    background-clip: padding-box;
                    border: 1px solid #ced4da;
                    border-radius: 0.25rem;
                    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                }

                .form-control:focus {
                    color: #495057;
                    background-color: #fff;
                    border-color: #80bdff;
                    outline: 0;
                    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
                }

                /* Additional CSS for table design */
                .data_table {
                    background-color: #ffffff;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }

                th {
                    background-color: #f7f7f7;
                    font-weight: bold;
                }

                td {
                    background-color: #fff;
                }

                tr:nth-child(even) td {
                    background-color: #f2f2f2;
                }

                /* Additional CSS for filter options */
                #fetchval,
                #leavetype {
                    width: 100%;
                    padding: 5px;
                }

                .form-control:focus {
                    color: #495057;
                    background-color: #fff;
                    border-color: #80bdff;
                    outline: 0;
                    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);

                }
            }
        </style>

    </head>

    <body>
        <?php include 'sidebar.php'; ?>
        <div class="main-content">
            <?php include 'header.php' ?>
            <main>
                <div class="filter-box">
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group row">
                                <label for="fetchval" class="col-sm-4 col-form-label">Sort by:</label>
                                <div class="col-sm-8">
                                    <select name="fetchval" id="fetchval" class="form-control">
                                        <option value="all">All</option>
                                        <option value="hours" selected>Last 24 hours</option>
                                        <option value="week">Last 1 week</option>
                                        <option value="month">Last 1 month</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group row">
                                <label for="leavetype" class="col-sm-4 col-form-label">Leave Type:</label>
                                <div class="col-sm-8">
                                    <select name="leavetype" id="leavetype" class="form-control">
                                        <option value="all">All</option>
                                        <option value="cl" class="leave-type-options active">CL</option>
                                        <option value="ml" class="leave-type-options active">ML</option>
                                        <option value="od" class="leave-type-options active">OD</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 text-md-right mt-3 mt-md-0">
                            <div class="form-group row">
                                <label for="search-input" class="col-sm-4 col-form-label d-block d-md-inline">Staff ID:</label>
                                <div class="col-sm-8">
                                    <input type="text" id="search-input" placeholder="Search Staff ID..." class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="table-container" class="data_table">
                    <table id="data-table" class="table">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Staff Name</th>
                                <th>Staff ID</th>
                                <th>Leave Type</th>
                                <th>Applied On</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <div class="alert alert-info" role="alert" id="empty-message" style="display: none;">
                        Sorry! No records found.
                    </div>
                </div>

                <script type="text/javascript">
                    $(document).ready(function() {
                        function fetchFilteredData(filterValue, searchValue, leaveTypeValue) {
                            $.ajax({
                                url: "leave.php",
                                type: "POST",
                                data: {
                                    request: filterValue,
                                    search: searchValue,
                                    leavetype: leaveTypeValue
                                },
                                beforeSend: function() {
                                    $("#table-container").html("<span>Loading...</span>");
                                },
                                success: function(data) {
                                    $("#table-container").html(data);
                                },
                                error: function() {
                                    $("#table-container").html("<span>Error occurred while fetching data.</span>");
                                }
                            });
                        }

                        function updateFilters() {
                            var filterValue = $("#fetchval").val();
                            var searchValue = $("#search-input").val();
                            var leaveTypeValue = $("#leavetype").val();

                            fetchFilteredData(filterValue, searchValue, leaveTypeValue);
                        }

                        fetchFilteredData("hours", "", "all"); // Fetch initial data for last 24 hours and all leave types

                        $("#fetchval").on('change', updateFilters);

                        $("#leavetype").on('change', updateFilters);

                        $("#search-input").on("keyup", updateFilters);
                    });
                </script>
            </main>
        </div>
    </body>

    </html>

<?php
} else {
    header("location:../Login/home.php");
}
?>