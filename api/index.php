<?php

// 1. Arahkan folder cache Blade & Storage ke folder /tmp Vercel
$_ENV['VIEW_COMPILED_PATH'] = '/tmp/views';
$_ENV['APP_CONFIG_CACHE'] = '/tmp/config.php';
$_ENV['APP_ROUTES_CACHE'] = '/tmp/routes.php';
$_ENV['APP_SERVICES_CACHE'] = '/tmp/services.php';
$_ENV['APP_PACKAGES_CACHE'] = '/tmp/packages.php';

// 2. Buat folder tmp jika belum ada
if (!is_dir('/tmp/views')) {
    mkdir('/tmp/views', 0755, true);
}

// 3. Jalankan aplikasi Laravel
require __DIR__ . '/../public/index.php';