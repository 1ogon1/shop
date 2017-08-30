<?php

class AdminProfileController extends AdminBase
{
	/**
	 * Action для страницы "Изменить пароль"
	 */

	public function actionIndex()
	{
		//Добавляем title
		$title = 'Изменить пароль';

		// Проверка доступа
		self::checkAdmin();

		if (isset($_POST['submit'])) {
			if (!strcmp($_POST['passwd'], $_POST['conf_passwd'])) {

				$hash_pw = password_hash($_POST['passwd'], PASSWORD_DEFAULT);

				$res = User::changePassword($hash_pw);
				if ($res) {
					echo 'Пароль изменен';
				} else {
					echo 'Произошла ошибка';
				}
			} else {
				echo 'error';
			}
		}

		require_once ROOT.'/views/admin_profile/index.php';
		return true;
	}
}