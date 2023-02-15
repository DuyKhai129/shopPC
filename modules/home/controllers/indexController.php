<?php


function construct() {

	load_model('index');	

}

function format_currency($n=0){
	$n=(string)$n;
	$n=strrev($n);
	$res='';
	for($i=0;$i<strlen($n);$i++){
		if($i%3==0 && $i!=0){
			$res.='.';
		
		}
		$res.=$n[$i];
	}
	$res=strrev($res);
	return $res;


}

function textShorten($text, $limit = 400){
    $text = $text. " ";
    $text = substr($text, 0, $limit);
    $text = substr($text, 0, strrpos($text, ' '));
    $text = $text."...";
    return $text;
 }



function indexAction() {
	
	$pcs = getAllPC();
	$tablets = getAllTablet();
	$laptops = getAllLaptop();
	$hots = getAllHot();
	$sliders = getAllSlider();
	$_SESSION['product_hot'] = $hots;
	$data = [ $pcs, $tablets, $laptops, $hots, $sliders];
	load_view('index',$data);
}




function addAction() {

}




function editAction() {

}