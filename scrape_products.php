<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;
use App\Models\Category;

$html = file_get_contents('d:/pumi/html_template/san-pham.html');
preg_match('/<div id="pro-list">(.*?)<\/section>/s', $html, $section);
$proListHtml = $section[1] ?? '';

preg_match_all('/<a href="(.*?\.html)"><div class="img"><img src="(.*?)" alt="(.*?)"\/><\/div>\s*<div class="info">\s*<h4 class="title text-truncate">(.*?)<\/h4>\s*<div class="desc"><p>(.*?)<\/p><\/div>/s', $proListHtml, $matches);

$count = 0;
$cat = Category::firstOrCreate(['name' => 'Sản phẩm chung', 'slug' => 'san-pham-chung']);

for ($i = 0; $i < count($matches[0]); $i++) {
    $slug = str_replace('.html', '', $matches[1][$i]);
    $image = $matches[2][$i];
    $name = trim($matches[4][$i]);
    $summary = trim($matches[5][$i]);

    Product::updateOrCreate(
        ['slug' => $slug],
        [
            'name' => $name,
            'short_description' => strip_tags($summary),
            'image' => $image,
            'category_id' => $cat->id,
            'price' => null, // Liên hệ
            'is_active' => true
        ]
    );
    $count++;
}

echo "Successfully imported $count products!\n";
