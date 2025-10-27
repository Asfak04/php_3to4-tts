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
                
                <form action="" class="w-50">

                    <div class="form-group mb-3">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" placeholder="Enter Name" name="name">
                    </div>

                    <div class="form-group mb-3">
                        <label for="leavetype">Leave Type:</label>
                        <select name="" id="" class="form-select">
                            <option value="" disabled>Select Leave Type</option>
                            <option value="">PD</option>
                            <option value="">LWP</option>
                            <option value="">Half Day</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-success w-100">Add Leave</button>
                    </div>
                </form>

            </div>
        </div>
    </section>

    <!-- footer -->
    <?php include_once("footer.php"); ?>
   
</body>

</html>