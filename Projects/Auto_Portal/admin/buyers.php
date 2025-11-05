<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Buyers Management</title>

  <link rel="stylesheet" href="./css/style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8f9fa;
    }

    .card {
      border-radius: 1rem;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }

    .table thead {
      background-color: #f1f3f5;
    }

    .btn-icon {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 36px;
      height: 36px;
      border-radius: 50%;
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

        <div class="container">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
              <h2 class="fw-bold">Buyers</h2>
              <p class="text-muted mb-0">Manage your buyers</p>
            </div>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addBuyerModal">
              <i class="bi bi-plus-lg me-1"></i> Add Buyer
            </button>
          </div>

          <div class="card">
            <div class="card-header">
              <h5 class="card-title mb-0">All Buyers</h5>
              <p class="text-muted small mb-0">View and manage all registered buyers</p>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table align-middle">
                  <thead>
                    <tr>
                      <th>Business Name</th>
                      <th>Contact Email</th>
                      <th>Phone</th>
                      <th>Purchases</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody id="buyersTable">
                    <!-- Dynamic rows -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- Add Buyer Modal -->
        <div class="modal fade" id="addBuyerModal" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content rounded-4">
              <div class="modal-header">
                <h5 class="modal-title">Add New Buyer</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <form id="addBuyerForm">
                  <div class="mb-3">
                    <label class="form-label">Business Name</label>
                    <input type="text" class="form-control" id="businessName" placeholder="Company ABC" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Contact Email *</label>
                    <input type="email" class="form-control" id="contactEmail" placeholder="email@example.com" required />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Contact Phone</label>
                    <input type="text" class="form-control" id="contactPhone" placeholder="9876543210" />
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" id="saveBuyer">Add Buyer</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Edit Buyer Modal -->
        <div class="modal fade" id="editBuyerModal" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content rounded-4">
              <div class="modal-header">
                <h5 class="modal-title">Edit Buyer</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <form id="editBuyerForm">
                  <input type="hidden" id="editBuyerId">
                  <div class="mb-3">
                    <label class="form-label">Business Name</label>
                    <input type="text" class="form-control" id="editBusinessName">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Contact Email *</label>
                    <input type="email" class="form-control" id="editContactEmail" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Contact Phone</label>
                    <input type="text" class="form-control" id="editContactPhone">
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" id="updateBuyer">Update Buyer</button>
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
    let buyers = [{
        id: 1,
        business_name: "ABC Motors",
        contact_email: "abc@motors.com",
        contact_phone: "9998887777",
        total_purchases: 15000,
        total_vehicles_purchased: 3,
        status: "active"
      },
      {
        id: 2,
        business_name: "SpeedLine Auto",
        contact_email: "contact@speedline.com",
        contact_phone: "9876543210",
        total_purchases: 7800,
        total_vehicles_purchased: 2,
        status: "inactive"
      }
    ];

    const buyersTable = document.getElementById("buyersTable");
    const renderTable = () => {
      buyersTable.innerHTML = buyers.map(buyer => `
        <tr>
          <td>${buyer.business_name || "N/A"}</td>
          <td>${buyer.contact_email}</td>
          <td>${buyer.contact_phone || "N/A"}</td>
          <td>${buyer.total_vehicles_purchased} ($${buyer.total_purchases})</td>
          <td>
            <select class="form-select form-select-sm status-select" data-id="${buyer.id}">
              <option value="active" ${buyer.status === "active" ? "selected" : ""}>Active</option>
              <option value="inactive" ${buyer.status === "inactive" ? "selected" : ""}>Inactive</option>
            </select>
          </td>
          <td>
            <button class="btn btn-light border btn-icon edit-btn" data-id="${buyer.id}"><i class="bi bi-pencil"></i></button>
            <button class="btn btn-light border btn-icon delete-btn" data-id="${buyer.id}"><i class="bi bi-trash"></i></button>
          </td>
        </tr>
      `).join("");
    };

    renderTable();

    document.getElementById("saveBuyer").addEventListener("click", () => {
      const name = document.getElementById("businessName").value;
      const email = document.getElementById("contactEmail").value;
      const phone = document.getElementById("contactPhone").value;

      if (!email) return alert("Email is required!");

      buyers.unshift({
        id: Date.now(),
        business_name: name,
        contact_email: email,
        contact_phone: phone,
        total_purchases: 0,
        total_vehicles_purchased: 0,
        status: "active"
      });

      renderTable();
      document.getElementById("addBuyerForm").reset();
      bootstrap.Modal.getInstance(document.getElementById("addBuyerModal")).hide();
    });

    document.addEventListener("click", (e) => {
      if (e.target.closest(".delete-btn")) {
        const id = +e.target.closest(".delete-btn").dataset.id;
        buyers = buyers.filter(b => b.id !== id);
        renderTable();
      }

      if (e.target.closest(".edit-btn")) {
        const id = +e.target.closest(".edit-btn").dataset.id;
        const buyer = buyers.find(b => b.id === id);
        document.getElementById("editBuyerId").value = buyer.id;
        document.getElementById("editBusinessName").value = buyer.business_name;
        document.getElementById("editContactEmail").value = buyer.contact_email;
        document.getElementById("editContactPhone").value = buyer.contact_phone;
        new bootstrap.Modal(document.getElementById("editBuyerModal")).show();
      }
    });

    document.getElementById("updateBuyer").addEventListener("click", () => {
      const id = +document.getElementById("editBuyerId").value;
      const name = document.getElementById("editBusinessName").value;
      const email = document.getElementById("editContactEmail").value;
      const phone = document.getElementById("editContactPhone").value;

      buyers = buyers.map(b => b.id === id ? {
        ...b,
        business_name: name,
        contact_email: email,
        contact_phone: phone
      } : b);
      renderTable();
      bootstrap.Modal.getInstance(document.getElementById("editBuyerModal")).hide();
    });

    document.addEventListener("change", (e) => {
      if (e.target.classList.contains("status-select")) {
        const id = +e.target.dataset.id;
        const status = e.target.value;
        buyers = buyers.map(b => b.id === id ? {
          ...b,
          status
        } : b);
      }
    });
  </script>
</body>

</html>