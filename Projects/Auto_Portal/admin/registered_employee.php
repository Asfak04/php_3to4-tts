<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dash Board</title>

    <link rel="stylesheet" href="./css/style.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
</head>

<body>
    <!-- header -->
    <?php include_once("header.php");?>

    <!-- admin dash board -->

    <section id="admin_dashboard">
        <div class="row">
            <div class="col-md-3 shadow h-100 p-5">

            <?php include_once("sidemenu.php") ?>
            </div>

            <div class="col-md-9 p-5">
                <div class="row" >
                    <h2>Manage All Employees</h2>

                    <table class="table ms-4">
                        <tr>
                            <th>Name </th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Joining Date </th>
                            <th>Photo</th>
                            <th>Status</th>
                        </tr>

                        <tr  style="margin: auto !important; ">
                            <td>Aryan</td>
                            <td>aryan@gmail.com</td>
                            <td>9638527411</td>
                            <td>150 feet ring road</td>
                            <td>15-07-2025</td>
                            <td><img src="./images/admin.jpg" alt="" height="60px" width="60px" class="rounded-circle"></td>
                            <td>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                        </tr>

                        <tr>
                            <td>Aryan</td>
                            <td>aryan@gmail.com</td>
                            <td>9638527411</td>
                            <td>150 feet ring road</td>
                            <td>15-07-2025</td>
                            <td><img src="./images/admin.jpg" alt="" height="60px" width="60px" class="rounded-circle"></td>
                            <td>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                        </tr>

                        <tr>
                            <td>Aryan</td>
                            <td>aryan@gmail.com</td>
                            <td>9638527411</td>
                            <td>150 feet ring road</td>
                            <td>15-07-2025</td>
                            <td><img src="./images/admin.jpg" alt="" height="60px" width="60px" class="rounded-circle"></td>
                            <td>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                        </tr>

                        <tr>
                            <td>Aryan</td>
                            <td>aryan@gmail.com</td>
                            <td>9638527411</td>
                            <td>150 feet ring road</td>
                            <td>15-07-2025</td>
                            <td><img src="./images/admin.jpg" alt="" height="60px" width="60px" class="rounded-circle"></td>
                            <td>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                        </tr>

                        <tr>
                            <td>Aryan</td>
                            <td>aryan@gmail.com</td>
                            <td>9638527411</td>
                            <td>150 feet ring road</td>
                            <td>15-07-2025</td>
                            <td><img src="./images/admin.jpg" alt="" height="60px" width="60px" class="rounded-circle"></td>
                            <td>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <?php include_once("footer.php"); ?>
   
</body>

</html>