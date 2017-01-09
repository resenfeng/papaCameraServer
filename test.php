<?php
/**
 * Project Name: AppServer
 * User: fengsen
 * Date: 16-7-18
 * Time: 下午2:28
 * Explain:
 */


require_once ('include.php');
//require_once ('function/clMongoOperation.php');

$test=new clMongoOperation("advert_info",null,null);
$result = $test->fnGetOne();
print_r($result);

//Insert
//$data=array("ad_name"=>"cola","ad_type_id"=>1);
//$cond=array("ad_type_id"=>1);
//$test = new clMongoOperation("advert_info",null,$data);
//$result = $test->fnInsert();
//echo $result;

//findOne
//$data=array("name","type");
//$cond=array("name"=>"大鱼海棠");
//$test = new clMongoOperation("advert_info",$cond,$data);
//$result = $test->fnGetOne();
//echo json_encode($result);


//findAll

//$test=new clMongoOperation("advert_info",null,null);
////$test = new clMongoOperation("advert_info",$cond,$data);
//$result = $test->fnGetAll();
//echo json_encode($result);
//update
//$data=array("ad_name"=>"可口可乐");
//$cond=array("ad_name"=>"cola");
//$test=new clMongoOperation("advert_info",$cond,$data);
//
//$result=$test->fnUpdate();
//echo $result;


//delete
//$cond=array("ad_name"=>"可口可乐");
//$test = new clMongoOperation("advert_info",$cond,null,null);
//$result = $test->fnDelete();
//echo $result;



//$test = new clDoCoupon($data);
//$result=$test->fnGetCp();
//print_r($result);

//$text="user_id";
//$table="user_info";
//$cond="user_phone='17751781352'";
//$query=new clSqlOperation($text,$table,$cond,null);
//$result=$query->fnGetOne();
//print_r($result);

//$data=array("user_phone"=>13934567890,"cp_id"=>1);
//$test=new clSetCoupon($data);
//$result=$test->fnUseCoupon();
//echo $result;