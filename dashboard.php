
<?php

require_once __DIR__ . '/includes/auth.php';

// Confirm that the user is logged in.
requireLogin();

// Read the logged-in user's role.
$role = $_SESSION['user']['role'] ?? '';

// Redirect according to the user's role.
if ($role === 'admin') {
    header('Location: admin/dashboard.php');
    exit;
}

if ($role === 'citizen') {
    header('Location: citizen/dashboard.php');
    exit;
}

// Deny access if the role is missing or invalid.
http_response_code(403);
exit('Access denied. Invalid user role.');
