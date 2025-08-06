<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Maintenance Mode
$maintenanceFile = __DIR__ . '/../storage/framework/maintenance.php';
if (file_exists($maintenanceFile)) {
    require $maintenanceFile;
}

// Autoload Composer Dependencies
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel App
/** @var Application $app */
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Handle Incoming Request
$app->handleRequest(Request::capture());
