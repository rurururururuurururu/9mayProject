<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "frontline".
 *
 * @property int $id
 * @property string $event_date
 * @property string $ussr_territory_coords
 * @property string $axis_territory_coords
 */
class Frontline extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'frontline';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_date', 'ussr_territory_coords', 'axis_territory_coords'], 'required'],
            [['event_date', 'ussr_territory_coords', 'axis_territory_coords'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_date' => 'Event Date',
            'ussr_territory_coords' => 'Ussr Territory Coords',
            'axis_territory_coords' => 'Axis Territory Coords',
        ];
    }
}
