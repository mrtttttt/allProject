<?php
class tree{
    public $str;
    public $ul;
    public $ulCon="";
    public function category($pid,$db,$table,$step,$flag,$currintCid){
        if($currintCid){
            $sql1="select * from ".$table." where cid=".$currintCid;
            $result1=$db->query($sql1);
            $result1->setFetchMode(PDO::FETCH_ASSOC);
            $row1=$result1->fetch();
            $cruuintPid=$row1["pid"];
        }
        $sql="select * from ".$table." where pid='{$pid}'";
        $step+=1;
        $type = str_repeat($flag,$step);
        $result=$db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        while ($row=$result->fetch()){
            $cid=$row["cid"];
            $cname=$row["cname"];
            if($cid==$cruuintPid){
                $this->str.="<option value='".$cid."' selected>".$type.$cname."</option>";
            }else{
                $this->str.="<option value='".$cid."'>".$type.$cname."</option>";
            }
            $this->category($cid,$db,$table,$step,$flag,$currintCid);
        }
    }
    public function showCate($pid,$db,$table,$tableCon){
        $sql="select * from ".$table." where pid='{$pid}'";
        $result=$db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        while ($row=$result->fetch()){
            $cid=$row["cid"];
            $cname=$row["cname"];


            $this->ul.="<ul>";
            $this->ul.="<li>".$cname."<a href='editCategory.php?cid={$cid}' class='btn btn-info'>编辑</a><a href='delCategory.php?cid={$cid}' class='btn btn-danger'>删除</a></li>";

            if($tableCon){
                $sql2="select * from ".$tableCon." where cid=".$cid;
                $result2=$db->query($sql2);
                $result2->setFetchMode(PDO::FETCH_ASSOC);
                    while($row2=$result2->fetch()){
//                        $this->ulCon="";
//                        if($row2["cid"]==$cid){
                            $sid=$row2["sid"];
                            $stitle=$row2["stitle"];
                            $this->ulCon="<div>";
                            $this->ulCon.="<div style='padding-left: 25px'>".$stitle."<a href='editCon.php?sid={$sid}' class='btn btn-info'>编辑</a><a href='delCon.php?sid={$sid}' class='btn btn-danger'>删除</a></div>";
                            $this->ulCon.="</div>";
                            $this->ul.=$this->ulCon;
                    }
            }
            $this->showCate($cid,$db,$table,$tableCon);
            $this->ul.="</ul>";
        }
    }
    public function con($pid,$db,$table,$tableCon,$step,$flag,$currintSid){
        if($currintSid){
            $sql1="select * from ".$tableCon." where sid=".$currintSid;
            $result1=$db->query($sql1);
            $result1->setFetchMode(PDO::FETCH_ASSOC);
            $row1=$result1->fetch();
            $cruuintCid=$row1["cid"];
        }
        $sql="select * from ".$table." where pid='{$pid}'";
        $step+=1;
        $type = str_repeat($flag,$step);
        $result=$db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        while ($row=$result->fetch()){
            $cid=$row["cid"];
            $cname=$row["cname"];
            if($cid==$cruuintCid){
                $this->str.="<option value='".$cid."' selected>".$type.$cname."</option>";
            }else{
                $this->str.="<option value='".$cid."'>".$type.$cname."</option>";
            }
            $this->con($cid,$db,$table,$tableCon,$step,$flag,$currintSid);
        }
    }

}