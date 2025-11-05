<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Seller Management Dashboard</title>

  <!-- external css -->
  <link rel="stylesheet" href="./css/style.css" />

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

  <style>
    body {
      background-color: #f8fafc;
      /* font-family: "Poppins", sans-serif; */
      color: #111827;
    }

    /* .page-header {
      background: linear-gradient(135deg, #2563eb, #4f46e5);
      color: #fff;
      padding: 2rem;
      border-radius: 14px;
      box-shadow: 0 8px 20px rgba(37, 99, 235, 0.2);
    } */

    /* .page-header h1 {
      font-weight: 700;
    } */

    .card {
      border: none;
      border-radius: 14px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
    }

    .table th {
      background-color: #f1f5f9;
      font-weight: 600;
      color: #374151;
    }

    .table td {
      vertical-align: middle;
    }

    .search-bar {
      position: relative;
    }

    .search-bar input {
      padding-left: 2.5rem;
      border-radius: 10px;
    }

    .search-bar i {
      position: absolute;
      top: 50%;
      left: 10px;
      transform: translateY(-50%);
      color: #6b7280;
    }

    .btn {
      border-radius: 10px;
    }

    .status-active {
      background: #dcfce7;
      color: #16a34a;
      font-weight: 500;
      padding: 4px 10px;
      border-radius: 6px;
    }

    .status-suspended {
      background: #fee2e2;
      color: #b91c1c;
      font-weight: 500;
      padding: 4px 10px;
      border-radius: 6px;
    }

    .rating {
      color: #facc15;
      font-size: 1.1rem;
    }

    .hover-row:hover {
      background: #f9fafb;
      transform: scale(1.01);
      transition: 0.2s ease-in-out;
    }
  </style>
</head>

<body class="p-0">

  <?php include_once("header.php"); ?>
  <!-- admin dash board -->

  <section id="admin_dashboard">
    <div class="row">

      <div class="col-md-3 shadow p-5" style="height: 100vh;">
        <?php include_once("sidemenu.php") ?>
      </div>
      <div class="col-md-9 p-5">
        <div class="container p-0">
          <!-- Header -->
          <div class=" mb-5 text-center text-md-start">
            <h2 class="fw-bold"> Seller Management</h2>
            <p class="mb-0 opacity-75">Manage all registered sellers in one place</p>
          </div>

          <!-- Top Controls -->
          <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
            <div class="search-bar flex-grow-1 me-2">
              <i class="bi bi-search"></i>
              <input type="text" id="searchInput" class="form-control" placeholder="Search sellers...">
            </div>
            <button class="btn btn-outline-secondary">
              <i class="bi bi-funnel me-2"></i> Filter
            </button>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSellerModal">
            <i class="bi bi-plus me-1"></i> Add Seller
        </button>
          </div>

          <!-- Seller Table -->
          <div class="card">
            <div class="card-body table-responsive">
              <table class="table align-middle text-center" id="sellerTable">
                <thead>
                  <tr>
                    <th>Seller Name</th>
                    <th>Contact</th>
                    <th>Total Vehicles</th>
                    <th>Active Listings</th>
                    <th>Total Sales</th>
                    <th>Rating</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Dummy Sellers -->
                  <tr class="hover-row">
                    <td><strong>John Doe</strong></td>
                    <td>
                      <div><i class="bi bi-envelope me-1"></i> john@example.com</div>
                      <div><i class="bi bi-telephone me-1"></i> +91 9876543210</div>
                    </td>
                    <td>18</td>
                    <td>12</td>
                    <td><strong>$52,400</strong></td>
                    <td><span class="rating">4.8 ★</span></td>
                    <td>
                      <select class="form-select form-select-sm status-select">
                        <option value="active" selected>Active</option>
                        <option value="suspended">Suspended</option>
                      </select>
                    </td>
                    <td>
                      <button class="btn btn-sm btn-outline-primary">View</button>
                    </td>
                  </tr>

                  <tr class="hover-row">
                    <td><strong>Sarah Smith</strong></td>
                    <td>
                      <div><i class="bi bi-envelope me-1"></i> sarah@auto.com</div>
                      <div><i class="bi bi-telephone me-1"></i> +91 9545123456</div>
                    </td>
                    <td>22</td>
                    <td>18</td>
                    <td><strong>$84,900</strong></td>
                    <td><span class="rating">4.9 ★</span></td>
                    <td>
                      <select class="form-select form-select-sm status-select">
                        <option value="active">Active</option>
                        <option value="suspended" selected>Suspended</option>
                      </select>
                    </td>
                    <td>
                      <button class="btn btn-sm btn-outline-primary">View</button>
                    </td>
                  </tr>

                  <tr class="hover-row">
                    <td><strong>Elon Mars</strong></td>
                    <td>
                      <div><i class="bi bi-envelope me-1"></i> elon@marsmail.com</div>
                      <div><i class="bi bi-telephone me-1"></i> +91 8001234567</div>
                    </td>
                    <td>14</td>
                    <td>10</td>
                    <td><strong>$40,200</strong></td>
                    <td><span class="rating">4.6 ★</span></td>
                    <td>
                      <select class="form-select form-select-sm status-select">
                        <option value="active" selected>Active</option>
                        <option value="suspended">Suspended</option>
                      </select>
                    </td>
                    <td>
                      <button class="btn btn-sm btn-outline-primary">View</button>
                    </td>
                  </tr>

                  <tr class="hover-row">
                    <td><strong>Alex Turner</strong></td>
                    <td>
                      <div><i class="bi bi-envelope me-1"></i> alex@carmart.com</div>
                      <div><i class="bi bi-telephone me-1"></i> +91 9090909090</div>
                    </td>
                    <td>9</td>
                    <td>7</td>
                    <td><strong>$25,800</strong></td>
                    <td><span class="rating">4.3 ★</span></td>
                    <td>
                      <select class="form-select form-select-sm status-select">
                        <option value="active">Active</option>
                        <option value="suspended" selected>Suspended</option>
                      </select>
                    </td>
                    <td>
                      <button class="btn btn-sm btn-outline-primary">View</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          
        </div>

      </div>
    </div>

    </div>


    <!-- Add Seller Modal -->
<div class="modal fade" id="addSellerModal" tabindex="-1" aria-labelledby="addSellerLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="addSellerForm" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSellerLabel">Add New Seller</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            <label for="business_name" class="form-label">Business Name *</label>
            <input type="text" class="form-control" id="business_name" name="business_name" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add Seller</button>
      </div>
    </form>
  </div>
</div>
  </section>

  <?php include_once("footer.php"); ?>



  <script>
    // Filter/Search Functionality
    document.getElementById("searchInput").addEventListener("input", function() {
      const query = this.value.toLowerCase();
      document.querySelectorAll("#sellerTable tbody tr").forEach((row) => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(query) ? "" : "none";
      });
    });

    // Status change feedback
    document.querySelectorAll(".status-select").forEach((select) => {
      select.addEventListener("change", () => {
        const status = select.value;
        const row = select.closest("tr");
        row.querySelector(".status-active, .status-suspended")?.remove();
        const badge = document.createElement("span");
        badge.textContent = status.charAt(0).toUpperCase() + status.slice(1);
        badge.className = status === "active" ? "status-active" : "status-suspended";
        select.after(badge);
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>