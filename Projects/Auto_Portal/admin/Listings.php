<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vehicle Listings</title>

  <link rel="stylesheet" href="./css/style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      /* font-family: 'Inter', sans-serif; */
    }

    .page-title {
      font-weight: 700;
      color: #212529;
    }

    .card {
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .table th {
      background-color: #f1f3f5;
      color: #495057;
      font-weight: 600;
    }

    .btn-action {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 36px;
      height: 36px;
      border-radius: 8px;
      border: 1px solid #dee2e6;
      background-color: white;
      transition: all 0.2s ease-in-out;
    }

    .btn-action:hover {
      background-color: #f1f3f5;
      transform: scale(1.05);
    }

    .btn-action i {
      font-size: 1rem;
      color: #495057;
    }

    .btn-action.delete:hover i {
      color: #dc3545;
    }

    .btn-action.edit:hover i {
      color: #0d6efd;
    }

    .modal-content {
      border-radius: 12px;
    }
  </style>
</head>

<body>

  <?php include_once("header.php"); ?>
  <!-- admin dash board -->

  <section id="admin_dashboard">
    <div class="row">

      <div class="col-md-3 shadow p-5" style="height: 100vh;">
        <?php include_once("sidemenu.php") ?>
      </div>
      <div class="col-md-9 p-5">
        <div class="container p-0">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
              <h2 class="fw-bold">Vehicle Listings</h2>
              <p class="text-muted">Manage all vehicle listings</p>
            </div>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addListingModal">
              <i class="bi bi-plus-lg me-2"></i>Add Listing
            </button>
          </div>

          <div class="card">
            <div class="card-header bg-white">
              <h5 class="mb-0 fw-bold">All Listings</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table align-middle">
                  <thead>
                    <tr>
                      <th>Vehicle</th>
                      <th>Make/Model</th>
                      <th>Year</th>
                      <th>Price</th>
                      <th>Seller</th>
                      <th>Status</th>
                      <th class="text-end">Actions</th>
                    </tr>
                  </thead>
                  <tbody id="vehicleTableBody">
                    <!-- Dynamic rows inserted by JS -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- Add Listing Modal -->
        <div class="modal fade" id="addListingModal" tabindex="-1" aria-labelledby="addListingModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content p-3">
              <div class="modal-header">
                <h5 class="modal-title" id="addListingModalLabel">Add New Listing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <form id="addListingForm">
                  <div class="mb-3">
                    <label class="form-label">Vehicle Name</label>
                    <input type="text" class="form-control" id="vehicleName" placeholder="2024 Toyota Camry" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" id="vehicleDesc" placeholder="Enter vehicle description" required></textarea>
                  </div>
                  <div class="text-end">
                    <button type="submit" class="btn btn-primary w-100">Create Listing</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    </div>
  </section>

  <?php include_once("footer.php"); ?>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const vehicles = [{
        name: "Tesla Model 3",
        make: "Tesla",
        model: "Model 3",
        year: 2024,
        price: 48000,
        seller: "EV Motors",
        status: "active"
      },
      {
        name: "Toyota Corolla",
        make: "Toyota",
        model: "Corolla",
        year: 2022,
        price: 21000,
        seller: "AutoHub",
        status: "pending"
      },
      {
        name: "BMW X5",
        make: "BMW",
        model: "X5",
        year: 2023,
        price: 69000,
        seller: "LuxuryCars",
        status: "sold"
      }
    ];

    const tbody = document.getElementById("vehicleTableBody");

    function renderVehicles() {
      tbody.innerHTML = "";
      vehicles.forEach((v, i) => {
        const row = document.createElement("tr");
        row.innerHTML = `
          <td class="fw-semibold">${v.name}</td>
          <td>${v.make} ${v.model}</td>
          <td>${v.year}</td>
          <td>$${v.price.toLocaleString()}</td>
          <td>${v.seller}</td>
          <td>
            <select class="form-select form-select-sm w-auto status-select" data-index="${i}">
              <option value="active" ${v.status === "active" ? "selected" : ""}>Active</option>
              <option value="pending" ${v.status === "pending" ? "selected" : ""}>Pending</option>
              <option value="sold" ${v.status === "sold" ? "selected" : ""}>Sold</option>
            </select>
          </td>
          <td class="text-end">
            <div class="d-inline-flex gap-2">
              <button class="btn-action edit" title="Edit"><i class="bi bi-pencil"></i></button>
              <button class="btn-action delete" title="Delete" onclick="deleteVehicle(${i})"><i class="bi bi-trash"></i></button>
            </div>
          </td>
        `;
        tbody.appendChild(row);
      });
    }

    function deleteVehicle(index) {
      if (confirm("Are you sure you want to delete this listing?")) {
        vehicles.splice(index, 1);
        renderVehicles();
      }
    }

    document.addEventListener("change", (e) => {
      if (e.target.classList.contains("status-select")) {
        const index = e.target.dataset.index;
        vehicles[index].status = e.target.value;
      }
    });

    document.getElementById("addListingForm").addEventListener("submit", (e) => {
      e.preventDefault();
      const name = document.getElementById("vehicleName").value;
      const desc = document.getElementById("vehicleDesc").value;
      vehicles.push({
        name: name,
        make: "New",
        model: "Vehicle",
        year: new Date().getFullYear(),
        price: 0,
        seller: "New Seller",
        status: "pending"
      });
      renderVehicles();
      e.target.reset();
      bootstrap.Modal.getInstance(document.getElementById("addListingModal")).hide();
    });

    renderVehicles();
  </script>
</body>

</html>