<?php
/*
// pour afficher la durée du traitement		
	$mtime = microtime();
	$mtime = explode(" ",$mtime);
	$mtime = $mtime[1] + $mtime[0];
	$starttime = $mtime;
*/

$cad_coul_r=$_GET['cad_coul_r'];
$cad_coul_v=$_GET['cad_coul_v'];
$cad_coul_b=$_GET['cad_coul_b'];

$dig_coul_r=$_GET['dig_coul_r'];
$dig_coul_v=$_GET['dig_coul_v'];
$dig_coul_b=$_GET['dig_coul_b'];

$dig_type=$_GET['dig_type'];
$dig_size=$_GET['dig_size'];
$dig_style=$_GET['dig_style'];
$dig_weight=$_GET['dig_weight'];

$per_l1=$_GET['per_l1'];
$per_l2=$_GET['per_l2'];
$per_coul_r=$_GET['per_coul_r'];
$per_coul_v=$_GET['per_coul_v'];
$per_coul_b=$_GET['per_coul_b'];
$per_font=$_GET['per_font'];
//$per_rvb=$_GET['per_rvb'];
$per_size=$_GET['per_size'];
$per_style=$_GET['per_style'];
$per_weight=$_GET['per_weight'];

//<?xml version="1.0" encoding="UTF-8" standalone="no"

$debut ='<?xml version="1.0" encoding="utf-8" standalone="no"?>
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN"
"http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">
<svg width="1000px" height="1000px" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg" style="background-color:#000;"
xmlns:xlink="http://www.w3.org/1999/xlink">'."\n";

$logo1='<path
     style="fill:#949f78;fill-opacity:1;stroke:#000000;stroke-width:1.85257;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
     d="m 637,433  c 0,0 -30.31783,-31.4449664 -60.63566,-31.4449664 -24.25426,0 -30.31783,12.5779864 -30.31783,31.4449664 0,18.866981 6.06357,31.444967 30.31783,31.444967 24.25426,0 30.31783,0 60.63566,-31.444967 z"/>
  <path
     style="fill:#947a78;fill-opacity:1;stroke:#000000;stroke-width:1.84954;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
     d="m 400,433 c 0,0 30.0328579,-31.639568 60.0657159,-31.639568 24.026286,0 30.032858,12.655827 30.032858,31.639568 0,18.983742 -6.006572,31.639568 -30.032858,31.639568 -24.026287,0 -30.032858,0 -60.0657159,-31.639568 z" />';

$logo='<g
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

$cad_coul='#'.$cad_coul_r.$cad_coul_v.$cad_coul_b;

$cadran ='<circle cx="500" cy="500" r="500" style="fill:'.$cad_coul.';"/>'."\n";


//$test_font='Nimbus Sans Narrow';
//$test_font=$l2;

//$perso1_font='Nimbus Roman';
//bien		Z003;meme police :-( P052;URW Chancery L;Nimbus Sans Narrow (pour un test narrow!)
//pas mal     C059; DejaVu Serif;Noto Mono;URW Bookman;URW Palladio L;Century Schoolbook L
//pas terrible URW Gothic;URW Gothic L;Droid;Nimbus Roman;
//ko 	Droid Sans Fallback;(peut etre les caractère choisis ?)

$dig_font='Nimbus Roman No9 L'; //Trocadero 

//*************************
// Les digits
//*************************

$dig_coul='#'.$dig_coul_r.$dig_coul_v.$dig_coul_b;

$styleDigit='style="fill:'.$dig_coul.';stroke:none;font-size:'.$dig_size.'px;font-family:'.$dig_font.';font-weight:'.$dig_weight.';font-style:'.$dig_style.';text-anchor:middle;"';

/*
@font-face {
  font-family: MaHelvetica;
  src: local("Helvetica Neue Bold"),
       local("HelveticaNeue-Bold"),
       url(MgOpenModernaBold.ttf);
  font-weight: bold;
}
*/


$pi=3.1415926535;
$rayon=415;
$digit='';

