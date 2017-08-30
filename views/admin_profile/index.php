<?php include ROOT . '/views/layouts/header_admin.php'; ?>

	<section>
		<div class="container">
			<div class="row">

				<br/>

				<div class="breadcrumbs">
					<ol class="breadcrumb">
						<li><a href="/admin">Админпанель</a></li>
						<li class="active">Профайл</li>
					</ol>
				</div>

				<div class="col-lg-4">
					<div class="login-form">
						<form action="#" method="post">

							<p>Новий пароль</p>
							<input type="password" name="passwd" placeholder="" value="">

							<p>Повторите пароль</p>
							<input type="password" name="conf_passwd" placeholder="" value="">

							<br/><br/>

							<input type="submit" name="submit" class="btn btn-default" value="Сохранить">

							<br/><br/>

						</form>
					</div>
				</div>

			</div>
		</div>
	</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>