<?php
include 'db_config.php';

// Fetch users from the database
$result = $conn->query("SELECT id, name, role, department, status FROM users");

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['role']}</td>
            <td>{$row['department']}</td>
            <td>{$row['status']}</td>
            <td>
              <button class='btn btn-primary btn-action' onclick='editUser({$row['id']})'>Edit</button>
              <button class='btn btn-danger btn-action' onclick='deleteUser({$row['id']})'>Delete</button>
            </td>
          </tr>";
}
?>