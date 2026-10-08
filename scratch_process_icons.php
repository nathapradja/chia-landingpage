<?php

function makeCircularTransparent($srcPath, $dstPath, $cropSquare = true) {
    if (!file_exists($srcPath)) {
        echo "File not found: $srcPath\n";
        return;
    }

    $imgInfo = getimagesize($srcPath);
    $mime = $imgInfo['mime'];

    if ($mime === 'image/png') {
        $src = imagecreatefrompng($srcPath);
    } elseif ($mime === 'image/jpeg') {
        $src = imagecreatefromjpeg($srcPath);
    } else {
        return;
    }

    $w = imagesx($src);
    $h = imagesy($src);

    // Find square size
    $minSize = min($w, $h);
    $srcX = ($w - $minSize) / 2;
    $srcY = ($h - $minSize) / 2;

    $targetSize = 256;
    $dst = imagecreatetruecolor($targetSize, $targetSize);
    imagealphablending($dst, false);
    imagesavealpha($dst, true);

    $transparent = imagecolorallocatealpha($dst, 0, 0, 0, 127);
    imagefilledrectangle($dst, 0, 0, $targetSize, $targetSize, $transparent);

    // Resample to target size
    $temp = imagecreatetruecolor($targetSize, $targetSize);
    imagecopyresampled($temp, $src, 0, 0, (int)$srcX, (int)$srcY, $targetSize, $targetSize, (int)$minSize, (int)$minSize);

    // Apply smooth circular mask with anti-aliasing
    $radius = $targetSize / 2;
    for ($x = 0; $x < $targetSize; $x++) {
        for ($y = 0; $y < $targetSize; $y++) {
            $dx = $x - $radius + 0.5;
            $dy = $y - $radius + 0.5;
            $dist = sqrt($dx * $dx + $dy * $dy);

            if ($dist <= $radius - 1) {
                // Inside circle
                $color = imagecolorat($temp, $x, $y);
                imagesetpixel($dst, $x, $y, $color);
            } elseif ($dist <= $radius) {
                // Anti-aliased edge
                $alphaRatio = ($radius - $dist); // 0 to 1
                $color = imagecolorat($temp, $x, $y);
                $r = ($color >> 16) & 0xFF;
                $g = ($color >> 8) & 0xFF;
                $b = $color & 0xFF;
                $alpha = (int)((1 - $alphaRatio) * 127);
                $aaColor = imagecolorallocatealpha($dst, $r, $g, $b, $alpha);
                imagesetpixel($dst, $x, $y, $aaColor);
            }
        }
    }

    imagepng($dst, $dstPath);
    imagedestroy($src);
    imagedestroy($dst);
    imagedestroy($temp);
    echo "Saved circular transparent icon: $dstPath\n";
}

$userUploadedDir = 'C:/Users/NATHAPRADJA/.gemini/antigravity/brain/61cad170-cef5-4dd7-b006-47d36a6ed4e4/.user_uploaded';

makeCircularTransparent("$userUploadedDir/media_1791120986513.png", 'public/images/whatsapp.png');
makeCircularTransparent("$userUploadedDir/media_1791120986555.png", 'public/images/shopee.png');
makeCircularTransparent("$userUploadedDir/media_1791120958983.jpg", 'public/images/grabfood.png');
makeCircularTransparent("$userUploadedDir/media_1791120958980.jpg", 'public/images/gofood.png');
makeCircularTransparent("$userUploadedDir/media_1791120958979.jpg", 'public/images/tiktok.png');

