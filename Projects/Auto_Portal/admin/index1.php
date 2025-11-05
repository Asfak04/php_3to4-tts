<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>AutoPortal Admin - Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa, #dce3f0);
            min-height: 100vh;
        }

        /* ===== Sidebar Styling ===== */
        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: linear-gradient(180deg, #0f1d36, #1f2a50);
            color: #fff;
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            padding: 1.5rem 1rem;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.2);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar h4 {
            font-weight: bold;
            color: #fff;
            letter-spacing: 1px;
        }

        .sidebar small {
            color: #aab8d6;
        }

        .sidebar a {
            color: #cfd9f1;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 12px 18px;
            border-radius: 8px;
            margin-bottom: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .sidebar a i {
            font-size: 1.2rem;
        }

        .sidebar a:hover {
            background: #2a3a6f;
            color: #fff;
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .sidebar a.active {
            background: #556ee6;
            color: #fff;
            font-weight: 600;
            box-shadow: 0 6px 20px rgba(85, 110, 230, 0.4);
        }

        .sidebar .mt-auto {
            margin-top: auto;
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* ===== Content ===== */
        .content {
            margin-left: 240px;
            padding: 30px;
        }

        .card {
            border-radius: 12px;
            border: none;
            background: #ffffffb5;
            backdrop-filter: blur(8px);
            box-shadow: 0 6px 18px rgba(18, 38, 63, 0.08);
        }

        .quick-btn {
            min-width: 160px;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="text-center mb-4">
            <h4 class="mb-0">AutoPortal</h4>
            <small>Admin Panel</small>
        </div>
        <nav class="flex-grow-1">
            <a href="index.html" class="active"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
            <a href="reports.html"><i class="bi bi-file-earmark-bar-graph me-2"></i>Reports</a>
            <a href="auth.html"><i class="bi bi-person-circle me-2"></i>Auth</a>
            <a href="404.html"><i class="bi bi-exclamation-circle me-2"></i>404 Page</a>
        </nav>
        <div class="mt-auto text-center">
            <small class="text-muted d-block mb-1">Logged in as</small>
            <strong>admin@autoportal.com</strong>
        </div>
    </div>

    <!-- Content -->
    <main class="content">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h1 class="h3 fw-bold mb-0 text-dark">Dashboard</h1>
                <p class="text-muted mb-0">Overview & quick actions</p>
            </div>
        </div>

        <!-- Stats cards -->
        <div class="row g-3 mb-4">
            <div class="col-sm-6 col-lg-3">
                <div class="card p-3 text-center">
                    <small class="text-muted">Total Vehicles</small>
                    <div class="h3 fw-bold mt-2" id="cardVehicles">320</div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card p-3 text-center">
                    <small class="text-muted">Active Users</small>
                    <div class="h3 fw-bold mt-2" id="cardUsers">120</div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card p-3 text-center">
                    <small class="text-muted">Total Sales</small>
                    <div class="h3 fw-bold mt-2" id="cardSales">$230,000</div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card p-3 text-center">
                    <small class="text-muted">Pending Approvals</small>
                    <div class="h3 fw-bold mt-2" id="cardPending">6</div>
                </div>
            </div>
        </div>

        <!-- Recent Listings + Quick Actions -->
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card p-3">
                    <h6 class="mb-3">Recent Vehicle Listings</h6>
                    <ul class="list-group list-group-flush" id="recentListings"></ul>
                    <div class="mt-3 text-end">
                        <a href="reports.html" class="btn btn-outline-primary">View All Listings</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card p-3">
                    <h6 class="mb-3">Quick Actions</h6>
                    <div class="d-grid gap-2">
                        <button class="btn btn-dark" id="btnAddVehicle"><i class="bi bi-plus me-2"></i>Add New Vehicle</button>
                        <a href="auth.html" class="btn btn-dark"><i class="bi bi-people me-2"></i>Manage Users</a>
                        <a href="reports.html" class="btn btn-dark"><i class="bi bi-bar-chart-line me-2"></i>View Analytics</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const recent = [{
                name: "2024 Toyota Camry",
                seller: "ABC Motors",
                price: 28000,
                status: "active"
            },
            {
                name: "2023 Honda Civic",
                seller: "SpeedLine",
                price: 22000,
                status: "pending"
            },
            {
                name: "2022 Ford F-150",
                seller: "TruckHouse",
                price: 45000,
                status: "active"
            },
            {
                name: "2024 Hyundai Creta",
                seller: "UrbanAutos",
                price: 18000,
                status: "active"
            },
        ];

        const container = document.getElementById('recentListings');
        recent.forEach(v => {
            const li = document.createElement('li');
            li.className = 'list-group-item d-flex justify-content-between align-items-center';
            li.innerHTML = `
        <div>
          <div class="fw-medium">${v.name}</div>
          <div class="small text-muted">${v.seller}</div>
        </div>
        <div class="text-end">
          <div class="fw-bold">$${v.price.toLocaleString()}</div>
          <span class="badge ${v.status === 'active' ? 'bg-success' : 'bg-warning text-dark'}">${v.status}</span>
        </div>
      `;
            container.appendChild(li);
        });

        document.getElementById('btnAddVehicle').addEventListener('click', () => {
            alert('Open Add Vehicle form (placeholder). For working form, integrate with a backend.');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>