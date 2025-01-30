<?php
include "config.php";

$query_website=mysqli_query($conn,"SELECT * FROM `system_settings` WHERE `id`=1");
$rows_website=mysqli_fetch_array($query_website);
global $rows_website;
$base_url=$rows_website['website_url'];
$user_url=$rows_website['website_url']."user/";

function title(){
	global $conn;
	$query_website=mysqli_query($conn,"SELECT * FROM `system_settings` WHERE `id`=1");
$rows_website=mysqli_fetch_array($query_website);

	echo $rows_website['website_name'];
}
function date_time(){
	echo date("d/m/Y");
}
function categoryTree($parent_id = 0, $sub_mark = ''){    global $conn;    $query = $conn->query("SELECT * FROM others_categories WHERE parent_id = $parent_id ORDER BY category_name ASC");       if($query->num_rows > 0){        while($row = $query->fetch_assoc()){            echo '<option value="'.$row['id'].'"';  echo '>'.$sub_mark.$row['category_name'].'</option>';            categoryTree($row['id'], $sub_mark.'---');        }    }}

function message($message){
	echo "
	<div class='col-md-12' 
    style='background: #90eb90';>
	<p style='color: #0b840b;text-align: center;'>".$message."</p>
	</div>"
	;
}

 function create_url($value)
	{    
	if($value!=""){
	$value= strtolower(trim($value));
	$string = str_replace('   ', '-', $value); 
	$string = str_replace('  ', '-', $string); 
	$string = str_replace(' ', '-', $string); 
	return preg_replace('/[^A-Za-z0-9\-]/', '', $string); 
	}
	return false;

	} 
	
	function get_url_title($url){
	$url = str_replace('.html','',$url);
	return $url;
	}






?>