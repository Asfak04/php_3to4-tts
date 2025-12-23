function gradePoint(mark) {
    if (mark >= 90) return 10;
    if (mark >= 80) return 9;
    if (mark >= 70) return 8;
    if (mark >= 60) return 7;
    if (mark >= 50) return 6;
    return 0;
}

function calculateGPA() {
    let marks = document.querySelectorAll(".marks");
    let total = 0;
    let count = 0;

    marks.forEach(m => {
        let val = parseInt(m.value);
        if (!isNaN(val)) {
            total += gradePoint(val);
            count++;
        }
    });

    let gpa = count > 0 ? (total / count).toFixed(2) : 0;
    document.getElementById("gpa").value = gpa;
}
