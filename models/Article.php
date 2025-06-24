<?php

namespace app\models;

use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string|null $created_at
 *
 * @property Comment[] $comments
 */
class Article extends \yii\db\ActiveRecord
{

    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
            [['title'], 'string', 'max' => 255],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок статьи',
            'content' => 'Содержание',
            'status' => 'Статус публикации',
            'category_id' => 'Категория',
            'imageFile' => 'Изображение статьи',
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['article_id' => 'id']);
    }

    public function upload()
    {
        $image = $this->imageFile;

        if ($image) {
            $uploadPath = Yii::getAlias('@webroot/uploads/articles/');
            FileHelper::createDirectory($uploadPath);

            $filename = 'article_' . time() . '.' . $image->extension;
            $filePath = $uploadPath . $filename;

            if ($image->saveAs($filePath)) {
                $this->image = $filename;
                return true;
            }
        }
        return false;
    }

    public function getImagePath()
    {
        return Yii::getAlias('@web/uploads/articles/') . $this->image;
    }

    public function saveImage()
    {
        $image = UploadedFile::getInstance($this, 'imageFile');

        if ($image) {
            $uploadPath = Yii::getAlias('@webroot/uploads/articles/');

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            if (!is_writable($uploadPath)) {
                Yii::error("Папка недоступна для записи: $uploadPath");
                return false;
            }

            $filename = 'article_' . $this->id . '_' . time() . '.' . $image->extension;
            $filePath = $uploadPath . $filename;

            if ($image->saveAs($filePath)) {
                if (file_exists($filePath)) {
                    $this->image = $filename;
                    return $this->updateAttributes(['image']);
                } else {
                    Yii::error("Файл не создан: $filePath");
                }
            } else {
                Yii::error("Ошибка saveAs для: " . $image->name);
            }
        } else {
            Yii::info("Файл не загружен или не выбран");
        }
        return false;
    }
}
