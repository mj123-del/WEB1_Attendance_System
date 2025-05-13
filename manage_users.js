// Handle user deletion
function deleteUser(userId) {
  if (confirm("Are you sure you want to delete this user?")) {
    fetch(`delete_user.php?id=${userId}`, { method: "GET" })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert("User deleted successfully!");
          location.reload(); // Reload the page to update the table
        } else {
          alert("Failed to delete user.");
        }
      });
  }
}

// Handle user editing (redirect to edit page)
function editUser(userId) {
  window.location.href = `edit_user.php?id=${userId}`;
}