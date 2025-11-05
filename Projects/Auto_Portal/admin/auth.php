<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AutoPortal Admin | Login / Signup</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

  <!-- Supabase -->
  <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>

  <style>
    body {
      min-height: 100vh;
      background: linear-gradient(135deg, #0d6efd, #6610f2);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }
    .card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .nav-tabs .nav-link.active {
      background-color: #0d6efd;
      color: #fff;
    }
    .nav-tabs .nav-link {
      border-radius: 6px;
      color: #0d6efd;
      font-weight: 500;
    }
    .icon-circle {
      background-color: #0d6efd;
      border-radius: 50%;
      padding: 12px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }
    .icon-circle i {
      color: white;
      font-size: 24px;
    }
  </style>
</head>
<body>
  <div class="card w-100" style="max-width: 420px;">
    <div class="card-body p-4 text-center">
      <div class="icon-circle mb-3"><i class="bi bi-car-front-fill"></i></div>
      <h4 class="fw-bold">AutoPortal Admin</h4>
      <p class="text-muted mb-4">Manage your vehicle marketplace</p>

      <!-- Tabs -->
      <ul class="nav nav-tabs mb-4" id="authTabs" role="tablist">
        <li class="nav-item w-50">
          <button class="nav-link active w-100" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button">Login</button>
        </li>
        <li class="nav-item w-50">
          <button class="nav-link w-100" id="signup-tab" data-bs-toggle="tab" data-bs-target="#signup" type="button">Sign Up</button>
        </li>
      </ul>

      <div class="tab-content" id="authTabsContent">
        <!-- LOGIN -->
        <div class="tab-pane fade show active" id="login" role="tabpanel">
          <form id="loginForm" class="text-start">
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" id="loginEmail" class="form-control" placeholder="admin@autoportal.com" required />
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" id="loginPassword" class="form-control" required />
            </div>
            <button type="submit" id="loginBtn" class="btn btn-primary w-100">Login</button>
          </form>
        </div>

        <!-- SIGNUP -->
        <div class="tab-pane fade" id="signup" role="tabpanel">
          <form id="signupForm" class="text-start">
            <div class="mb-3">
              <label class="form-label">Full Name</label>
              <input type="text" id="signupName" class="form-control" placeholder="John Doe" required />
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" id="signupEmail" class="form-control" placeholder="admin@autoportal.com" required />
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" id="signupPassword" class="form-control" minlength="6" required />
            </div>
            <button type="submit" id="signupBtn" class="btn btn-primary w-100">Create Account</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Toast (Bootstrap 5) -->
  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100;">
    <div id="toastContainer" class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body" id="toastMessage"></div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  </div>

  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // ✅ Initialize Supabase
    const supabaseUrl = "https://your-project-id.supabase.co"; // replace with your Supabase URL
    const supabaseKey = "your-anon-key"; // replace with your public anon key
    const supabase = window.supabase.createClient(supabaseUrl, supabaseKey);

    // Toast function
    function showToast(message, type = "primary") {
      const toastEl = document.getElementById("toastContainer");
      const toastBody = document.getElementById("toastMessage");
      toastEl.className = `toast align-items-center text-bg-${type} border-0`;
      toastBody.textContent = message;
      new bootstrap.Toast(toastEl).show();
    }

    // LOGIN
    document.getElementById("loginForm").addEventListener("submit", async (e) => {
      e.preventDefault();
      const email = document.getElementById("loginEmail").value;
      const password = document.getElementById("loginPassword").value;
      document.getElementById("loginBtn").textContent = "Logging in...";

      const { data, error } = await supabase.auth.signInWithPassword({ email, password });
      if (error) showToast(error.message, "danger");
      else {
        showToast("Logged in successfully!", "success");
        setTimeout(() => window.location.href = "index.html", 1000);
      }
      document.getElementById("loginBtn").textContent = "Login";
    });

    // SIGNUP
    document.getElementById("signupForm").addEventListener("submit", async (e) => {
      e.preventDefault();
      const fullName = document.getElementById("signupName").value;
      const email = document.getElementById("signupEmail").value;
      const password = document.getElementById("signupPassword").value;
      document.getElementById("signupBtn").textContent = "Creating account...";

      const { data, error } = await supabase.auth.signUp({
        email,
        password,
        options: { data: { full_name: fullName }, emailRedirectTo: window.location.origin + "/" }
      });

      if (error) showToast(error.message, "danger");
      else showToast("Account created successfully!", "success");

      document.getElementById("signupBtn").textContent = "Create Account";
    });
  </script>
</body>
</html>
