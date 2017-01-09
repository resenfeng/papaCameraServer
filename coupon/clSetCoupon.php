<?php
/**
 * Created by PhpStorm.
 * User: fengsen
 * Date: 16-7-22
 * Time: 下午2:31
 */
require_once ("./function/clSqlOperation.php");
class clSetCoupon
{
    private  $backVal;
    private  $userPhone;
    private  $cpId;
    private  $userId;
    function __construct($data = array())
    {
        $this->userPhone = $data['user_phone'];
        $this->cpId = $data['cp_id'];
        $this->userId = $this->fnGetUserId();
    }

    /**
     * 判断能否领取优惠券
     * @return bool
     */
    private  function isGet($cpId)
    {
        $isGet = false;
        $query  = new clSqlOperation("cp_pub_time","coupon_info","cp_id=$cpId and cp_pub_time>=now()",null);
        $result = $query->fnGetOne();
        if($result != null)
            $isGet = true;

        return $isGet;
    }

    /**
     * 判断能否使用优惠券
     * @param $cpId
     * @return bool
     */
    private function isUse($cpId)
    {
        $isUse = false;
        $query  = new clSqlOperation("cp_endtime","coupon_info","cp_id=$cpId and cp_endtime>=now() ",null);
        $result = $query->fnGetOne();
        if($result != null)
            $isUse = true;

        return $isUse;
    }
    /**
     * 用户获得优惠券
     * @return null|string
     */
    function fnInsertCoupon()
    {

        if($this->userId == null)
            return ($this->backVal = "插入失败，无法获取用户信息") ;

        if($this->cpId == null)
            return($this->backVal = "插入失败，优惠券不正确") ;
        $query = new clSqlOperation("user_cp_id","user_coupon","not(user_cp_state_id in (0,2,4)
         )and user_id=$this->userId and 
        user_coupon.cp_id=$this->cpId",null);
        $result = $query->fnGetOne();
        if(empty($result))
        {
            if($this->isGet($this->cpId)){

                $table="user_coupon";
                $text=array("user_id"=>$this->userId,"cp_id"=>$this->cpId,"user_cp_state_id"=>3);
                $query = new clSqlOperation($text,$table,null,null);
                $result=$query->fnInsert();
                if($result)
                    $this->backVal = "插入成功";
                else
                    $this->backVal = "插入失败";
            }else{
                $this->backVal = "超过领取期限或不存在";
            }
        }else {
            $this->backVal = "用户已经拥有该优惠券";
        }
        return $this->backVal;
    }

    /**
     * 获得用户id
     * @return mixed
     */
      function fnGetUserId()
      {
          $text="user_id";
          $table="user_info";
          $cond="user_phone='$this->userPhone'";
          $query=new clSqlOperation($text,$table,$cond,null);
          $result=$query->fnGetOne();
          return $result["user_id"];

      }

    /**
     * 用户使用优惠券
     * @return null|string
     */
    function fnUseCoupon()
    {
        if($this->isUse($this->cpId))
        {
            $text = "user_cp_id";
            $table = "user_coupon";
            $cond = "user_cp_state_id in (3,7) and user_id = $this->userId and cp_id = $this->cpId ";
            $query = new clSqlOperation($text,$table,$cond,null);
            $result = $query->fnGetOne();
            if(empty($result))
            {
                $this->backVal = "无法使用优惠券";

            }
            else{
                $text = array("user_cp_state_id"=>5);
                $table = "user_coupon";
                $cond = "user_id = $this->userId and cp_id = $this->cpId ";
                $query = new clSqlOperation($text,$table,$cond,null);
                $result = $query->fnUpdate();
                if($result)
                    $this->backVal = "成功使用优惠券";
                else
                    $this->backVal = "使用优惠券失败";
            }
        }
        else
        {
            $this->backVal = "优惠券过期或不存在";
        }
        return $this->backVal;
    }
}