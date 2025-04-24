<?php
/**
 * Скрипт для запуска сервера разработки Yii2
 */

// Установка текущей директории
chdir(__DIR__);

// Запуск веб-сервера PHP
echo "Starting Yii2 Sum Even API on http://0.0.0.0:5000\n";
echo "Press Ctrl+C to stop the server\n";

system('php -S 0.0.0.0:5001 -t web');
