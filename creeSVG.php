<?php

$afficheTempsDeTraitement = false; // pour afficher ou pas la durée du traitement
if ($afficheTempsDeTraitement) {
    $startTime =getTime();
}

list($cadCoulR, $cadCoulV, $cadCoulB, $digCoulR, $digCoulV, $digCoulB, $digType, $digSize, $digStyle,
    $digWeight, $perL1, $perL2, $perCoulR, $perCoulV, $perCoulB, $perFont, $perSize, $perStyle, $perWeight)
    = getParametresCadran();

$svg = genereStringSvg($cadCoulR, $cadCoulV, $cadCoulB, $digCoulR, $digCoulV, $digCoulB, $digType, $digSize, $digStyle,
   $digWeight, $perL1, $perL2, $perCoulR, $perCoulV, $perCoulB, $perFont, $perSize, $perStyle, $perWeight
);

try {
    genereFichierImagePng($svg);
} catch (ImagickException $e) {
    echo $e->getMessage();
}

if ($afficheTempsDeTraitement) {
    $endTime = getTime();
	$totalTime = ($endTime - $startTime);
	echo 'Page générée en '.number_format($totalTime, 4, ',', '').' s';
}

function toChiffreRomain($chiffre)
{
    $romains = array(
        1 => 'I',
        2 => 'II',
        3 => 'III',
        4 => 'IV',
        5 => 'V',
        6 => 'VI',
        7 => 'VII',
        8 => 'VIII',
        9 => 'IX',
        10 => 'X',
        11 => 'XI',
        12 => 'XII'
    );
    return isset($romains[$chiffre]) ? $romains[$chiffre] : '';
}

function getTime()
{
    $mtime = microtime();
    $mtime = explode(" ", $mtime);
    return $mtime[1] + $mtime[0];
}

/**
 * @return array
 */
function getParametresCadran()
{
// Paramètres Cadran
    $cadCoulR = $_GET['cad_coul_r'];
    $cadCoulV = $_GET['cad_coul_v'];
    $cadCoulB = $_GET['cad_coul_b'];

// Paramètres Chiffres
    $digCoulR = $_GET['dig_coul_r'];
    $digCoulV = $_GET['dig_coul_v'];
    $digCoulB = $_GET['dig_coul_b'];

    $digType = $_GET['dig_type']; // on attend 'arabe', 'romain' ou 'forme'
    $digSize = $_GET['dig_size'];
    $digStyle = $_GET['dig_style'];
    $digWeight = $_GET['dig_weight'];

// Paramètres Personnalisation
    $perL1 = $_GET['per_l1'];
    $perL2 = $_GET['per_l2'];
    $perCoulR = $_GET['per_coul_r'];
    $perCoulV = $_GET['per_coul_v'];
    $perCoulB = $_GET['per_coul_b'];
    $perFont = $_GET['per_font'];
    $perSize = $_GET['per_size'];
    $perStyle = $_GET['per_style'];
    $perWeight = $_GET['per_weight'];
    
    return array($cadCoulR, $cadCoulV, $cadCoulB, $digCoulR, $digCoulV, $digCoulB, $digType, $digSize, $digStyle,
        $digWeight, $perL1, $perL2, $perCoulR, $perCoulV, $perCoulB, $perFont, $perSize, $perStyle, $perWeight);
}

/**
 * @param $svg
 * @return void
 * @throws ImagickException
 */
function genereFichierImagePng($svg)
{
    $im = new Imagick();
    $im->setBackgroundColor(new ImagickPixel('transparent'));
//	$im->setResolution(300, 300); // for 300 DPI example
    $im->readImageBlob($svg);
    $im->setImageFormat("png24"); // ou png32
//	$im->resizeImage(100,100, imagick::FILTER_LANCZOS, 1);
    $fileDst = '/var/www/html/cadran_test.png';
    if ($f = fopen($fileDst, 'w')) {
        $im->writeImageFile($f);
    }
    fclose($f);
    $im->clear();
    $im->destroy();
}

//*************************
// Generation du SVG
//*************************

