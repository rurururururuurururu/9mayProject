<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\Battle;
use app\models\Frontline;

class MapController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Отдает все данные для карты в формате JSON.
     */
    public function actionGetData()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;


        $battles = Battle::find()->asArray()->all();


        $frontlines = Frontline::find()->orderBy(['event_date' => SORT_ASC])->asArray()->all();

        // Декодируем JSON-строки в PHP-массивы перед отправкой
        foreach ($frontlines as &$frontline) {
            $frontline['ussr_territory_coords'] = json_decode($frontline['ussr_territory_coords']);
            $frontline['axis_territory_coords'] = json_decode($frontline['axis_territory_coords']);
        }

        return [
            'battles' => $battles,
            'frontlines' => $frontlines,
        ];
    }
}