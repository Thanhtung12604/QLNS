<?php
session_start();

// Completely destroy session
$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

session_destroy();

// Show confirmation
echo "<!DOCTYPE html><html><head><title>Session Cleared</title></head><body>";
echo "<h1 style='color: green;'>✓ Session Cleared Successfully</h1>";
echo "<p>All session data has been destroyed.</p>";
echo "<p><a href='auth/login' style='color: blue; font-weight: bold; font-size: 20px;'>→ CLICK HERE TO LOGIN AGAIN</a></p>";
echo "<hr>";
echo "<p><small>After logging in, your menu should appear with all items (Danh mục, Nhân viên, Chấm công, Lương, Báo cáo).</small></p>";
echo "</body></html>";