function genereStringSvg($cadCoulR, $cadCoulV, $cadCoulB, $digCoulR, $digCoulV, $digCoulB, $digType, $digSize,
   $digStyle, $digWeight, $perL1, $perL2, $perCoulR, $perCoulV, $perCoulB, $perFont, $perSize, $perStyle, $perWeight
)
{
    $debutSVG = '<?xml version="1.0" encoding="utf-8" standalone="no"?>
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN"
"http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">
<svg width="1000px" height="1000px" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg" style="background-color:#000;"
xmlns:xlink="http://www.w3.org/1999/xlink">' . "\n";
    $finSVG = '</svg>';

    // TODO : LOGO 1 ne sert à rien ???
    $logo1 = '<path
     style="fill:#949f78;fill-opacity:1;stroke:#000000;stroke-width:1.85257;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
     d="m 637,433  c 0,0 -30.31783,-31.4449664 -60.63566,-31.4449664 -24.25426,0 -30.31783,12.5779864 -30.31783,31.4449664 0,18.866981 6.06357,31.444967 30.31783,31.444967 24.25426,0 30.31783,0 60.63566,-31.444967 z"/>
  <path
     style="fill:#947a78;fill-opacity:1;stroke:#000000;stroke-width:1.84954;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
     d="m 400,433 c 0,0 30.0328579,-31.639568 60.0657159,-31.639568 24.026286,0 30.032858,12.655827 30.032858,31.639568 0,18.983742 -6.006572,31.639568 -30.032858,31.639568 -24.026287,0 -30.032858,0 -60.0657159,-31.639568 z" />';

    $logo = '<g
     inkscape:label="Calque 1"
     id="layer1"
     transform="matrix(3.7795276,0,0,3.7795276,15.271337,39.989172)">
    <path
       style="fill:#949f78;fill-opacity:1;stroke:#000000;stroke-width:0.694855;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
       d="m 159.50979,98.772263 -8.68572,-8.685716 v 5.211423 h -13.89714 a 3.4742907,3.4742907 0 0 0 0,6.94858 h 13.89714 v 5.21143 z"
       id="path1418" />
    <path
       style="fill:#947a78;fill-opacity:1;stroke:#000000;stroke-width:0.694855;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
       d="m 96.992461,98.772263 8.685709,-8.685718 v 5.211428 h 13.89715 a 3.4742861,3.4742861 0 0 1 0,6.948567 h -13.89715 v 5.21143 z"
       id="path2" />
  </g>';

//*************************
// le cadran
//*************************

    $cadCoul = '#' . $cadCoulR . $cadCoulV . $cadCoulB;
    $cadran = '<circle cx="500" cy="500" r="500" style="fill:' . $cadCoul . ';"/>' . "\n";
    $digFont = 'Nimbus Roman No9 L'; //Trocadero

//*************************
// Les digits
//*************************

    $digCoul = '#' . $digCoulR . $digCoulV . $digCoulB;
    $styleDigit = 'style="fill:' . $digCoul . ';stroke:none;font-size:' . $digSize . 'px;font-family:' . $digFont .
        ';font-weight:' . $digWeight . ';font-style:' . $digStyle . ';text-anchor:middle;"';

    $pi = 3.1415926535;
    $rayon = 415;
    $digit = '';

    for ($f = 1; $f < 13; $f++) {
        $angle = (3 - $f) * (2 * $pi / 12);
        $x = round(500 + cos($angle) * $rayon);
        $y = round(500 - $rayon * sin($angle));

        switch ($digType) {
            case 'arabe' :
                $y += $digSize / 3;
                $digit = $digit . '<text x="' . $x . '" y="' . $y . '" ' . $styleDigit . '>' . $f . '</text>' . "\n";
                break;
            case 'romain' :
                $y += $digSize / 3;
                $digit = $digit . '<text x="' . $x . '" y="' . $y . '" ' . $styleDigit . '>' . toChiffreRomain($f) .
                    '</text>' . "\n";
                break;
            case 'forme':
                $digit = $digit . '<circle cx="' . $x . '" cy="' . $y . '" r="' . ($digSize / 3) . '" style="fill:'
                    . $digCoul . '" />' . "\n";
                break;
        }
    }

//*************************
// La personnalisation
//*************************

    $stylePer = 'style="fill:#' . $perCoulR . $perCoulV . $perCoulB . ';font-size:' . $perSize . 'px;font-family:'
        . $perFont . ';font-weight:' . $perWeight . ';font-style:' . $perStyle . ';text-anchor:middle;"';
    $debutL1 = '<text x="500" y="600" ' . $stylePer . '>';

// y variable en fonction de la taille de la fonte
    $y = (int)$perSize + 600;
    $debutL2 = '<text x="500" y="' . $y . '" ' . $stylePer . '>';
    $finPer = '</text>' . "\n";
    $perso = $debutL1 . $perL1 . $finPer . $debutL2 . $perL2 . $finPer;

    $svg = $debutSVG . $cadran . $logo . $digit . $perso . $finSVG;
    return $svg;
}
