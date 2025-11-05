<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>404 - Page Not Found</title>

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <style>
      body {
        background-color: #f3f4f6;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .not-found-container {
        text-align: center;
      }
      .not-found-container h1 {
        font-size: 4rem;
        font-weight: bold;
        color: #212529;
      }
      .not-found-container p {
        font-size: 1.25rem;
        color: #6c757d;
      }
      .not-found-container a {
        color: #0d6efd;
        text-decoration: underline;
        transition: color 0.2s;
      }
      .not-found-container a:hover {
        color: #0a58ca;
      }
    </style>
  </head>
  <body>
    <div class="not-found-container">
      <h1>404</h1>
      <p>Oops! Page not found</p>
      <a href="./dashboard.php">Return to Home</a>
    </div>

    <!-- Optional JS for redirect logging -->
    <script>
      console.error("404 Error: User attempted to access a non-existent route:", window.location.pathname);
    </script>
  </body>
</html>
