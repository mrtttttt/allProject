<?php
class upload{
    public $size;
    private $data;
    public $filename="file";
    public $type=";image/png;image/jpeg;image/gif;image/jpg";
    public $rootDir="root";
    private $fullPath;
    function __construct (){
        $this->size=1024*1024*10;
    }
    private function accept(){
        $this->data=$_FILES[$this->filename];
    }
    private function check(){
        if($this->data["size"]<$this->size && strrpos($this->type,$this->data["type"])){
            return true;
        }else{
            return false;
        }
    }
    private function createDir(){
        if(is_uploaded_file($this->data["tmp_name"])){
            if(!is_dir($this->rootDir)){
                mkdir($this->rootDir);
            }
            $date=date("y-m-d");
            if(!is_dir($this->rootDir."/".$date)){
                mkdir($this->rootDir."/".$date);
            }
            $name=time().mt_rand(0,10000).$this->data["name"];
            $name=iconv("utf-8","gb2312",$name);
            $this->fullPath=$this->rootDir."/".$date."/".$name;
        }
    }
    private function fileMove(){
        move_uploaded_file($this->data["tmp_name"],$this->fullPath);
    }
    public function move(){
        //接收文件
        $this->accept();
        //检查文件
        if($this->check()){
            //创建目录
            $this->createDir();
            $this->fileMove();
            echo $this->fullPath;
        }else{
            echo "error";
        }
    }
}
