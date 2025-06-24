<?php
use app\assets\MapAsset;
use yii\helpers\Html;
use yii\helpers\Url;

// Создаем глобальную JS-переменную с базовым URL
$this->registerJs("const baseUrl = '" . Url::base(true) . "';", \yii\web\View::POS_HEAD);

MapAsset::register($this);

?>



<div class="map-container">


    <h2 id="current-year-display "></h2>

    <div id="map" style="width: 100%; height: 600px;"></div>


    <div class="map-controls">
        <button id="play-pause-button" aria-label="Play/Pause">
            <svg class="icon-play" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"></path></svg>
            <svg class="icon-pause" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"></path></svg>
        </button>
        <div id="timeline-slider"></div>
        <div id="current-date">22.06.1941 г</div>
    </div>
</div>

<div class="site-about">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h1 class="text-center mb-4"><?= Html::encode($this->title) ?></h1>

                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <p class="lead">
                            Проект "Победоносец" создан с целью сохранения памяти о событиях и героях войны 1941-1945 годов.
                        </p>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h2 class="mb-3">Наша цель</h2>
                        <p>
                            Мы стремимся собрать в одном месте достоверные исторические материалы, документы, фотографии и личные истории, связанные с Великой Отечественной войной, чтобы сделать их доступными для всех, кто интересуется историей своей страны.
                        </p>
                        <p>
                            Наша цель - создать крупнейший цифровой архив, который будет служить образовательным ресурсом для школьников, студентов, исследователей и всех, кто хочет узнать правду о событиях тех лет.
                        </p>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h2 class="mb-3">Как принять участие</h2>
                        <p>
                            Если у вас есть материалы, которые могут дополнить наш архив, вы можете написать статью, на страничке "Написать статью"
                        </p>
                        <div class="contact-info mt-4">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-envelope-fill fs-4 text-red me-3"></i>
                                <span><a href="https://kpk.kss45.ru/?ysclid=mcabblznnl258659127">kpk45.ru</a></span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-geo-alt-fill fs-4 text-red me-3"></i>
                                <span>г. Курган, ул. Карельцева, д 32</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="mb-3">Наша команда</h2>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-circle">ХВ</div>
                                    </div>
                                    <div>
                                        <h5 class="mb-1">Ханаев Владимир</h5>
                                        <p class="text-muted mb-0">Просто устал </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-circle">ТГ:</div>
                                    </div>
                                    <div>
                                        <h5 class="mb-1">V3chnost</h5>
                                        <p class="text-muted mb-0"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-circle">ГВ</div>
                                    </div>
                                    <div>
                                        <h5 class="mb-1">Гребнев Вячеслав</h5>
                                        <p class="text-muted mb-0">Да как это работает?</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-circle">ТГ:</div>
                                    </div>
                                    <div>
                                        <h5 class="mb-1">@Toterhomunkel</h5>
                                        <p class="text-muted mb-0">
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>