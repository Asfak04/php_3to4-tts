<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Settings</title>

  <!-- External css -->
  <link rel="stylesheet" href="./css/style.css" />

  <!-- Bootstrap CSS & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8f9fa;
      padding: 30px;
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto;
    }

    .card {
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .card-title i {
      color: #0d6efd;
    }

    .form-control[disabled] {
      background-color: #e9ecef !important;
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
      <div class="col-md-9 p-5" style="height: 100vh; overflow-y: auto;">
        <div class="container pb-5">
          <div class="mb-4">
            <h2 class="fw-bold">Settings</h2>
            <p class="text-muted">Manage your account settings and preferences</p>
          </div>

          <!-- Profile Information -->
          <div class="card mb-4">
            <div class="card-header bg-white border-0">
              <h5 class="card-title d-flex align-items-center gap-2 mb-0">
                <i class="bi bi-person"></i> Profile Information
              </h5>
              <p class="text-muted small mb-0">Update your personal information</p>
            </div>
            <div class="card-body">
              <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" id="fullName" class="form-control" placeholder="John Doe">
              </div>
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" id="email" class="form-control" value="user@example.com" disabled>
                <p class="text-muted small mt-1">Email cannot be changed</p>
              </div>
              <button id="saveProfileBtn" class="btn btn-success">Save Changes</button>
            </div>
          </div>

          <!-- Security -->
          <div class="card mb-4">
            <div class="card-header bg-white border-0">
              <h5 class="card-title d-flex align-items-center gap-2 mb-0">
                <i class="bi bi-lock"></i> Security
              </h5>
              <p class="text-muted small mb-0">Update your password</p>
            </div>
            <div class="card-body">
              <div class="mb-3">
                <label class="form-label">Current Password</label>
                <input type="password" id="currentPassword" class="form-control">
              </div>
              <div class="mb-3">
                <label class="form-label">New Password</label>
                <input type="password" id="newPassword" class="form-control" minlength="6">
              </div>
              <div class="mb-3">
                <label class="form-label">Confirm New Password</label>
                <input type="password" id="confirmPassword" class="form-control" minlength="6">
              </div>
              <button id="updatePasswordBtn" class="btn btn-success">Update Password</button>
            </div>
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
    // Simulate Supabase actions
    const saveProfileBtn = document.getElementById("saveProfileBtn");
    const updatePasswordBtn = document.getElementById("updatePasswordBtn");

    saveProfileBtn.addEventListener("click", () => {
      const name = document.getElementById("fullName").value.trim();
      if (!name) {
        alert("Please enter your full name");
        return;
      }
      showToast("Profile updated successfully");
    });

    updatePasswordBtn.addEventListener("click", () => {
      const current = document.getElementById("currentPassword").value;
      const newPass = document.getElementById("newPassword").value;
      const confirm = document.getElementById("confirmPassword").value;

      if (!newPass || !confirm) {
        alert("Please fill in all password fields");
        return;
      }
      if (newPass !== confirm) {
        alert("Passwords do not match");
        return;
      }
      showToast("Password updated successfully");
      document.getElementById("currentPassword").value = "";
      document.getElementById("newPassword").value = "";
      document.getElementById("confirmPassword").value = "";
    });

    function showToast(msg) {
      const toastEl = document.createElement('div');
      toastEl.className = 'position-fixed bottom-0 end-0 m-3 p-3 bg-dark text-white rounded shadow';
      toastEl.style.zIndex = 1080;
      toastEl.textContent = msg;
      document.body.appendChild(toastEl);
      setTimeout(() => {
        toastEl.classList.add('fade');
      }, 10);
      setTimeout(() => toastEl.remove(), 2000);
    }
  </script>
</body>

</html>