<?php

switch ($action) {
	case 'productadd':
		if (!empty($_GET['id'])){
			$pageManager= new PageManager($bdd);
			$page = $pageManager->get($_GET['id']);
			//img
			$imagestable = explode('|', $page->imgsrcs());
			$imgstr = array();
			$i=0;
			foreach ($imagestable as $img){
				$imgstr[] = array('src'=>$img,'position'=>$i);
				$i++;
			}
			array_pop($imgstr);
			
			require_once( 'lib/woocommerce-api.php' );
			
			$options = array(
				'debug'           => true,
				'return_as_array' => false,
				'validate_url'    => false,
				'timeout'         => 120,
				'ssl_verify'      => false,
			);
			
			$product = array( 
					'title' => $page->title(),
					'type' => 'simple', 
					'status' => 'draft',
					'regular_price' => '0', 
					'sale_price' => '0',
					'enable_html_description'=>true,
					'description' => 'Source : Créé par '.$page->username().'<br>License : '.$page->licens().'<br>'.$page->summary() , 
					'short_description' => substr($page->summary(), 0 , 145),
					'downloadable' => true , 'virtual'=>true , 
					'downloads'  => (object) array(
							array(
									'name'=>$page->title(),
									'file'=>$page->url()		
							)		
					),
					'images' => (object) $imgstr
			) ;
			
			try {
			
				$client = new WC_API_Client( 'http://www.filamentetimprimante3d.com', 'ck_97892afdbd1baa0ec4701b9f8cae519baca1a9a8', 'cs_4970ddffe46fe98cee53efbaac2ace8741840761', $options );
				
				
				
				ob_start();
				echo '<pre>';
				print_r($client->products->create($product));
				echo '</pre>';
				require_once 'view/wooapi/productnext.php';
				$content = ob_get_contents();
				ob_end_clean();
				require_once 'view/layout/layout.php';
				
			} catch ( WC_API_Client_Exception $e ) {
				ob_start();
				echo '<pre>';
				
				echo $e->getMessage() . PHP_EOL;
				echo $e->getCode() . PHP_EOL;
			
				if ( $e instanceof WC_API_Client_HTTP_Exception ) {
			
					print_r( $e->get_request() );
					print_r( $e->get_response() );
				}
				
				echo '</pre>';
				require_once 'view/wooapi/productnext.php';
				$content = ob_get_contents();
				ob_end_clean();
				require_once 'view/layout/layout.php';
			}
		}
	break;
	
	case 'productnext':
		if (!empty($_GET['id'])){
			$pageManager = new PageManager($bdd);
			$nextid= $_GET['id']+1;
			while (!$pageManager->get($nextid)){
				$nextid++;
			}
			header('Location: ?controler=wooapi&action=productadd&id='.$nextid);
		}else{
			echo 'fail';
		}
	break;
		
	default:
		;
	break;
}
