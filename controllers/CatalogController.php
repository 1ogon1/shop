<?php

/**
 * Контроллер CatalogController
 * Каталог товаров
 */
class CatalogController
{

    /**
     * Action для страницы "Каталог товаров"
     */
    public function actionIndex($page = 1)
    {
		//Добавляем title
		$title = 'Каталог товаров';

        // Список категорий для левого меню
        $categories = Category::getCategoriesList();

        // Список последних товаров
        $latestProducts = Product::getLatestProducts($page);

        // Общее количетсво товаров (необходимо для постраничной навигации)
        $total = Product::getTotalProducts();

        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, 9, 'page-');

        // Подключаем вид
        require_once(ROOT . '/views/catalog/index.php');
        return true;
    }

    /**
     * Action для страницы "Категория товаров"
     */
    public function actionCategory($categoryId, $page = 1)
    {
		//Добавляем title
		$title = Category::getCategoryNameById($categoryId);

        // Список категорий для левого меню
        $categories = Category::getCategoriesList();

        // Список товаров в категории
        $categoryProducts = Product::getProductsListByCategory($categoryId, $page);

        // Общее количетсво товаров (необходимо для постраничной навигации)
        $total = Product::getTotalProductsInCategory($categoryId);

        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

        // Подключаем вид
        require_once(ROOT . '/views/catalog/category.php');
        return true;
    }

}
