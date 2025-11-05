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
                <div class="row w-50">
                    <h2>Registation Form</h2>

                    <form action="">
                        <div class="mb-3 form-group">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" placeholder="Enter name" name="name">
                        </div>

                        <div class="mb-3 form-group">
                            <label for="email" class="form-label">Email:</label>
                            <input type="text" class="form-control" placeholder="Enter Email" name="email">
                        </div>

                        <div class="mb-3 form-group">
                            <label for="phone_number" class="form-label">Phone Number:</label>
                            <input type="text" class="form-control" placeholder="Enter Phone Number" name="phone_number">
                        </div>

                        <div class="mb-3 form-group">
                            <label for="pincode" class="form-label">Pincode:</label>
                            <input type="text" class="form-control" placeholder="Enter Pincode" name="pincode">
                        </div>

                        <div class="mb-3 form-group">
                            <label for="address" class="form-label">Address:</label>
                            <textarea name="address" class="form-control"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <button class="btn btn-success w-100">Add Registration</button>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>

    <!-- footer -->
    <?php include_once("footer.php"); ?>
   
</body>

</html>