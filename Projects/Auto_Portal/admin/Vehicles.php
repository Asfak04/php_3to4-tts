<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Vehicle Management</title>
  <link rel="stylesheet" href="./css/style.css" />
  <!-- Bootstrap CSS & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8f9fa;
      /* padding: 30px; */
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto;
    }

    .card {
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      border-radius: 10px;
    }

    .table thead {
      background-color: #f1f3f5;
    }

    .search-icon {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #6c757d;
    }

    .search-input {
      padding-left: 36px;
    }

    .btn-sm {
      min-width: 36px;
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
          <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
              <h2 class="fw-bold">Vehicle Management</h2>
              <p class="text-muted mb-0">Manage all vehicle listings</p>
            </div>
            <button id="openAddBtn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
              <i class="bi bi-plus-lg me-1"></i> Add Vehicle
            </button>
          </div>

          <div class="card">
            <div class="card-body">
              <div class="d-flex gap-3 mb-3">
                <div class="position-relative flex-grow-1">
                  <i class="bi bi-search search-icon"></i>
                  <input id="searchInput" class="form-control search-input" placeholder="Search vehicles...">
                </div>
                <button class="btn btn-outline-secondary"><i class="bi bi-funnel"></i> Filter</button>
              </div>

              <div class="table-responsive">
                <table class="table align-middle mb-0">
                  <thead>
                    <tr>
                      <th>Vehicle</th>
                      <th>Year</th>
                      <th>Price</th>
                      <th>Mileage</th>
                      <th>Seller</th>
                      <th>Status</th>
                      <th class="text-end">Actions</th>
                    </tr>
                  </thead>
                  <tbody id="vehicleTableBody"></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- Add Vehicle Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <form id="addForm" class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add Vehicle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <div class="modal-body">
                <div class="mb-3">
                  <label class="form-label">Vehicle Name</label>
                  <input id="inputName" class="form-control" required />
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Year</label>
                    <input id="inputYear" type="number" min="1900" max="2099" class="form-control" required />
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Price</label>
                    <input id="inputPrice" type="number" min="0" class="form-control" required />
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label">Mileage</label>
                  <input id="inputMileage" class="form-control" placeholder="e.g. 12,000 km" />
                </div>

                <div class="mb-3">
                  <label class="form-label">Seller</label>
                  <input id="inputSeller" class="form-control" placeholder="Seller name" />
                </div>

                <div class="mb-0">
                  <label class="form-label">Status</label>
                  <select id="inputStatus" class="form-select">
                    <option value="active">Active</option>
                    <option value="pending">Pending</option>
                    <option value="sold">Sold</option>
                  </select>
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Add Vehicle</button>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>

    </div>
  </section>

  <?php include_once("footer.php"); ?>



  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    (function() {
      // initial dummy data (keeps same structure as original)
      let vehicles = [{
          id: 1,
          name: "Toyota Camry",
          year: 2022,
          price: 30000,
          mileage: "10,000 km",
          seller: "John Doe",
          status: "active"
        },
        {
          id: 2,
          name: "Honda Civic",
          year: 2021,
          price: 25000,
          mileage: "15,000 km",
          seller: "Sarah Lee",
          status: "pending"
        },
        {
          id: 3,
          name: "BMW X5",
          year: 2023,
          price: 70000,
          mileage: "5,000 km",
          seller: "Michael Smith",
          status: "sold"
        }
      ];

      const tbody = document.getElementById('vehicleTableBody');
      const searchInput = document.getElementById('searchInput');
      const addForm = document.getElementById('addForm');
      const addModalEl = document.getElementById('addModal');
      const addModal = bootstrap.Modal.getOrCreateInstance(addModalEl);

      // Utility: render table rows
      function render(data = vehicles) {
        tbody.innerHTML = '';
        if (!data.length) {
          tbody.innerHTML = `<tr><td colspan="7" class="text-center text-muted py-4">No vehicles found</td></tr>`;
          return;
        }

        data.forEach(v => {
          const tr = document.createElement('tr');

          tr.innerHTML = `
          <td class="fw-medium">${escapeHtml(v.name)}</td>
          <td>${escapeHtml(String(v.year))}</td>
          <td>$${Number(v.price).toLocaleString()}</td>
          <td>${escapeHtml(v.mileage || 'N/A')}</td>
          <td>${escapeHtml(v.seller || 'Unknown')}</td>
          <td>
            <select class="form-select form-select-sm status-select" data-id="${v.id}">
              <option value="active" ${v.status === 'active' ? 'selected' : ''}>Active</option>
              <option value="pending" ${v.status === 'pending' ? 'selected' : ''}>Pending</option>
              <option value="sold" ${v.status === 'sold' ? 'selected' : ''}>Sold</option>
            </select>
          </td>
          <td class="text-end">
            <button class="btn btn-sm btn-outline-danger delete-btn" data-id="${v.id}" title="Delete">
              <i class="bi bi-trash"></i>
            </button>
          </td>
        `;
          tbody.appendChild(tr);
        });

        // attach listeners (delegation would also work; this is simple and clear)
        attachRowListeners();
      }

      // attach per-row listeners
      function attachRowListeners() {
        document.querySelectorAll('.delete-btn').forEach(btn => {
          btn.onclick = (e) => {
            const id = Number(btn.dataset.id);
            if (!confirm('Are you sure you want to delete this vehicle?')) return;
            vehicles = vehicles.filter(x => x.id !== id);
            render(filterByQuery(searchInput.value));
            showToast('Vehicle deleted successfully');
          };
        });

        document.querySelectorAll('.status-select').forEach(sel => {
          sel.onchange = (e) => {
            const id = Number(sel.dataset.id);
            const newStatus = sel.value;
            const item = vehicles.find(x => x.id === id);
            if (item) {
              item.status = newStatus;
              showToast(`Status updated to "${newStatus}" for ${item.name}`);
            }
          };
        });
      }

      // simple text escape for safety when injecting HTML
      function escapeHtml(str) {
        return String(str)
          .replaceAll('&', '&amp;')
          .replaceAll('<', '&lt;')
          .replaceAll('>', '&gt;')
          .replaceAll('"', '&quot;')
          .replaceAll("'", '&#39;');
      }

      // filter by search query
      function filterByQuery(q) {
        const query = String(q || '').trim().toLowerCase();
        if (!query) return vehicles.slice();
        return vehicles.filter(v => v.name.toLowerCase().includes(query));
      }

      // Search input
      searchInput.addEventListener('input', () => {
        render(filterByQuery(searchInput.value));
      });

      // Add form submit
      addForm.addEventListener('submit', (e) => {
        e.preventDefault();
        // collect values
        const name = document.getElementById('inputName').value.trim();
        const year = Number(document.getElementById('inputYear').value);
        const price = Number(document.getElementById('inputPrice').value);
        const mileage = document.getElementById('inputMileage').value.trim();
        const seller = document.getElementById('inputSeller').value.trim() || 'Unknown';
        const status = document.getElementById('inputStatus').value;

        // basic validation (keeps same UX; you can expand)
        if (!name) {
          alert('Please enter vehicle name');
          return;
        }
        if (!year || isNaN(year)) {
          alert('Please enter valid year');
          return;
        }
        if (isNaN(price)) {
          alert('Please enter valid price');
          return;
        }

        // create new id (timestamp + random to avoid collisions)
        const newId = Date.now() + Math.floor(Math.random() * 1000);

        const newVehicle = {
          id: newId,
          name,
          year,
          price,
          mileage,
          seller,
          status
        };

        // add to front (like newest first in original)
        vehicles.unshift(newVehicle);

        // reset form and close modal
        addForm.reset();
        addModal.hide();

        // re-render filtered view
        render(filterByQuery(searchInput.value));

        showToast('Vehicle added successfully');
      });

      // small inline toast replacement (non-intrusive)
      function showToast(msg) {
        // simple alert alternative for now (keeps minimal)
        // replace with custom toast UI if you prefer
        const toastEl = document.createElement('div');
        toastEl.className = 'position-fixed bottom-0 end-0 m-3 p-3 bg-dark text-white rounded shadow';
        toastEl.style.zIndex = 1080;
        toastEl.textContent = msg;
        document.body.appendChild(toastEl);
        setTimeout(() => {
          toastEl.classList.add('fade');
        }, 10);
        setTimeout(() => toastEl.remove(), 1800);
      }

      // initial render
      render(vehicles);

    })();
  </script>
</body>

</html>