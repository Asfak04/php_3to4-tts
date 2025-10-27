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
                    <h2>Change Your Shify Here</h2>

                    <form action="">
                        <div class="mb-3 form-group">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" placeholder="Enter name" name="name" required>
                        </div>

                        <div class="mb-3 form-group">
                            <label for="email" class="form-label">Email:</label>
                            <input type="text" class="form-control" placeholder="Enter Email" name="email" required>
                        </div>

                        <div class="mb-3 form-group">
                            <label for="Select Shift" class="form-label"> Select Shift:</label>
                            <select class="form-select" >
                                <option value="" disabled> Select Shift</option>
                                <option value="">Moring 9:00am T0 5:30pm</option>
                                <option value="">Moring 7:30am T0 4:00pm</option>
                                <option value="">Moring 8:30am T0 5:00pm</option>
                                <option value="">Moring 10:00am T0 6:30pm</option>
                                <option value="">Moring 11:00am T0 7:00pm</option>
                            </select>                    
                        </div>

                        <div class="form-group mb-3">
                            <button class="btn btn-success w-100">Add Attandence</button>

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