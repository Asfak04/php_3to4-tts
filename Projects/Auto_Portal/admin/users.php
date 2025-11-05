<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Users Management</title>

  <!-- External css -->
  <link rel="stylesheet" href="./css/style.css" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      /* font-family: "Inter", sans-serif; */
    }

    .card {
      border: none;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
      border-radius: 12px;
    }

    .badge {
      font-size: 0.75rem;
      padding: 0.45em 0.6em;
      border-radius: 8px;
    }

    .badge-outline {
      border: 1px solid #ccc;
      color: #666;
      background: transparent;
    }

    .btn-icon {
      padding: 0.4rem 0.5rem;
      border-radius: 8px;
    }

    .btn-icon:hover {
      background-color: #eef1f3;
    }

    .table> :not(caption)>*>* {
      vertical-align: middle;
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
          <div class="mb-4">
            <h2 class="fw-bold">Users Management</h2>
            <p class="text-muted">Manage user accounts and permissions</p>
          </div>

          <div class="card">
            <div class="card-header bg-white border-0">
              <h5 class="mb-0 fw-semibold">All Users</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table align-middle">
                  <thead class="table-light">
                    <tr>
                      <th>Email</th>
                      <th>Full Name</th>
                      <th>Roles</th>
                      <th>Joined</th>
                      <th class="text-end">Actions</th>
                    </tr>
                  </thead>
                  <tbody id="userTableBody"></tbody>
                </table>
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
    const users = [{
        id: 1,
        email: "john@example.com",
        full_name: "John Doe",
        created_at: "2024-03-10",
        roles: ["admin"]
      },
      {
        id: 2,
        email: "mike@example.com",
        full_name: "Mike Brown",
        created_at: "2024-08-12",
        roles: []
      },
    ];

    function renderUsers() {
      const tbody = document.getElementById("userTableBody");
      tbody.innerHTML = "";

      users.forEach(user => {
        const hasAdmin = user.roles.includes("admin");

        const row = document.createElement("tr");
        row.innerHTML = `
          <td class="fw-medium">${user.email}</td>
          <td>${user.full_name || "—"}</td>
          <td>
            <div class="d-flex gap-1 flex-wrap">
              ${
                user.roles.length > 0
                  ? user.roles.map(role =>
                      `<span class="badge ${role === "admin" ? "bg-success text-white" : "badge-outline"}">${role}</span>`
                    ).join("")
                  : `<span class="badge badge-outline">user</span>`
              }
            </div>
          </td>
          <td>${new Date(user.created_at).toLocaleDateString()}</td>
          <td class="text-end">
            <button 
              class="btn btn-icon btn-light border" 
              title="${hasAdmin ? 'Remove Admin Role' : 'Grant Admin Role'}"
              data-user-id="${user.id}">
              <i class="bi ${hasAdmin ? 'bi-person text-primary' : 'bi-shield-lock text-success'} fs-5"></i>
            </button>
          </td>
        `;
        tbody.appendChild(row);
      });

      // Attach click handlers AFTER rendering
      document.querySelectorAll("[data-user-id]").forEach(button => {
        button.addEventListener("click", (e) => {
          const userId = parseInt(e.currentTarget.getAttribute("data-user-id"));
          toggleAdmin(userId);
        });
      });
    }

    function toggleAdmin(userId) {
      const user = users.find(u => u.id === userId);
      if (!user) return;

      const isAdmin = user.roles.includes("admin");
      if (isAdmin) {
        user.roles = user.roles.filter(r => r !== "admin");
      } else {
        user.roles.push("admin");
      }

      renderUsers();
    }

    renderUsers();
  </script>
</body>

</html>