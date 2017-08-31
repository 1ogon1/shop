<?php

/**
 * Контроллер CartController
 * Корзина
 */
class CartController
{

    /**
     * Action для добавления товара в корзину синхронным запросом<br/>
     * (для примера, не используется)
     * @param integer $id <p>id товара</p>
     */
    public function actionAdd($id)
    {
        // Добавляем товар в корзину
        Cart::addProduct($id);

        // Возвращаем пользователя на страницу с которой он пришел
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
    }

    /**
     * Action для добавления товара в корзину при помощи асинхронного запроса (ajax)
     * @param integer $id <p>id товара</p>
     */
    public function actionAddAjax($id)
    {
        // Добавляем товар в корзину и печатаем результат: количество товаров в корзине
        echo Cart::addProduct($id);
        return true;
    }

    /**
     * Action для добавления товара в корзину синхронным запросом
     * @param integer $id <p>id товара</p>
     */
    public function actionDelete($id)
    {
        // Удаляем заданный товар из корзины
        Cart::deleteProduct($id);

        // Возвращаем пользователя в корзину
        header("Location: /cart");
    }

    /**
     * Action для страницы "Корзина"
     */
    public function actionIndex()
    {
		//Добавляем title
		$title = 'Корзина';

        // Список категорий для левого меню
        $categories = Category::getCategoriesList();

        // Получим идентификаторы и количество товаров в корзине
        $productsInCart = Cart::getProducts();

        if ($productsInCart) {
            // Если в корзине есть товары, получаем полную информацию о товарах для списка
            // Получаем массив только с идентификаторами товаров
            $productsIds = array_keys($productsInCart);

            // Получаем массив с полной информацией о необходимых товарах
            $products = Product::getProdustsByIds($productsIds);

            // Получаем общую стоимость товаров
            $totalPrice = Cart::getTotalPrice($products);
        }

        // Подключаем вид
        require_once(ROOT . '/views/cart/index.php');
        return true;
    }

    /**
     * Action для страницы "Оформление покупки"
     */
    public function actionCheckout()
    {
		//Добавляем title
		$title = 'Заказать';

        // Получием данные из корзины
        $productsInCart = Cart::getProducts();

        // Если товаров нет, отправляем пользователи искать товары на главную
        if ($productsInCart == false) {
            header("Location: /");
        }

        // Список категорий для левого меню
        $categories = Category::getCategoriesList();

        // Находим общую стоимость
        $productsIds = array_keys($productsInCart);
        $products = Product::getProdustsByIds($productsIds);
        $totalPrice = Cart::getTotalPrice($products);

        // Количество товаров
        $totalQuantity = Cart::countItems();

        // Поля для формы
        $userName = false;
        $userPhone = false;
        $userComment = false;

        // Статус успешного оформления заказа
        $result = false;

        // Проверяем является ли пользователь гостем
        if (!User::isGuest()) {
            // Если пользователь не гость
            // Получаем информацию о пользователе из БД
            $userId = User::checkLogged();
            $user = User::getUserById($userId);
            $userName = $user['name'];
        } else {
            // Если гость, поля формы останутся пустыми
            $userId = false;
        }

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $userName = htmlspecialchars($_POST['userName']);
            $userPhone = htmlspecialchars($_POST['userPhone']);
            $userEmail = htmlspecialchars($_POST['userEmail']);
            $userSize = htmlspecialchars($_POST['userSize']);
            $userComment = htmlspecialchars($_POST['userComment']);

//            echo $userName;
//			echo $userPhone;
//			echo $userComment;

            // Флаг ошибок
            $errors = false;

            // Валидация полей
            if (!User::checkName($userName)) {
                $errors[] = 'Неправильное имя';
            }
            if (!User::checkPhone($userPhone)) {
                $errors[] = 'Неправильный телефон';
            }
            if (!User::checkEmail($userEmail)) {
                $errors[] = 'Неправильный e-mail';
            }


            if ($errors == false) {
                // Если ошибок нет
                // Сохраняем заказ в базе данных
                $result = Order::save($userName, $userPhone, $userEmail, $userSize, $userComment, $userId, $productsInCart);

                if ($result) {
                    // Если заказ успешно сохранен
                    // Оповещаем администратора о новом заказе по почте
                    $adminEmail = 'larisamyshop@gmail.com';
                    $headers = "Content-Type: text/html; charset=utf-8" . "\r\n";
                    $r1 = '<h1>На сайте новый заказ!</h1>';
                    $r2 = '<p>Перейти к просмотру  заказов можно по ссыдке ниже</p>';
                    $r3 = '<a href="https://solo-shop.000webhostapp.com/admin/order">Перейти</a>';
                    $message = $r1 . $r2 . $r3;
                    $subject = 'Новый заказ!';
                    mail($adminEmail, $subject, $message, $headers);

                    // Очищаем корзину
                    Cart::clear();
                }
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/cart/checkout.php');
        return true;
    }

}