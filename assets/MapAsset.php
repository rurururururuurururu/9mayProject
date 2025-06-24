<?php

namespace app\assets;

use yii\web\AssetBundle;

class MapAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [

        'https://unpkg.com/leaflet@1.8.0/dist/leaflet.css',

        'https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.0/nouislider.min.css',

        'css/map.css',
    ];

    public $js = [

        'https://unpkg.com/leaflet@1.8.0/dist/leaflet.js',

        'https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.0/nouislider.min.js',

        'js/map.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}