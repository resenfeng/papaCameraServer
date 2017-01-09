<?php
/**
 * Created by PhpStorm.
 * User: fengsen
 * Date: 16-8-11
 * Time: 上午10:13
 */

/**
 * 通过user_phone获取user_id
 */
function getUserId($user_phone){
    $backVal = null;
    $userPhone = $user_phone;
    $getText = "user_id";
    $table = "user_info";
    $where = "user_phone = $userPhone";
    $query = new clSqlOperation($getText,$table,$where,null);
    $result = $query->fnGetOne();
    if($result)
        $backVal = $result;
    else
        $backVal = "";
    return $backVal['user_id'];
}

/**
 * 通过cp_ad_id得到cp_id,cp_endtime
 */
function getCpId($cp_ad_id){
    $backVal = null;
    $cpAdId = $cp_ad_id;
    $getText = "cp_id";
    $table = "coupon_info";
    $where = "cp_ad_id = \"".$cpAdId."\"";
    $query = new clSqlOperation($getText,$table,$where,null);
    $result = $query->fnGetOne();
    if($result){
        $backVal = $result;
    }
    else{
        $backVal = "";
    }
//       return $this->backVal;
    return $backVal['cp_id'];
}