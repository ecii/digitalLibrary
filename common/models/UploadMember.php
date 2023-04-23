<?php
namespace common\models; //tempat dia disimpan dimana 
use yii\base\Model;

class Uploadprofile extends Model{
    public $profile;//pengganti field
    public function rules()
    {
        return[
            //profile diisi dengan tipe file,dilewatkan kalau kosong tidak boleh, dengan 
            [['profile'],'file','skipOnEmpty'=>false,'extensions'=>'jpg,jpeg,png','maxSize'=>1024 * 1024 * 2]
        ];
        // 2 MByte
    }

    public function upload($id){
        if($this->validate()){
            $filename = $id.".".$this->profile->extension;
            $this->profile->saveAs('img/profile/'.$filename); 
            // memindahkan data dari komputer ke folder image cover dan mengubah nama foto sesuai id dan extention

            $mprofile = new profile();
            $mprofile->updateAll(['foto'=>$filename],['id_profile'=>$id]);
            return true;
        }else{
            return false;
        }
    }
}
?>