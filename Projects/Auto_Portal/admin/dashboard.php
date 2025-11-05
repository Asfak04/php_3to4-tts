<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Modern Dashboard</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

  <style>
    :root {
      --bg-light: #f8fafc;
      --primary-gradient: linear-gradient(135deg, #2563eb, #4f46e5);
      --card-bg: #ffffff;
      --accent-green: #10b981;
      --accent-yellow: #facc15;
      --accent-blue: #3b82f6;
      --text-muted: #6b7280;
    }

    body {
      background-color: var(--bg-light);
      font-family: "Poppins", sans-serif;
      color: #111827;
    }

    .dashboard-header {
      background: var(--primary-gradient);
      color: #fff;
      padding: 2.5rem 1.5rem;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(37, 99, 235, 0.25);
    }

    .dashboard-header h1 {
      font-weight: 700;
    }

    .dashboard-header p {
      opacity: 0.9;
    }

    .stat-card {
      background: var(--card-bg);
      border: none;
      border-radius: 16px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .stat-icon {
      font-size: 2rem;
      border-radius: 12px;
      color: #fff;
      width: 48px;
      height: 48px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .icon-blue { background: var(--accent-blue); }
    .icon-green { background: var(--accent-green); }
    .icon-yellow { background: var(--accent-yellow); color: #111; }
    .icon-purple { background: #8b5cf6; }

    .stat-value {
      font-size: 1.8rem;
      font-weight: 700;
    }

    .muted { color: var(--text-muted); }

    .list-group-item {
      border: none;
      background: rgba(255, 255, 255, 0.9);
      border-radius: 12px;
      margin-bottom: 10px;
      padding: 1rem 1.2rem;
      transition: all 0.25s ease-in-out;
    }

    .list-group-item:hover {
      background: #f1f5f9;
      transform: scale(1.01);
    }

    .btn-outline-primary {
      border-width: 2px;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .btn-outline-primary:hover {
      background: var(--accent-blue);
      border-color: var(--accent-blue);
      color: #fff;
    }

    .quick-actions .btn {
      font-weight: 500;
      border-radius: 12px;
      transition: all 0.3s ease;
    }

    .quick-actions .btn:hover {
      transform: translateX(3px);
    }

    footer {
      text-align: center;
      color: var(--text-muted);
      margin-top: 3rem;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>
  <div class="container py-4">

    <!-- Header -->
    <div class="dashboard-header mb-5 text-center text-md-start">
      <h1 class="display-6">🚀 Dashboard Overview</h1>
      <p class="lead mb-0">Welcome back! Here's a quick snapshot of your system.</p>
    </div>

    <!-- Stat cards -->
    <div class="row g-4 mb-5">
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="card stat-card p-4 h-100">
          <div class="d-flex align-items-center">
            <div class="stat-icon icon-blue me-3">
              <i class="bi bi-truck"></i>
            </div>
            <div>
              <h6 class="muted mb-1">Total Vehicles</h6>
              <div class="stat-value">124</div>
              <small class="text-success fw-medium">+12% from last month</small>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-3">
        <div class="card stat-card p-4 h-100">
          <div class="d-flex align-items-center">
            <div class="stat-icon icon-green me-3">
              <i class="bi bi-people"></i>
            </div>
            <div>
              <h6 class="muted mb-1">Active Users</h6>
              <div class="stat-value">68</div>
              <small class="text-success fw-medium">+8% from last month</small>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-3">
        <div class="card stat-card p-4 h-100">
          <div class="d-flex align-items-center">
            <div class="stat-icon icon-yellow me-3">
              <i class="bi bi-currency-dollar"></i>
            </div>
            <div>
              <h6 class="muted mb-1">Total Sales</h6>
              <div class="stat-value">$42,300</div>
              <small class="text-success fw-medium">+15% from last month</small>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-3">
        <div class="card stat-card p-4 h-100">
          <div class="d-flex align-items-center">
            <div class="stat-icon icon-purple me-3">
              <i class="bi bi-hourglass-split"></i>
            </div>
            <div>
              <h6 class="muted mb-1">Pending Approvals</h6>
              <div class="stat-value">9</div>
              <small class="text-danger fw-medium">-5% from last month</small>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Recent Vehicles + Quick Actions -->
    <div class="row g-4">
      <!-- Recent Vehicles -->
      <div class="col-12 col-lg-7">
        <div class="card shadow-card p-4">
          <h5 class="fw-bold mb-4">Recent Vehicle Listings</h5>

          <div class="list-group">
            <div class="list-group-item d-flex justify-content-between align-items-center">
              <div>
                <div class="fw-semibold fs-6">Toyota Supra</div>
                <div class="text-muted small">John Doe</div>
              </div>
              <div class="text-end">
                <div class="fw-semibold">$45,000</div>
                <span class="badge bg-success rounded-pill-sm">active</span>
              </div>
            </div>

            <div class="list-group-item d-flex justify-content-between align-items-center">
              <div>
                <div class="fw-semibold fs-6">Ford Mustang</div>
                <div class="text-muted small">Sarah Smith</div>
              </div>
              <div class="text-end">
                <div class="fw-semibold">$38,000</div>
                <span class="badge bg-warning text-dark rounded-pill-sm">pending</span>
              </div>
            </div>

            <div class="list-group-item d-flex justify-content-between align-items-center">
              <div>
                <div class="fw-semibold fs-6">Tesla Model 3</div>
                <div class="text-muted small">Elon Mars</div>
              </div>
              <div class="text-end">
                <div class="fw-semibold">$52,000</div>
                <span class="badge bg-success rounded-pill-sm">active</span>
              </div>
            </div>

            <div class="list-group-item d-flex justify-content-between align-items-center">
              <div>
                <div class="fw-semibold fs-6">Honda Civic</div>
                <div class="text-muted small">Alex Turner</div>
              </div>
              <div class="text-end">
                <div class="fw-semibold">$19,500</div>
                <span class="badge bg-warning text-dark rounded-pill-sm">pending</span>
              </div>
            </div>
          </div>

          <div class="mt-4">
            <a href="#" class="btn btn-outline-primary w-100">View All Listings</a>
          </div>
        </div>
      </div>

      <!-- Quick Actions -->
      <div class="col-12 col-lg-5">
        <div class="card shadow-card p-4 quick-actions">
          <h5 class="fw-bold mb-4">Quick Actions</h5>
          <a href="#" class="btn btn-primary text-start mb-2">
            <i class="bi bi-plus-lg me-2"></i> Add New Vehicle
          </a>
          <a href="#" class="btn btn-outline-secondary text-start mb-2">
            <i class="bi bi-people me-2"></i> Manage Users
          </a>
          <a href="#" class="btn btn-outline-secondary text-start">
            <i class="bi bi-graph-up me-2"></i> View Analytics
          </a>
        </div>
      </div>
    </div>

    <footer class="pt-4">
      <p>© 2025 AutoAdmin Dashboard — Designed with ❤️ using Bootstrap 5</p>
    </footer>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
