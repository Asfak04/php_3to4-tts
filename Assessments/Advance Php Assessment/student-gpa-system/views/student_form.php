<!DOCTYPE html>
<html>
<head>
    <title>Student GPA System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="assets/js/gpa.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header text-center fw-bold">
                    Student GPA Calculator
                </div>

                <div class="card-body">
                    <form method="POST" action="controllers/StudentController.php">

                        <div class="mb-3">
                            <label class="form-label">Student Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter student name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Subject Marks</label>

                            <input type="number" class="form-control mb-2 marks" name="marks[]" placeholder="Maths" oninput="calculateGPA()" required>
                            <input type="number" class="form-control mb-2 marks" name="marks[]" placeholder="English" oninput="calculateGPA()" required>
                            <input type="number" class="form-control mb-2 marks" name="marks[]" placeholder="Science" oninput="calculateGPA()" required>
                            <input type="number" class="form-control mb-2 marks" name="marks[]" placeholder="Gujarati" oninput="calculateGPA()" required>
                            <input type="number" class="form-control mb-2 marks" name="marks[]" placeholder="Hindi" oninput="calculateGPA()" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">GPA</label>
                            <input type="text" id="gpa" name="gpa" class="form-control fw-bold bg-light" readonly>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" name="pdf" class="btn btn-success w-50">
                                Save & Download PDF
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

</body>
</html>
