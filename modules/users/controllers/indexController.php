<?php 

function construct() {

	load_model('index');
}




function indexAction(){

	if(isset($_GET['report']))
		echo " <script type='text/javascript'> alert('Bạn cần đăng nhập để mua hàng');</script>";

	load_view('index');
}



function logoutAction(){
	
	logout();
	header('location:?modules=home');
}





function loginAction(){

	$username;
	$password;
	$err = array();
	if (!empty($_POST['btn_submit'])) {
			
		if (!empty($_POST['username'])) {
			$username = $_POST['username'];
		}else{
			$err['username'] = "username không được để rỗng";
		}

		if (!empty($_POST['password'])) {
			$password = $_POST['password'];
		}else{
			$err['password'] = "password không được để rỗng";
		}

		if(empty($err)){

			if(checkLogin($username, $password)){

				$dataUser = getUser($username, $password);
				$_SESSION['id_customer'] = $dataUser['id'];
				$_SESSION['username'] = $dataUser['username'];
				$_SESSION['fullname'] = $dataUser['fullname'];
				header('location:?modules=home');
			}else{

				echo " <script type='text/javascript'> alert('Tài khoản hoặc mật khẩu không chính sắc!!!🙏🙏🙏');</script>";
			}
		}else{

			echo " <script type='text/javascript'> alert('Bạn phải điền đầy đủ thông tin!!!😭😭😭');</script>";
		}

	}

	load_view('index');

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


function crateAcountAction(){

	$username;
	$password;
	$mail;
	$phone;
	$fullname;
	$address;
	$err = array();

	if(!empty($_POST['btn_submit_crate'])){

		if (!empty($_POST['username'])) {
			$username = $_POST['username'];
		}else{
			$err['username'] = "username không được để rỗng";
		}

		if (!empty($_POST['password'])) {
			$password = $_POST['password'];
		}else{
			$err['password'] = "password không được để rỗng";
		}

		if (!empty($_POST['mail'])) {
			$mail = $_POST['mail'];
		}else{
			$err['mail'] = "mail không được để rỗng";
		}

		if (!empty($_POST['phone'])) {
			$phone = $_POST['phone'];
		}else{
			$err['phone'] = "phone không được để rỗng";
		}

		if (!empty($_POST['fullname'])) {
			$fullname = $_POST['fullname'];
		}else{
			$err['fullname'] = "fullname không được để rỗng";
		}

		if (!empty($_POST['address'])) {
			$address = $_POST['address'];
		}else{
			$err['address'] = "address không được để rỗng";
		}

		if(empty($err)){
			if(checkUser($username, $mail, $phone)){

				$create_date = date("d/m/Y",time());
				insertUser($username, $password, $fullname, $mail, $phone, $address, $create_date);
				echo " <script type='text/javascript'> alert('Đăng ki tài khoản thành công!!!👏👏👏');</script>";
				
			}else{

				echo " <script type='text/javascript'> alert('Thông tin tài khoản đã tồn tại trên hệ thống!!!🤔🤔🤔');</script>";
				
			}

		}else{

			echo " <script type='text/javascript'> alert('Bạn phải điền đầy đủ thông tin!!!😢😢😢');</script>";
			
		}
	}


	load_view('index');
}



function informationAction(){
	$data = getUserByUsername($_SESSION['username']);
	load_view('information',$data);
}


function changeInformationAction(){
	$fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $mail = $_POST['mail'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $data = [
        [
        'fullname' => $fullname,
        'username' => $username,
        'mail' => $mail,
        'phone' => $phone,
        'address' =>$address
        ]
    ];
    $num = updateUser($fullname, $username,$mail,$phone,$address);
    if($num ==1){
        load_view('information',$data);
        echo " <script type='text/javascript'> alert('Cập Nhật Thành Công!!!👏👏👏');</script>";
    }
    else {
        load_view('information',$data);
        echo " <script type='text/javascript'> alert('Thông Tin Đã Tồn Tại!!!😢😢😢');</script>";
    }
}


function passAction(){
	load_view("pass");
}

function changePassAction(){

      if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $oldPass =  $_POST['pass_old'];
        $newPass1 = $_POST['pass_new'];
        $newPass2 = $_POST['confirm_pass'];
        if(md5($oldPass) == $_SESSION['password']){
			if($newPass1 == $newPass2 &&$oldPass != $newPass2){
                if(changePass(md5($newPass1),md5($oldPass))==1){
					load_view("pass");
                    echo " <script type='text/javascript'> alert('Cập Nhật Thành Công!!!👏👏👏)</script>";
                }
                else{
					load_view("pass");
                    echo " <script type='text/javascript'> alert('Cập Nhật Không Thành Công!!!😛😛😛');</script>";
                }
            }
            else{
				load_view("pass");
                    echo " <script type='text/javascript'> alert('Mật Khẩu Mới Không Khớp, Hoặc Bị Trùng Mật Khẩu Cũ!!!🙏🙏🙏');</script>";
                }
        }
        else {
				load_view("pass");
                    echo " <script type='text/javascript'> alert('Mật Khẩu Cũ Không Đúng!!!🙏🙏🙏');</script>";
                }
            
    }  
}

 ?>