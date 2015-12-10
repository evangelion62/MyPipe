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
				$imgManager = new ImgManager($bdd);
				$pageoptionManager = new PageoptionManager($bdd);
				
				//page url et title
				$bddpage= new Page(array());
				$title = $page->getElementsByTagName('title');
				$title=$title->item(0);
				$title=$title->textContent;
				$bddpage->setUrl($URL);
				$bddpage->setTitle($title);
				$pageManager->add($bddpage);
				if(!$bddpage=$pageManager->get($URL,'url')){
					ob_start();
					print_r($pageoption);
					require_once 'view/pipe/pipeexecnext.php';
					$content = ob_get_contents();
					ob_end_clean();
					require_once 'view/layout/layout.php';
					break;
				}
				
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
				
				foreach ($imgtable as $img){
					$bddimg = new Img(array());
					$bddimg->setPageid($bddpage->id());
					$txt=$img;
					
					$re1='.*?';
					$re2='(?:[a-z][a-z\\.\\d_]+)\\.(?:[a-z\\d]{3})(?![\\w\\.])';
					$re3='.*?';
					$re4='((?:[a-z][a-z\\.\\d_]+)\\.(?:[a-z\\d]{3}))(?![\\w\\.])';
					
					if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4."/is", $txt, $matches))
					{
						$file1=$matches[1][0];
						$bddimg->setName($file1);
					}else{
						$bddimg->setName($img);
					}
					
					$bddimg->setName($img);
					$bddimg->setsrc($img);
					$imgManager->add($bddimg);
				}
				
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
				
				$pageoption = new Pageoption(array());
				$pageoption->setPageid($bddpage->id());
				$pageoption->setName('nbviews'.$bddpage->id());
				$pageoption->setValue($views[0]);
				
				$pageoptionManager->add($pageoption);
				
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
				$pageoption = new Pageoption(array());
				$pageoption->setPageid($bddpage->id());
				$pageoption->setName('nbdls'.$bddpage->id());
				$pageoption->setValue($dls[0]);
				
				$pageoptionManager->add($pageoption);
				
				
				//vue de transition
				ob_start();
				print_r($pageoption);
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
}