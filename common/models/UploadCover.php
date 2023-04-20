<?php
namespace common\models; //tempat dia disimpan dimana 
use yii\base\Model;

class UploadCover extends Model{
    public $cover;//pengganti field
    public function rules()
    {
        return[
            //cover diisi dengan tipe file,dilewatkan kalau kosong tidak boleh, dengan 
            [['cover'],'file','skipOnEmpty'=>false,'extensions'=>'jpg,jpeg,png','maxSize'=>1024 * 1024 * 2]
        ];
        // 2 MByte
    }

    public function upload($id){
        if($this->validate()){
            $filename = $id.".".$this->cover->extension;
            $this->cover->saveAs('img/cover/'.$filename);
            return true;
        }else{
            return false;
        }
    }
}
?>