<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gallery".
 *
 * @property int $id
 * @property string|null $path
 * @property string|null $alt
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 */
class Gallery extends \yii\db\ActiveRecord
{
    public $uploadedFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['path', 'alt', 'created_at', 'updated_at', 'deleted_at'], 'default', 'value' => null],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['uploadedFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['path', 'alt'], 'string', 'max' => 255],
        ];
    }

    public function upload(): bool
    {
        if ($this->uploadedFile === null) {
            return true;
        }

        if ($this->validate()) {
            if (is_dir(Yii::getAlias('@uploads/')) === false) {
                mkdir(Yii::getAlias('@uploads/'), 0777, true);
            }
            $time = time();

            $fileName = Yii::getAlias('@uploads/') . 'gallery_' . $this->uploadedFile->baseName . '_' . $time . '.' . $this->uploadedFile->extension;

            $this->uploadedFile->saveAs($fileName);

            if ($this->path && $this->path !== $fileName) {
                unlink($this->path);
            }

            $this->path = $fileName;

            return true;
        } else {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'path' => 'Path',
            'alt' => 'Alt',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }

}
