<?php

// 1. Arahkan semua folder temp & cache Laravel ke folder /tmp bawaan Serverless
$_ENV['APP_STORAGE'] = '/tmp/storage';
$_ENV['VIEW_COMPILED_PATH'] = '/tmp/storage/framework/views';
$_ENV['APP_CONFIG_CACHE'] = '/tmp/storage/framework/config.php';
$_ENV['APP_ROUTES_CACHE'] = '/tmp/storage/framework/routes.php';

// 2. Buat direktori temporary yang dibutuhkan Laravel
$dirs = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/cache',
    '/tmp/storage/logs',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// 3. Panggil index.php utama Laravel
require __DIR__ . '/../public/index.php';