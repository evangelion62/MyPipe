<?php
// Rapporte les erreurs d'exécution de script mais pas les warning
error_reporting(E_ALL & ~E_WARNING);
$URL = '';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $URL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$resultat = curl_exec ($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode != 404){
	
	$page = new DOMDocument();
	$page->loadHTML($resultat);
	
	
	$thingpage =$page->getElementById('thing-page');
	
	foreach ($page->getElementsByTagName('div') as $div) {
		if( $div->getAttribute('class') == 'thing-page-image featured' ){
			foreach ($div->getElementsByTagName('img') as $img){
				
				$imgsrc=$img->getAttribute('data-cfsrc');
				if(!empty($imgsrc)){
					$imgtable[]=$imgsrc;
				}
				$imgsrc=$img->getAttribute('data-img');
				if(!empty($imgsrc)){
					$imgtable[]=$imgsrc;
				}
			}
		}
	}
	
	?>
	
	<?php 
	foreach ($imgtable as $img){?>
	<img src="<?php echo $img?>">
	<?php 
	}
}else {
	echo '404';
}
?>
