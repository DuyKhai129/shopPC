<?php

function construct()
{
	load_model('index');
}

function indexAction()
{


}

function addAction()
{
	$categories = getAllCategory();
	$brands = getAllBrand();
	$data = [$categories, $brands];
	$id_category;
	$id_brand;
	$name;
	$code;
	$price;
	$promotional_price;
	$quantity;
	$status;
	$description;
	$screen;
	$ram;
	$cpu;
	$memory;
	$operating_system;
	$front_camera;
	$rear_camera;
	$user;
	$level;
	$err = array();
	if (!empty($_POST['btn_submit'])) {

		if (!empty($_POST['id_category'])) {
			$id_category = $_POST['id_category'];
		} else {
			$err['id_category'] = $_POST['id_category'];
		}

		if (!empty($_POST['level'])) {
			$level = $_POST['level'];
		} else {
			$err['level'] = "level không được rỗng";
		}

		if (!empty($_POST['id_brand'])) {
			$id_brand = $_POST['id_brand'];
		} else {
			$err['id_brand'] = "id_brand không được rỗng";
		}

		if (!empty($_POST['name'])) {
			$name = $_POST['name'];
		} else {
			$err['name'] = "name không được rỗng";
		}

		if (!empty($_POST['code'])) {
			$code = $_POST['code'];
		} else {
			$err['code'] = "code không được rỗng";
		}

		if (!empty($_POST['price'])) {
			$price = $_POST['price'];
		} else {
			$err['price'] = "price không được rỗng";
		}

		if (!empty($_POST['promotional_price'])) {
			$promotional_price = $_POST['promotional_price'];
		} else {
			$price = "";
		}

		if (!empty($_POST['quantity'])) {
			$quantity = $_POST['quantity'];
		} else {
			$err['quantity'] = "quantity không được rỗng";
		}

		if (!empty($_POST['status'])) {
			$status = $_POST['status'];
		} else {
			$err['status'] = "status không được rỗng";
		}

		if (!empty($_POST['description'])) {
			$description = $_POST['description'];
		} else {
			$err['description'] = "description không được rỗng";
		}

		if (!empty($_POST['screen'])) {
			$screen = $_POST['screen'];
		} else {
			$err['screen'] = "screen không được rỗng";
		}

		if (!empty($_POST['ram'])) {
			$ram = $_POST['ram'];
		} else {
			$err['ram'] = "ram không được rỗng";
		}

		if (!empty($_POST['cpu'])) {
			$cpu = $_POST['cpu'];
		} else {
			$err['cpu'] = "cpu không được rỗng";
		}

		if (!empty($_POST['memory'])) {
			$memory = $_POST['memory'];
		} else {
			$err['memory'] = "memory không được rỗng";
		}

		if (!empty($_POST['operating_system'])) {
			$operating_system = $_POST['operating_system'];
		} else {
			$err['operating_system'] = "operating_system không được rỗng";
		}

		if (!empty($_POST['front_camera'])) {
			$front_camera = $_POST['front_camera'];
		} else {
			$err['front_camera'] = "front_camera không được rỗng";
		}

		if (!empty($_POST['rear_camera'])) {
			$rear_camera = $_POST['rear_camera'];
		} else {
			$err['rear_camera'] = "rear_camera không được rỗng";
		}

		if (!empty($_POST['user'])) {
			$user = $_POST['user'];
		} else {
			$err['user'] = "user không được rỗng";
		}

			// xử lý ảnh
			$permitted  = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];
	
			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "public/uploads/".$unique_image;
	
			if(!empty($file_name)){
				//Nếu người dùng chọn ảnh
				if ($file_size > 204800000) {
	
				 $alert = "<span class='success'>Kích thước hình ảnh phải nhỏ hơn 100MB!</span>";
				return $alert;
				} 
				elseif (in_array($file_ext, $permitted) === false) 
				{
				$alert = "<span class='success'>You can upload only:-".implode(', ', $permitted)."</span>";
				return $alert;
				}
				if (empty($err)) {
					move_uploaded_file($file_temp,$uploaded_image);
					$res = [
						'id_category ' => $id_category,
						'id_brand ' => $id_brand,
						'name' => $name,
						'code' => $code,
						'price' => $price,
						'promotional_price' => $promotional_price,
						'quantity' => $quantity,
						'status' => $status,
						'description' => $description,
						'screen' => $screen,
						'ram' => $ram,
						'cpu' => $cpu,
						'memory' => $memory,
						'operating_system' => $operating_system,
						'front_camera' => $front_camera,
						'rear_camera' => $rear_camera,
						'user' => $user,
						'image' => $unique_image,
						'level' => $level
		
					];
					if (insert_product($res)) {
		
						echo " <script type='text/javascript'> alert('Thêm mới sản phẩm thành công👌👌👌');</script>";
					} else {
		
						echo " <script type='text/javascript'> alert('Thêm mới danh mục sản phẩm thất bại😭😭😭');</script>";
					}
		
				} else {
		
					echo " <script type='text/javascript'> alert('Thêm mới danh mục sản phẩm thất bại😔😔😔');</script>";
				}
			}

	}

	load_view('add', $data);
}

