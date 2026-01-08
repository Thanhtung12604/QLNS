<?php

class TestController extends Controller
{
    public function index()
    {
        echo "<h1>Test - No Auth Check</h1>";
        echo "<pre>Session: ";
        print_r($_SESSION);
        echo "</pre>";

        echo "<p>Auth::check() = " . (Auth::check() ? 'true' : 'false') . "</p>";

        echo "<p><a href='" . BASE_URL . "home'>Go to Home</a></p>";
        echo "<p><a href='" . BASE_URL . "clear.php'>Clear Session</a></p>";
    }
}
