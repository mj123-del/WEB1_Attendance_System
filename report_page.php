<?php include 'generate_reports.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reports</title>
</head>
<body>
  <h1>Monthly Attendance Report</h1>
  <table border="1">
    <thead>
      <tr>
        <th>Employee Name</th>
        <th>Days Present</th>
        <th>Late Days</th>
        <th>Absences</th>
        <th>Total Working Days</th>
        <th>Attendance Percentage</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($attendanceReport as $record): ?>
        <tr>
          <td><?php echo $record['name']; ?></td>
          <td><?php echo $record['days_present']; ?></td>
          <td><?php echo $record['late_days']; ?></td>
          <td><?php echo $record['absences']; ?></td>
          <td><?php echo $record['total_working_days']; ?></td>
          <td><?php echo $record['attendance_percentage']; ?>%</td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <script src="bootstrap-5.3.3-dist/js/bootstrap.js"></script>
</body>
</html>