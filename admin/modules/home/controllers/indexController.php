<?php

require("../carbon/autoload.php");
    use Carbon\Carbon;
	use Carbon\CarbonInterval;

function construct() {

	load_model('index');

}


function indexAction() {

	// if(isset($_POST['day'])){
	// 	$day = $_POST['day'];
	// }else{
	// 	$day = "";
	// 	$subDay = Carbon::now("Asia/Ho_Chi_Minh")->subdays(365)->toDateString();
	// }

	// if($day == "7day"){
	// 	$subDay = Carbon::now("Asia/Ho_Chi_Minh")->subdays(7)->toDateString();
	// }else if($day == "28day"){
	// 	$subDay = Carbon::now("Asia/Ho_Chi_Minh")->subdays(28)->toDateString();
	// }else if($day == "90day"){
	// 	$subDay = Carbon::now("Asia/Ho_Chi_Minh")->subdays(90)->toDateString();
	// }else if($day == "365day"){
	// 	$subDay = Carbon::now("Asia/Ho_Chi_Minh")->subdays(365)->toDateString();
	// }
	 $subDay = Carbon::now("Asia/Ho_Chi_Minh")->subdays(365)->toDateString();
	$now = Carbon::now("Asia/Ho_Chi_Minh")->toDateString();

	$data = getStatistical($subDay,$now);

	load_view('index',$data);
}

?>