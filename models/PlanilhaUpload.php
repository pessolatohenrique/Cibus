<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use app\components\ImageHelper;

class PlanilhaUpload extends Model
{
    /**
     * @var UploadedFile
     */
    public $sheetFile;
    public $complete_name;

    public function rules()
    {
        return [
            [['sheetFile'], 'file', 'skipOnEmpty' => false],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $image_name = ImageHelper::generateName($this->sheetFile->baseName);
            $this->sheetFile->saveAs('planilhas/' . $image_name . '.' . $this->sheetFile->extension);
            $this->complete_name = 'planilhas/' . $image_name . '.' . $this->sheetFile->extension;
            return true;
        } else {
            return false;
        }
    }
}