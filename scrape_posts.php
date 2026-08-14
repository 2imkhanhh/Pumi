<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Post;

$html = file_get_contents('d:/pumi/html_template/blog.html');
$dom = new DOMDocument();
@$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
$xpath = new DOMXPath($dom);

$articles = $xpath->query('//div[@id="news-list"]//article');
$count = 0;

foreach ($articles as $article) {
    // get parent 'a' tag for slug
    $a = $xpath->query('ancestor::a', $article)->item(0);
    $href = $a ? $a->getAttribute('href') : '';
    preg_match('/blog\/(.*?)\.html/', $href, $m);
    $slug = $m[1] ?? 'post-' . time() . rand(1, 100);

    // image
    $img = $xpath->query('.//div[@class="imgbox"]/img', $article)->item(0);
    $image = $img ? $img->getAttribute('src') : '';

    // title
    $titleNode = $xpath->query('.//h2[@class="title"]', $article)->item(0);
    $title = $titleNode ? $titleNode->nodeValue : '';

    // date
    $dateNode = $xpath->query('.//div[@class="date"]', $article)->item(0);
    $dateStr = $dateNode ? $dateNode->nodeValue : '';
    preg_match('/\|\s*(.*)/', $dateStr, $m2);
    $date = $m2[1] ?? '';

    // excerpt
    $descNode = $xpath->query('.//div[@class="desc"]', $article)->item(0);
    $excerpt = $descNode ? $descNode->nodeValue : '';

    $dateParts = explode('.', trim($date));
    $published_at = count($dateParts) == 3 ? '20'.$dateParts[2].'-'.$dateParts[1].'-'.$dateParts[0].' 00:00:00' : now();

    Post::updateOrCreate(
        ['slug' => $slug],
        [
            'title' => trim($title),
            'excerpt' => trim($excerpt),
            'content' => '<p>' . trim($excerpt) . '</p>',
            'image' => $image,
            'published_at' => $published_at
        ]
    );
    $count++;
}

echo "Successfully imported $count posts!\n";
