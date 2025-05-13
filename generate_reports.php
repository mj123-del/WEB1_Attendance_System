<?php
include 'db.php';

// Fetch monthly attendance overview
function getMonthlyAttendance($pdo, $month) {
    $stmt = $pdo->prepare("
        SELECT u.name, a.days_present, a.late_days, a.absences, a.total_working_days, a.attendance_percentage
        FROM attendance a
        JOIN users u ON a.user_id = u.id
        WHERE MONTH(a.report_month) = ?
    ");
    $stmt->execute([$month]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Example: Get attendance for May (Month 5)
$month = 5;
$attendanceReport = getMonthlyAttendance($pdo, $month);
?>