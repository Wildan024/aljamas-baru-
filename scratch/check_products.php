<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$products = App\Models\Product::with('category')->get();
foreach ($products as $p) {
    echo "ID: {$p->id}\n";
    echo "Name: {$p->name}\n";
    echo "Slug: {$p->slug}\n";
    echo "Category: " . ($p->category?->name ?? 'None') . "\n";
    echo "Image: {$p->image}\n";
    echo "Short Desc: {$p->short_description}\n";
    echo "Description: {$p->description}\n";
    echo "Is Active: " . ($p->is_active ? 'Yes' : 'No') . "\n";
    echo "----------------------------------------\n";
}
