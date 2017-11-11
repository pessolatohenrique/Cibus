<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use app\components\ImageHelper;

class UploadUser extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $complete_name;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $image_name = ImageHelper::generateName($this->imageFile->baseName);
            $this->imageFile->saveAs('uploads/' . $image_name . '.' . $this->imageFile->extension);
            $this->complete_name = 'uploads/' . $image_name . '.' . $this->imageFile->extension;
            return true;
        } else {
            return false;
        }
    }

    public function sendUpload()
    {
        $this->imageFile = UploadedFile::getInstance($this, 'imageFile');
        if ($this->upload()) {
            return $this->complete_name;
        }
    }
}