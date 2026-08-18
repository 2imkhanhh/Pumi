<?php
use App\Models\Setting;

$home_partners = [
    ['img' => 'assets/images/upload/adv/thumbs/img_68dcb504c261e.png'],
    ['img' => 'assets/images/upload/adv/thumbs/img_68dcb50c43d27.png'],
    ['img' => 'assets/images/upload/adv/thumbs/img_68dcb513f333e.png'],
    ['img' => 'assets/images/upload/adv/thumbs/img_68dcb51adde95.png'],
    ['img' => 'assets/images/upload/adv/thumbs/img_68dcb5228fd91.png'],
];

Setting::updateOrCreate(['key' => 'home_partners'], ['value' => json_encode($home_partners), 'type' => 'json']);

$desc = "hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.\nhendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.";

$ingredient_partners = [
    [
        'name' => 'Đối tác ABC',
        'description' => $desc,
        'img' => 'assets/images/upload/document/img_68de34175aa5b.jpg'
    ],
    [
        'name' => 'Đối tác ABC',
        'description' => $desc,
        'img' => 'assets/images/upload/document/img_68de342d7222d.jpg'
    ]
];

Setting::updateOrCreate(['key' => 'ingredient_partners'], ['value' => json_encode($ingredient_partners), 'type' => 'json']);

$hospital_partners = [];
for ($i = 1; $i <= 8; $i++) {
    $hospital_partners[] = ['img' => 'assets/images/upload/document/img_68de34414a41c.jpg'];
}

Setting::updateOrCreate(['key' => 'hospital_partners'], ['value' => json_encode($hospital_partners), 'type' => 'json']);

$media_partners = [];
for ($i = 1; $i <= 8; $i++) {
    $media_partners[] = ['img' => 'assets/images/upload/document/img_68de34414a41c.jpg'];
}

Setting::updateOrCreate(['key' => 'media_partners'], ['value' => json_encode($media_partners), 'type' => 'json']);

echo "Settings seeded successfully.\n";
