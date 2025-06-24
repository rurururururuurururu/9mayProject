# Проект "Вторая Мировая Война: Исторический Архив"

[![Yii2](https://img.shields.io/badge/Powered_by-Yii_Framework-green.svg?style=flat)](https://www.yiiframework.com/)

## Описание проекта
Веб-приложение для сохранения исторической памяти о Второй Мировой войне. Включает:
- Базу знаний о ключевых сражениях
- Истории ветеранов
- Интерактивные карты линий фронта
- Фотогалерею исторических материалов
- Систему комментирования и обсуждения

## Технические требования
- **PHP 7.4**
- **Apache 2.4**
- **MySQL 5.7+** (или MariaDB 10.3+)
- **Yii2 Basic Framework**

## Установка проекта

### 1. Клонирование репозитория
```bash
git clone https://github.com/ваш-логин/название-репозитория.git
cd название-репозитория
2. Установка зависимостей
bash
composer install
3. Настройка базы данных
Создайте БД MySQL:

sql
CREATE DATABASE ww2 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
Импортируйте дамп:

bash
mysql -u пользователь -p ww2 < ww2\ \(1\).sql
4. Конфигурация приложения
Создайте файл config/db.php со следующим содержимым:

php
<?php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=ww2',
    'username' => 'ваш_пользователь',
    'password' => 'ваш_пароль',
    'charset' => 'utf8mb4',
];
5. Настройка веб-сервера
Настройте виртуальный хост в Apache:

apache
<VirtualHost *:80>
    ServerName ww2.local
    DocumentRoot "C:/path/to/project/web"
    
    <Directory "C:/path/to/project/web">
        RewriteEngine on
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteRule . index.php
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
6. Права доступа
bash
chmod -R 777 runtime/
chmod -R 777 web/assets/
7. Доступ в админку
Логин: admin

Пароль: admin (рекомендуется сменить после установки)

Структура проекта
text
config/           - Конфигурационные файлы
controllers/      - Контроллеры
models/           - Модели
views/            - Представления
web/              - Веб-корень
    assets/       - Компилируемые ресурсы
    uploads/      - Загружаемые файлы (фото статей)
migrations/       - Миграции БД (если будут добавляться)
