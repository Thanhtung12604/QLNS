<?php
session_start();
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once CORE_PATH . 'Database.php';
require_once APP_PATH . 'core/Auth.php';
require_once CORE_PATH . 'Model.php';
require_once APP_PATH . 'models/Role.php';

echo "<h1>Permission Check</h1>";
echo "<p><a href='" . BASE_URL . "home'>Back to Home</a></p>";
echo "<hr>";

echo "<h3>Session Data:</h3>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

echo "<hr>";
echo "<h3>Permission Checks:</h3>";

$permissions = [
    'department.view',
    'position.view',
    'employee.view',
    'attendance.view',
    'salary.view',
    'report.view'
];

echo "<table border='1' cellpadding='10'>";
echo "<tr><th>Permission</th><th>Has Permission?</th></tr>";
foreach ($permissions as $perm) {
    $has = Auth::hasPermission($perm);
    $color = $has ? 'green' : 'red';
    echo "<tr><td>{$perm}</td><td style='color: {$color};'>" . ($has ? 'YES ✓' : 'NO ✗') . "</td></tr>";
}
echo "</table>";

echo "<hr>";
echo "<h3>All Permissions in Session:</h3>";
if (isset($_SESSION['permissions'])) {
    echo "<pre>";
    print_r($_SESSION['permissions']);
    echo "</pre>";
} else {
    echo "<p style='color: red;'>⚠️ No permissions array in session!</p>";
}

echo "<hr>";
echo "<h3>Role Permissions from Database:</h3>";
if (isset($_SESSION['role_id'])) {
    $roleModel = new Role();
    $dbPermissions = $roleModel->getPermissions($_SESSION['role_id']);
    echo "<pre>";
    print_r($dbPermissions);
    echo "</pre>";
} else {
    echo "<p>No role_id in session</p>";
}
