<?php

/**
 * Контроллер AdminProductController
 * Управление товарами в админпанели
 */
class AdminProductController extends AdminBase
{

	/**
	 * Action для страницы "Управление товарами"
	 */
	public function actionIndex()
	{
		// Проверка доступа
		self::checkAdmin();

		// Получаем список товаров
		$productsList = Product::getProductsList();

		// Подключаем вид
		require_once(ROOT . '/views/admin_product/index.php');
		return true;
	}

	/**
	 * Action для страницы "Добавить товар"
	 */
	public function actionCreate()
	{
		// Проверка доступа
		self::checkAdmin();

		// Получаем список категорий для выпадающего списка
		$categoriesList = Category::getCategoriesListAdmin();

		// Обработка формы
		if (isset($_POST['submit'])) {
			// Если форма отправлена
			// Получаем данные из формы
			$options['name'] = $_POST['name'];
			$options['code'] = $_POST['code'];
			$options['price'] = $_POST['price'];
			$options['category_id'] = $_POST['category_id'];
//            $options['brand'] = $_POST['brand'];
//            $options['availability'] = $_POST['availability'];
			$options['description'] = $_POST['description'];
			$options['is_new'] = $_POST['is_new'];
			$options['is_recommended'] = $_POST['is_recommended'];
			$options['status'] = $_POST['status'];

			// Флаг ошибок в форме
			$errors = false;

			// При необходимости можно валидировать значения нужным образом
			if (!isset($options['name']) || empty($options['name'])) {
				$errors[] = 'Заполните поля';
			}

			if ($errors == false) {
				// Если ошибок нет
				// Добавляем новый товар
				$id = Product::createProduct($options);

				// Если запись добавлена
//                if ($id) {
				// Проверим, загружалось ли через форму изображение
//                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
				// Если загружалось, переместим его в нужную папку, дадим новое имя
//                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
//                    }
//                };

				// Перенаправляем пользователя на страницу управлениями товарами
				header("Location: /admin/product");
			}
		} //добавление товара без фото

		// Подключаем вид
		require_once(ROOT . '/views/admin_product/create.php');
		return true;
	}

	/**
	 * Action для страницы "Редактировать товар"
	 */
	public function actionUpdate($id)
	{
		// Проверка доступа
		self::checkAdmin();

		// Получаем список категорий для выпадающего списка
		$categoriesList = Category::getCategoriesListAdmin();

		// Получаем данные о конкретном заказе
		$product = Product::getProductById($id);

		// Обработка формы
		if (isset($_POST['submit'])) {
			// Если форма отправлена
			// Получаем данные из формы редактирования. При необходимости можно валидировать значения
			$options['name'] = $_POST['name'];
			$options['code'] = $_POST['code'];
			$options['price'] = $_POST['price'];
			$options['category_id'] = $_POST['category_id'];
//            $options['brand'] = $_POST['brand'];
//            $options['availability'] = $_POST['availability'];
			$options['description'] = $_POST['description'];
			$options['is_new'] = $_POST['is_new'];
			$options['is_recommended'] = $_POST['is_recommended'];
			$options['status'] = $_POST['status'];

			// Сохраняем изменения
			if (Product::updateProductById($id, $options)) {


				// Если запись сохранена
				// Проверим, загружалось ли через форму изображение
//                if (is_uploaded_file($_FILES["image"]["tmp_name"])) {

				// Если загружалось, переместим его в нужную папке, дадим новое имя
//                    move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
//                }
			}

			// Перенаправляем пользователя на страницу управлениями товарами
			header("Location: /admin/product");
		} //изменение товара

		if (isset($_POST['add_img'])) {
			$dir = '/upload/images/products/';
			$file = $dir . basename($_FILES['image']['name']);
			$dir2 = ROOT . '/upload/images/products/';
			$file2 = $dir2 . basename($_FILES['image']['name']);
			if ((($_FILES['image']['type'] == "image/png") ||
				($_FILES['image']['type'] == "image/jpg") ||
				($_FILES['image']['type'] == "image/jpeg"))
			) {
				if (copy($_FILES['image']['tmp_name'], $file2)) {
//                    Profile::saveUserPhoto($_FILES['file']['name'], $file);
					Product::addImage($file, $id);
					header("Location: /admin/product/update/" . $id);
				}
			} else {
				echo 'error file';
			}
		} //добавляем фото к товару

		// Подключаем вид
		require_once(ROOT . '/views/admin_product/update.php');
		return true;
	}

	/**
	 * Action для страницы "Удалить товар"
	 */
	public function actionDelete($id)
	{
		// Проверка доступа
		self::checkAdmin();

		// Обработка формы
		if (isset($_POST['submit'])) {
			// Если форма отправлена
			// Удаляем товар
			Product::deleteProductById($id);

			// Перенаправляем пользователя на страницу управлениями товарами
			header("Location: /admin/product");
		}

		// Подключаем вид
		require_once(ROOT . '/views/admin_product/delete.php');
		return true;
	}

	public function actionAdmDelImg()
	{
		$pdo = Db::getConnection();

		$sql = "DELETE FROM image WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
		$stmt->execute();
		if ($stmt->rowCount()) {
			unlink(ROOT . $_POST['src']);
			echo 'ok';
			exit;
		}
//		echo $_POST['id'];
//		exit;
	}

}