function listAction()
{

	$data_tmp = getAllProduct();

	for ($i = 0; $i < count($data_tmp); $i++) {

		$data_tmp[$i]['category'] = get_category_by_id($data_tmp[$i]['id_category']);
		$data_tmp[$i]['brand'] = get_brand_by_id($data_tmp[$i]['id_brand']);
	}
	;

	//phân trang//////////////////////////////////////////////////
	//$id_cat = $_GET['id_cat'];
	// $name = getNameCatById($id_cat);
	// $data_tmp = getAllByIDCat($id_cat);
	// $id =$id_cat;
	$page;
	if (!empty($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = 1;
	}

	$numProduct = count($data_tmp);
	$productOnPage = 5;
	$num = ceil($numProduct / $productOnPage);
	if (!empty($_GET['page']) && $_GET['page'] > $num) {
		$page = $num;
	}
	$start = ($page - 1) * $productOnPage;
	$res = [];
	for ($i = $start; $i < $start + $productOnPage; $i++) {
		if (isset($data_tmp[$i]))
			$res[] = $data_tmp[$i];
	}
	;

	$data = [$res, $num, $page];
	////////////////////////////////////////////////////////////////
	load_view('list', $data);
}

function editAction()
{
	$id = $_GET['id'];
	$products = get_product_by_id($id);
	$categories = getAllCategory();
	$brands = getAllBrand();
	$data = [$categories, $brands, $products];
	load_view('show', $data);


}

function updateAction()
{
	$id = $_GET['id'];
	$data = get_product_by_id($id);
	$data1 = array();
	if (!empty($_POST['btn_submit'])) {

		if (empty($_POST['id_category'])) {
			$data1['id_category'] = $data[0]['id_category'];
		} else {
			$data1['id_category'] = $_POST['id_category'];
		}

		if (empty($_POST['level'])) {
			$data1['level'] = $data[0]['level'];
		} else {
			$data1['level'] = $_POST['level'];
		}

		if (empty($_POST['id_brand'])) {
			$data1['id_brand'] = $data[0]['id_brand'];
		} else {
			$data1['id_brand'] = $_POST['id_brand'];
		}

		if (empty($_POST['name'])) {
			$data1['name'] = $data[0]['name'];
		} else {
			$data1['name'] = $_POST['name'];
		}

		if (empty($_POST['code'])) {
			$data1['code'] = $data[0]['code'];
		} else {
			$data1['code'] = $_POST['code'];
		}

		if (empty($_POST['price'])) {
			$data1['price'] = $data[0]['price'];
		} else {
			$data1['price'] = $_POST['price'];
		}

		if (empty($_POST['promotional_price'])) {
			$data1['promotional_price'] = $data[0]['promotional_price'];
		} else {
			$data1['promotional_price'] = $_POST['promotional_price'];
		}

		if (empty($_POST['quantity'])) {
			$data1['quantity'] = $data[0]['quantity'];
		} else {
			$data1['quantity'] = $_POST['quantity'];
		}

		if (empty($_POST['status'])) {
			$data1['status'] = $data[0]['status'];
		} else {
			$data1['status'] = $_POST['status'];
		}

		if (empty($_POST['description'])) {
			$data1['description'] = $data[0]['description'];
		} else {
			$data1['description'] = $_POST['description'];
		}

		if (empty($_POST['screen'])) {
			$data1['screen'] = $data[0]['screen'];
		} else {
			$data1['screen'] = $_POST['screen'];
		}

		if (empty($_POST['ram'])) {
			$data1['ram'] = $data[0]['ram'];
		} else {
			$data1['ram'] = $_POST['ram'];
		}

		if (empty($_POST['cpu'])) {
			$data1['cpu'] = $data[0]['cpu'];
		} else {
			$data1['cpu'] = $_POST['cpu'];
		}

		if (empty($_POST['memory'])) {
			$data1['memory'] = $data[0]['memory'];
		} else {
			$data1['memory'] = $_POST['memory'];
		}

		if (empty($_POST['operating_system'])) {
			$data1['operating_system'] = $data[0]['operating_system'];
		} else {
			$data1['operating_system'] = $_POST['operating_system'];
		}

		if (empty($_POST['front_camera'])) {
			$data1['front_camera'] = $data[0]['front_camera'];
		} else {
			$data1['front_camera'] = $_POST['front_camera'];
		}

		if (empty($_POST['rear_camera'])) {
			$data1['rear_camera'] = $data[0]['rear_camera'];
		} else {
			$data1['rear_camera'] = $_POST['rear_camera'];
		}

		if (empty($_POST['user'])) {
			$data1['user'] = $data[0]['user'];
		} else {
			$data1['user'] = $_POST['user'];
		}

		// xử lý ảnh
		$permitted  = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_temp = $_FILES['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		$uploaded_image = "public/uploads/".$unique_image;

		if (!empty($file_name)) {
			//Nếu người dùng chọn ảnh
			if ($file_size > 204800000) {

				$alert = "<span class='success'>Kích thước hình ảnh phải nhỏ hơn 100MB!</span>";
			   return $alert;
			   } 
			   elseif (in_array($file_ext, $permitted) === false) 
			   {
			   $alert = "<span class='success'>You can upload only:-".implode(', ', $permitted)."</span>";
			   return $alert;
			   }
			move_uploaded_file($file_temp,$uploaded_image);
			$data1['image'] = $unique_image;
		} else {
			$data1['image'] = $data[0]['image'];
		}
	}

		///////////////////////////////////////
		if (update_product_by_id($id, $data1)) {
			// $res = get_product_by_id($id);
			$products = get_product_by_id($id);
			$categories = getAllCategory();
			$brands = getAllBrand();
			$data = [$categories, $brands, $products];
			load_view('show', $data);
			echo " <script type='text/javascript'> alert('Cập nhật sản phẩm thành công👌👌👌');</script>";
		} else {
			load_view('show', $data);
			echo " <script type='text/javascript'> alert('Cập Nhật sản phẩm thất bại😭😭😭');</script>";
		}
}

function deleteAction()
{

	$id = $_GET['id'];
	delete_product_by_id($id);
	header('location:?modules=products&controllers=index&action=list');
}