<?php include ROOT . '/views/layouts/header.php'; ?>

	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Каталог</h2>
						<div class="panel-group category-products">
							<?php foreach ($categories as $categoryItem): ?>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a href="/category/<?php echo $categoryItem['id']; ?>">
												<?php echo $categoryItem['name']; ?>
											</a>
										</h4>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>

				<div class="col-sm-9 padding-right">
					<div class="features_items">
						<h2 class="title text-center">Корзина</h2>


						<?php if ($result): ?>
							<p>Заказ оформлен. Дополнительная информация придет на указанный Вами e-mail.</p>
						<?php else: ?>

							<p>Выбрано товаров: <?php echo $totalQuantity; ?>, на сумму: <?php echo $totalPrice; ?>
								грн.</p><br/>

							<?php if (!$result): ?>

								<div class="col-sm-6">
									<?php if (isset($errors) && is_array($errors)): ?>
										<ul>
											<?php foreach ($errors as $error): ?>
												<li> - <?php echo $error; ?></li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>

									<p>Для оформления заказа заполните форму. Наш менеджер свяжется с Вами.</p>

									<div class="login-form">
										<form action="#" method="post">

											<p>Ваше имя <span style="color: red">*</span></p>
											<input type="text" name="userName" placeholder="Имя" value="<?php echo $userName; ?>" required/>

											<p>Номер телефона <span style="color: red">*</span></p>
											<input type="text" name="userPhone" placeholder="Телефон" value="<?php echo $userPhone; ?>" required/>

											<p>Ваш e-mail <span style="color: red">*</span></p>
											<input type="email" name="userEmail" placeholder="E-mail" value="" required/>

											<p>Размер <span style="color: red">*</span></p>
											<textarea class="size textarea" name="userSize" placeholder="Укажите размеры, которые вам необходимы" rows="4" required></textarea>

											<p>Комментарий к заказу</p>
											<textarea class="my_textarea textarea" name="userComment" placeholder="Сообщение" rows="4"></textarea>

											<p><span style="color: red">*</span> - поля обязательные для заполнения</p>
											<br/>
											<br/>
											<input type="submit" name="submit" class="btn btn-default" value="Оформить"/>
										</form>
									</div>
								</div>

							<?php endif; ?>

						<?php endif; ?>

					</div>

				</div>
			</div>
		</div>
	</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>