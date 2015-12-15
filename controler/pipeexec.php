<?php
switch ($action) {
	case 'getallhtmlpage':
		
		if(!empty($_GET['url'])&&!empty($_GET['value'])&&!empty($_GET['pipeid'])){
			
	
			$URL = $_GET['url'];
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $URL);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$resultat = curl_exec ($ch);
			$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);
				
			if ($httpCode != 404){
				//création du DOM de la page
				$page = new DOMDocument();
				$page->loadHTML($resultat);
				
				//bddmanager
				$pageManager = new PageManager($bdd);
				
				//page url et title
				$bddpage= new Page(array());
				$title = $page->getElementsByTagName('title');
				$title=$title->item(0);
				$title=$title->textContent;
				$bddpage->setUrl($URL);
				$bddpage->setTitle($title);
				
				//page img
				$thingpage =$page->getElementById('thing-page');
				$imgtable=array();
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
				
				$imgserialize = serialize($imgtable);
				$bddpage->setImgsrcs($imgserialize);
				
				//nombre de vue
				foreach ($page->getElementsByTagName('span') as $spans) {
					if( $spans->getAttribute('class') == 'thing-views' ){
						foreach ($spans->getElementsByTagName('span') as $span){
							if($span->getAttribute('class')=='interaction-count'){
								$views[]=$span->textContent;
							}
						}
					}
				}
				$bddpage->setViews($views[0]);
				
				//nb dl
				foreach ($page->getElementsByTagName('span') as $spans) {
					if( $spans->getAttribute('class') == 'thing-downloads' ){
						foreach ($spans->getElementsByTagName('span') as $span){
							if($span->getAttribute('class')=='interaction-count'){
								$dls[]=$span->textContent;
							}
						}
					}
				}
				
				$bddpage->setDls($dls[0]);
				
				//nb like
				foreach ($page->getElementsByTagName('div') as $divs) {
					if( $divs->getAttribute('class') == 'thing-info thing-interact thing-interaction-parent not-for-tiny' ){
						foreach ($divs->getElementsByTagName('span') as $span){
							if($span->getAttribute('class')=='interaction-count'){
								$nblikes[]=$span->textContent;
							}
						}
					}
				}
				
				$bddpage->setNblike($nblikes[0]);
				
				//summary
				foreach ($page->getElementsByTagName('div') as $divs) {
					if( $divs->getAttribute('class') == 'thing-info-content' ){
						foreach ($divs->getElementsByTagName('p') as $p){
								$summary[]=$p->textContent;
						}
					}
				}
				
				if(!empty($summary)){

					$bddpage->setSummary($summary[0]);
				}
				
				//license
				foreach ($page->getElementsByTagName('a') as $divs) {
					if( $divs->getAttribute('rel') == 'license' ){
							$license=$divs->textContent;
					}
				}
				
				$bddpage->setLicens($license);
				
				//username
				foreach ($page->getElementsByTagName('div') as $divs) {
					if( $divs->getAttribute('class') == 'thing-header-data' ){
						foreach ($divs->getElementsByTagName('a') as $span){
								$username[]=$span->textContent;
						}
					}
				}
				$bddpage->setUsername($username[0]);
				
				//comments
				foreach ($page->getElementsByTagName('div') as $divs) {
					if( $divs->getAttribute('class') == 'comment-body' ){
						foreach ($divs->getElementsByTagName('span') as $span){
							if($span->getAttribute('class')=='comment-text'){
								$comments[]=$span->textContent;
							}
						}
					}
				}
				
				if(!empty($comments)){

					$comments = serialize($comments);
					$bddpage->setComments($comments);
				}
				
				//tags
				foreach ($page->getElementsByTagName('div') as $divs) {
					if( $divs->getAttribute('class') == 'taglist' ){
						foreach ($divs->getElementsByTagName('a') as $a){
								$tags[]=$a->textContent;
						}
					}
				}
				
				if(!empty($tags)){
					$tags=serialize($tags);
					$bddpage->setTags($tags);
				}
				
				
				$pageManager->add($bddpage);
				//vue de transition
				ob_start();
				//print_r($tags);
				require_once 'view/pipe/pipeexecnext.php';
				$content = ob_get_contents();
				ob_end_clean();
				require_once 'view/layout/layout.php';
			}else{
				ob_start();
				require_once 'view/pipe/pipeexecnext.php';
				echo '404';
				$content = ob_get_contents();
				ob_end_clean();
				require_once 'view/layout/layout.php';
			}
		}
	
	break;
	
	case 'getnextpage':
		if (!empty($_GET['id'])&&!empty($_GET['lastvalue'])){
			$pipeManager = new PipeManager($bdd);
			$pipe = $pipeManager->get($_GET['id']);
			
			$url = $pipe->baseurl().$_GET['lastvalue']++;
			header('Location: ?controler=pipeexec&action=getallhtmlpage&url='.$url.'&value='.$_GET['lastvalue'].'&pipeid='.$_GET['id']);
		}else{
			echo'fail';
		}
	break;
	
	case 'getby':
		//bddmanager
		$pageManager = new PageManager($bdd);
		$bddpage= new Page(array());
		$page = new DOMDocument();
		$urlbase='http://www.thingiverse.com/thing:';
		
		if(!empty($_GET['lastvalue'])&&!empty($_GET['nb'])){
			$_GET['lastvalue']=(int)$_GET['lastvalue'];
			$_GET['nb']=(int)$_GET['nb'];
			
			for ($i = 0; $i < $_GET['nb']; $i++) {
				
				$URL = $urlbase.($_GET['lastvalue']+$i);
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $URL);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$resultat = curl_exec ($ch);
				$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				curl_close($ch);
				
				if ($httpCode != 404){
					//création du DOM de la page
					
					$page->loadHTML($resultat);
				
					//page url et title
					$title = $page->getElementsByTagName('title');
					$title=$title->item(0);
					$title=$title->textContent;
					$bddpage->setUrl($URL);
					$bddpage->setTitle($title);
				
					//page img
					$thingpage =$page->getElementById('thing-page');
					$imgtable=array();
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
				
					$imgserialize = serialize($imgtable);
					$bddpage->setImgsrcs($imgserialize);
				
					//nombre de vue
					foreach ($page->getElementsByTagName('span') as $spans) {
						if( $spans->getAttribute('class') == 'thing-views' ){
							foreach ($spans->getElementsByTagName('span') as $span){
								if($span->getAttribute('class')=='interaction-count'){
									$views[]=$span->textContent;
								}
							}
						}
					}
					$bddpage->setViews($views[0]);
				
					//nb dl
					foreach ($page->getElementsByTagName('span') as $spans) {
						if( $spans->getAttribute('class') == 'thing-downloads' ){
							foreach ($spans->getElementsByTagName('span') as $span){
								if($span->getAttribute('class')=='interaction-count'){
									$dls[]=$span->textContent;
								}
							}
						}
					}
				
					$bddpage->setDls($dls[0]);
				
					$pageManager->add($bddpage);
				}else{
					echo '404';
				}
			}	
		}
		ob_start();
		//print_r($bddpage);
		require_once 'view/pipe/pipeexecnext.php';
		$content = ob_get_contents();
		ob_end_clean();
		require_once 'view/layout/layout.php';
	break;
}