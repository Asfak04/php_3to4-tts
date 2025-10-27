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
                <div class="row d-flex justify-content-around">
                    <div class="col-md-5 shadow mt-4 p-3">
                        <div id="chart_div"></div>
                    </div>
                    <div class="col-md-5 mt-5">

                        <div class="card shadow mb-1">
                            <table>
                                <tr class="bg-white mt-4">
                                    <td><span class="bi bi-check-circle-fill text-success"></span> Present </td>
                                    <td align="right"><span class="bi bi-file-earmark text-success"></span> Export</td>
                                </tr>
                            </table>
                        </div>

                        <div class="card shadow mb-1">
                            <table>
                                <tr class="bg-white mt-4">
                                    <td><span class="bi bi-check-circle-fill text-success"></span> Present </td>
                                    <td align="right"><span class="bi bi-file-earmark text-success"></span> Export</td>
                                </tr>
                            </table>
                        </div>

                        <div class="card shadow mb-1">
                            <table>
                                <tr class="bg-white mt-4">
                                    <td><span class="bi bi-check-circle-fill text-success"></span> Present </td>
                                    <td align="right"><span class="bi bi-file-earmark text-success"></span> Export</td>
                                </tr>
                            </table>
                        </div>

                        <div class="card shadow mb-1">
                            <table>
                                <tr class="bg-white mt-4">
                                    <td><span class="bi bi-check-circle-fill text-success"></span> Present </td>
                                    <td align="right"><span class="bi bi-file-earmark text-success"></span> Export</td>
                                </tr>
                            </table>
                        </div>

                        <div class="card shadow mb-1">
                            <table>
                                <tr class="bg-white mt-4">
                                    <td><span class="bi bi-check-circle-fill text-success"></span> Present </td>
                                    <td align="right"><span class="bi bi-file-earmark text-success"></span> Export</td>
                                </tr>
                            </table>
                        </div>

                        <div class="card shadow mb-1">
                            <table>
                                <tr class="bg-white mt-4">
                                    <td><span class="bi bi-check-circle-fill text-success"></span> Present </td>
                                    <td align="right"><span class="bi bi-file-earmark text-success"></span> Export</td>
                                </tr>
                            </table>
                        </div>

                        <div class="card shadow mb-1">
                            <table>
                                <tr class="bg-white mt-4">
                                    <td><span class="bi bi-check-circle-fill text-success"></span> Present </td>
                                    <td align="right"><span class="bi bi-file-earmark text-success"></span> Export</td>
                                </tr>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <?php include_once("footer.php"); ?>
   
</body>

</html>