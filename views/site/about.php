<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'О проекте';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h1 class="text-center mb-4"><?= Html::encode($this->title) ?></h1>

                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <p class="lead">
                            Проект "Исторический архив Великой Отечественной войны" создан с целью сохранения памяти о событиях и героях войны 1941-1945 годов.
                        </p>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h2 class="mb-3">Наша миссия</h2>
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
                        <h2 class="mb-3">Наши принципы</h2>
                        <ul>
                            <li><strong>Достоверность</strong> - все материалы проходят проверку на соответствие историческим фактам</li>
                            <li><strong>Уважение</strong> - мы с глубоким уважением относимся к памяти каждого участника войны</li>
                            <li><strong>Открытость</strong> - любой желающий может внести свой вклад в развитие архива</li>
                            <li><strong>Сохранение памяти</strong> - мы верим, что сохранение исторической памяти является важнейшей задачей современного общества</li>
                        </ul>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h2 class="mb-3">Как принять участие</h2>
                        <p>
                            Если у вас есть материалы, которые могут дополнить наш архив (фотографии, документы, письма, воспоминания), мы с благодарностью примем вашу помощь. Пожалуйста, свяжитесь с нами через форму обратной связи или по электронной почте.
                        </p>
                        <div class="contact-info mt-4">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-envelope-fill fs-4 text-red me-3"></i>
                                <span>info@voina-history.ru</span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-telephone-fill fs-4 text-red me-3"></i>
                                <span>+7 495 123-45-67</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-geo-alt-fill fs-4 text-red me-3"></i>
                                <span>Москва, ул. Историческая, д. 45</span>
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