<?php 


function insertUser($username, $password, $fullname, $mail, $phone, $address, $create_date){

	$password = md5($password);

	$data = [

		'username' => $username,
		'password' => $password,
		'fullname' => $fullname,
		'mail' => $mail,
		'phone' => $phone,
		'address' =>$address,
		'create_date' => $create_date
		];

	return db_insert("tbl_customer", $data);

}




function checkUser($username, $mail, $phone){

	$check =true;
	if(db_num_rows("SELECT * FROM `tbl_customer` WHERE `username` = '$username'")>0){
		$check = false;
	};
	if(db_num_rows("SELECT * FROM `tbl_customer` WHERE `mail` = '$mail'")>0){
		$check = false;
	};
	if(db_num_rows("SELECT * FROM `tbl_customer` WHERE `phone` = '$phone'")>0){
		$check = false;
	};

	return $check;

}

// lấy thông tin tài khoản theo tên đăng nhập
function getUserByUsername($username){

	return db_fetch_array("SELECT * FROM `tbl_customer` WHERE `username` = '{$username}'");

}

function updateUser($fullname, $username,$mail,$phone,$address){

	$data = [
		'fullname' => $fullname,
		'username' => $username,
		'mail' => $mail,
		'phone' => $phone,
		'address' =>$address
	];
	return db_update('tbl_customer', $data, "`username` = '{$username}'");
}

function changePass($password,$password1){

	$data = [
		'password' => $password
	];
	return db_update('tbl_customer', $data, "`password` = '{$password1}'");
}


function checkLogin($username, $password){

	$password = md5($password);
	$check =false;
	if(db_num_rows("SELECT * FROM `tbl_customer` WHERE `username` = '$username' AND `password` = '$password'") == 1){
		$check = true;
	}

	return $check;
}





function getUser($username, $password){

	$password = md5($password);
	return db_fetch_row("SELECT * FROM `tbl_customer` WHERE `username` = '$username' AND `password` = '$password'");

}



function logout(){

	unset($_SESSION['cart']);
	unset($_SESSION['id_customer']);
	unset($_SESSION['fullname']);

}




 ?>