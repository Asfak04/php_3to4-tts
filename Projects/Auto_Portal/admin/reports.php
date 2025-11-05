<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Reports & Analytics</title>

  <!-- external css -->
  <link rel="stylesheet" href="./css/style.css" />


  <!-- Bootstrap CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet" />

  <!-- Bootstrap Icons -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
    rel="stylesheet" />

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- jsPDF -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

  <style>
    body {
      background-color: #f8f9fa;
      padding: 30px;
    }

    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .chart-container {
      position: relative;
      height: 380px !important;
      /* increased for better visibility */
      width: 100%;
      padding: 10px;
    }

    .btn-outline-primary {
      border-color: #0d6efd;
    }
  </style>
</head>

<body class="p-0">

  <?php include_once("header.php"); ?>
  <!-- admin dash board -->

  <section id="admin_dashboard">
    <div class="row">

      <div class="col-md-3 shadow p-5 sidebar" style="height: 100vh;">
        <?php include_once("sidemenu.php") ?>
      </div>
      <div class="col-md-9 p-5" style="height: 100vh; overflow-y: auto;">
        <div class="container pb-5 content">
          <!-- Header -->
          <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 ">
            <div class="mb-3 mb-md-0">
              <h2 class="fw-bold">Reports & Analytics</h2>
              <p class="text-muted">View performance metrics and insights</p>
            </div>
            <div class="d-flex gap-2">
              <!-- <button id="docBtn" class="btn btn-outline-primary">
                <i class="bi bi-download"></i> Project Documentation
              </button> -->
              <button id="reportBtn" class="btn btn-success">
                <i class="bi bi-download"></i> Analytics Report
              </button>
            </div>
          </div>

          <!-- Stats Cards -->
          <div class="row g-3 mb-4">
            <div class="col-sm-6 col-lg-3">
              <div class="card text-center p-3">
                <h6 class="text-muted">Total Revenue</h6>
                <h3 id="totalRevenue" class="fw-bold text-primary">$0</h3>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card text-center p-3">
                <h6 class="text-muted">Total Vehicles</h6>
                <h3 id="totalVehicles" class="fw-bold text-success">0</h3>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card text-center p-3">
                <h6 class="text-muted">Active Listings</h6>
                <h3 id="activeListings" class="fw-bold text-info">0</h3>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card text-center p-3">
                <h6 class="text-muted">Total Sellers</h6>
                <h3 id="totalSellers" class="fw-bold text-warning">0</h3>
              </div>
            </div>
          </div>

          <!-- Charts -->
          <div class="card mb-4">
            <div class="card-header fw-bold bg-white">Monthly Sales</div>
            <div class="card-body">
              <div class="chart-container">
                <canvas id="salesChart"></canvas>
              </div>
            </div>
          </div>

          <div class="card mb-4">
            <div class="card-header fw-bold bg-white">Monthly Listings</div>
            <div class="card-body">
              <div class="chart-container">
                <canvas id="listingsChart"></canvas>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    </div>
  </section>

  <?php include_once("footer.php"); ?>


  <script>
    const {
      jsPDF
    } = window.jspdf;

    // Mock data
    const stats = {
      totalRevenue: 230000,
      totalVehicles: 320,
      totalSellers: 25,
      activeListings: 76
    };

    const monthlyData = [{
        month: "Jan",
        sales: 18000,
        listings: 20
      },
      {
        month: "Feb",
        sales: 22000,
        listings: 25
      },
      {
        month: "Mar",
        sales: 25000,
        listings: 30
      },
      {
        month: "Apr",
        sales: 27000,
        listings: 40
      },
      {
        month: "May",
        sales: 35000,
        listings: 35
      },
      {
        month: "Jun",
        sales: 40000,
        listings: 45
      }
    ];

    // Display stats
    document.getElementById("totalRevenue").textContent = "$" + stats.totalRevenue.toLocaleString();
    document.getElementById("totalVehicles").textContent = stats.totalVehicles;
    document.getElementById("activeListings").textContent = stats.activeListings;
    document.getElementById("totalSellers").textContent = stats.totalSellers;

    // Line Chart for Sales
    new Chart(document.getElementById("salesChart"), {
      type: "line",
      data: {
        labels: monthlyData.map((d) => d.month),
        datasets: [{
          label: "Sales ($)",
          data: monthlyData.map((d) => d.sales),
          borderColor: "#0d6efd",
          backgroundColor: "rgba(13,110,253,0.1)",
          tension: 0.3,
          fill: true,
          pointRadius: 4
        }]
      },
      options: {
        maintainAspectRatio: false,
        responsive: true,
        plugins: {
          legend: {
            display: false
          },
          tooltip: {
            mode: "index",
            intersect: false
          }
        },
        scales: {
          x: {
            grid: {
              display: false
            }
          },
          y: {
            beginAtZero: true
          }
        }
      }
    });

    // Bar Chart for Listings
    new Chart(document.getElementById("listingsChart"), {
      type: "bar",
      data: {
        labels: monthlyData.map((d) => d.month),
        datasets: [{
          label: "Listings",
          data: monthlyData.map((d) => d.listings),
          backgroundColor: "#198754"
        }]
      },
      options: {
        maintainAspectRatio: false,
        responsive: true,
        plugins: {
          legend: {
            display: false
          },
          tooltip: {
            mode: "index",
            intersect: false
          }
        },
        scales: {
          x: {
            grid: {
              display: false
            }
          },
          y: {
            beginAtZero: true
          }
        }
      }
    });

    // PDF buttons
    document.getElementById("reportBtn").addEventListener("click", () => {
      const doc = new jsPDF();
      doc.setFontSize(18);
      doc.text("AutoPortal Analytics Report", 20, 20);
      doc.setFontSize(12);
      doc.text(`Generated on: ${new Date().toLocaleDateString()}`, 20, 30);
      doc.text(`Total Revenue: $${stats.totalRevenue.toLocaleString()}`, 20, 45);
      doc.text(`Total Vehicles: ${stats.totalVehicles}`, 20, 53);
      doc.text(`Active Listings: ${stats.activeListings}`, 20, 61);
      doc.text(`Total Sellers: ${stats.totalSellers}`, 20, 69);
      doc.save("AutoPortal-Analytics-Report.pdf");
    });

    document.getElementById("docBtn").addEventListener("click", () => {
      const doc = new jsPDF();
      doc.setFontSize(18);
      doc.text("AutoPortal Project Documentation", 20, 20);
      doc.setFontSize(12);
      doc.text(`Generated on: ${new Date().toLocaleDateString()}`, 20, 30);
      doc.text("Modules:", 20, 45);
      const items = [
        "Dashboard Overview",
        "Reports & Analytics",
        "Vehicle Management",
        "Seller Management",
        "PDF Report Generator"
      ];
      let y = 53;
      items.forEach(item => {
        doc.text("- " + item, 25, y);
        y += 8;
      });
      doc.save("AutoPortal-Documentation.pdf");
    });
  </script>
</body>

</html>