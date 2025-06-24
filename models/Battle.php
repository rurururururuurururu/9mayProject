<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "battle".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $result
 * @property string $start_date
 * @property string $end_date
 * @property float $latitude
 * @property float $longitude
 * @property string $slug
 */
class Battle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'battle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'result', 'start_date', 'end_date', 'latitude', 'longitude', 'slug'], 'required'],
            [['description'], 'string'],
            [['start_date', 'end_date'], 'safe'],
            [['latitude', 'longitude'], 'number'],
            [['name', 'result', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'result' => 'Result',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'slug' => 'Slug',
        ];
    }
}