switch($dig_type){
	case 'arabe' :
			for($f=1;$f<13;$f++){
			$angle=(3-$f)*(2*$pi/12);
			$x=round(500+cos($angle)*$rayon);
			$y=round(500-$rayon*sin($angle)+$dig_size/3);// décalage du digit /2 pas convaincant
			$digit=$digit.'<text x="'.$x.'" y="'.$y.'" '.$styleDigit.'>'.$f.'</text>'."\n";
			};
		break;
	case 'romain' :
			for($f=1;$f<13;$f++){
			$angle=(3-$f)*(2*$pi/12);
			$x=round(500+cos($angle)*$rayon);
			$y=round(500-$rayon*sin($angle)+$dig_size/3);// pas décalage (centre du cercle ok)
			$digit=$digit.'<text x="'.$x.'" y="'.$y.'" '.$styleDigit.'>'.to_chiffre_romain($f).'</text>'."\n"; //to_chiffre_romain pour convertir
			};
		break;
	case 'forme':
			for($f=1;$f<13;$f++){
			$angle=(3-$f)*(2*$pi/12);
			$x=round(500+cos($angle)*$rayon);
			$y=round(500-$rayon*sin($angle));// décalage du rayon
			$digit=$digit.'<circle cx="'.$x.'" cy="'.$y.'" r="'.($dig_size/3).'" style="fill:'.$dig_coul.'" />'."\n";
			};
		break;
}



//font-family:
//ok	Consolas Garamond Cambria dejavu 
//ko	droid noto

//$perso1_font='dejavu';

$style_Per='style="fill:#'.$per_coul_r.$per_coul_v.$per_coul_b.';font-size:'.$per_size.'px;font-family:'.$per_font.';font-weight:'.$per_weight.';font-style:'.$per_style.';text-anchor:middle;"';

$debutL1 ='<text x="500" y="600" '.$style_Per.'>';

// y variable en fonction de la taille de la fonte
$y=(int)$per_size +600;

$debutL2 ='<text x="500" y="'.$y.'" '.$style_Per.'>';

$fin_Per='</text>'."\n";

$perso=$debutL1.$per_l1.$fin_Per.$debutL2.$per_l2.$fin_Per;

$fin='</svg>';


$svg=$debut.$cadran.$logo.$digit.$perso.$fin;


//	$svg = file_get_contents('cadra32.svg'); 

	$im = new Imagick();

	$im->setBackgroundColor(new ImagickPixel('transparent'));
//	$im->setResolution(300, 300); // for 300 DPI example
	$im->readImageBlob($svg);

	$im->setImageFormat("png24");// ou png32
//	$im->resizeImage(100,100, imagick::FILTER_LANCZOS, 1);
	
	$fileDst='/var/www/html/cadran_test.png';

	if($f=fopen($fileDst,'w')){
	  $im->writeImageFile($f);
	}
	fclose($f);

//	$im->writeImage('/var/www/html/fronttest.png');  //ne marche pas
	$im->clear();
	$im->destroy();
	
	
	
//echo $svg;
/*
// la fin
	$mtime = microtime();
	$mtime = explode(" ",$mtime);
	$mtime = $mtime[1] + $mtime[0];
	$endtime = $mtime;
	$totaltime = ($endtime - $starttime);
	echo 'Page générée en '.number_format($totaltime,4,',','').' s';	
*/

function to_chiffre_romain($chiffre)
	{
		switch($chiffre)
            {
                case 1:
                    $chiffreRomain = 'I';
                    break;
                case 2:
                    $chiffreRomain = 'II';
                    break;
                case 3:
                    $chiffreRomain = 'III';                   
                    break;
                case 4:
                    $chiffreRomain = 'IV';
                    break; 
                case 5:
                    $chiffreRomain = 'V';
                    break; 
                case 6:
                    $chiffreRomain = 'VI';
                    break; 
                case 7:
                    $chiffreRomain = 'VII';
                    break; 
                case 8:
                    $chiffreRomain = 'VIII';
                    break; 
                case 9:
                    $chiffreRomain = 'IX';
                    break; 
                case 10:
                    $chiffreRomain = 'X';
                    break;
                case 11:
                    $chiffreRomain = 'XI';
                    break;
                case 12:
                    $chiffreRomain = 'XII';  
                    break;
			}
		return($chiffreRomain);
	}
					
?>
