<?php

require 'vendor/autoload.php';
use HeroQR\Core\QRCodeGenerator;
use Square\SquareClient;
use Square\Environments;
use Square\Catalog\Requests\ListCatalogRequest;

/*
$client = new SquareClient(
    token: 'EAAAly44PvNJIC0tnc3Go8CLuToLo2PVAQNzSSDLSm-JQHcbmGOvmzQ5cEL0BPsS',
    options: [
        'baseUrl' => Environments::Production->value,
    ],
);
$client->catalog->list(
    new ListCatalogRequest([]),
);
*/

$products = [
    'heavenly_hope' => 'https://square.link/u/fs12bkgP',
    'ocean_wave' => 'https://square.link/u/3o8T85Mu',
    'swell_of_luck' => 'https://square.link/u/9gZs9wF3',
    'blue_star_studs' => 'https://square.link/u/plXxieJx',
    'burgundy_agate_dangle' => 'https://square.link/u/ETcsvw3N',
    'brown_circular_dangle' => 'https://square.link/u/S4enMVC3',
    'terracotta_heart_dangle' => 'https://square.link/u/dWtaKBdQ',
    'orange_pumpkin_studs' => 'https://square.link/u/1KHlyO0B',
    'marbled_pumpkin_studs' => 'https://square.link/u/1b8CiTHR',
    'twotoned_xmastree_dangle' => 'https://square.link/u/Vcf790hj',
    'holiday_snowflake_dangle' => 'https://square.link/u/ekSbE7JK',
    'twotone_reindeer_dangle' => 'https://square.link/u/YTVslEfn',
    'jewelry_sod' => 'https://square.link/u/brIdbf34',
];

// Resolve output directory from environment (mounted host dir), fallback to project root
$outputDir = getenv('OUTPUT_DIR') ?: __DIR__;
if (!is_dir($outputDir)) {
    // Try to create it if it doesn't exist (useful when OUTPUT_DIR points inside the workspace)
    @mkdir($outputDir, 0777, true);
}

foreach ($products as $name => $link) {
    $filePrefix = $outputDir . DIRECTORY_SEPARATOR . $name;
    if (!is_file("{$filePrefix}.png")) {
        // Create a QRCodeGenerator instance
        $qrCodeManager = new QRCodeGenerator();

        $qrCode = $qrCodeManager
            // Set the data to be encoded in the QR code
            ->setData($link)
            // Generate the QR code in PNG format (default)
            ->generate('png',[
                'Shape' => 'S1',
                'Marker' => 'M1',
                'Cursor' => 'C1'
            ]);

        // Save the generated QR code to a file
        $qrCode->saveTo($filePrefix);
    }
}
