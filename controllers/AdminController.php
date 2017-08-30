<?php

/**
 * Контроллер AdminController
 * Главная страница в админпанели
 */
class AdminController extends AdminBase
{
    /**
     * Action для стартовой страницы "Панель администратора"
     */
    public function actionIndex()
    {
    	//Добавляем title
		$title = 'Админпанель';

        // Проверка доступа
        self::checkAdmin();

        $name = User::getUserNameById($_SESSION['user']);

        // Подключаем вид
        require_once(ROOT . '/views/admin/index.php');
        return true;
    }

}
