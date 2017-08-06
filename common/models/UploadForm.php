<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * This is the model class for table "account_group".
 *
 * @property integer $filename
 */
class UploadForm extends Model {
    
    const SCENARIO_IMPORT_EXCEL = 'import-excel';
    const SCENARIO_IMPORT_SQL = 'import-sql';
    
    public $filename;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['filename'], 'file', 'skipOnEmpty' => false, 'extensions' => 'txt, sql', 'on' => self::SCENARIO_IMPORT_SQL],
            [['filename'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xls, xlsx, ods', 'on' => self::SCENARIO_IMPORT_EXCEL],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_IMPORT_EXCEL] = ['filename'];
        $scenarios[self::SCENARIO_IMPORT_SQL] = ['filename'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'filename' => Yii::t('app', 'Backup file'),
        ];
    }

    public function upload($folder = 'upload', $filename = 'filename') {
        $this->filename = \yii\web\UploadedFile::getInstance($this, $filename);
        if ($this->validate()) {
            //if (file_exists($folder . '/filename.' . $this->filename->extension)) {
            //    chown ($folder . '/filename.' . $this->filename->extension, '0777');
            //    unlink ($folder . '/filename.' . $this->filename->extension);
            //}
            $this->filename->saveAs($folder . '/filename.' . $this->filename->extension, true);
            //$this->filename->saveAs('uploads/' . $this->filename->baseName . '.' . $this->filename->extension);
            //$this->filename->saveAs('uploads/filename.sql');
            return true;
        } else {
            return false;
        }
    }

}
