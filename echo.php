<?php
/**
 * Created by PhpStorm.
 * User: fengsen
 * Date: 16-8-11
 * Time: 上午9:29
 */
require_once ('./coupon/clSetCoupon.php');
require_once ('./function/testFn.php');

$data = array(
    'cp_ad_id' => '57a575bb190720c79514e852',
    'user_phone' => '18888888888'
);

$cl = new clSetCoupon($data);
print_r(getCpId($data['cp_ad_id']));
print_r(getUserId($data['user_phone']));
print_r($cl->userGetCoupon());