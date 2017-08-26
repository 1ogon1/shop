<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
	<div class="container">
		<div class="row">

			<br/>

			<div class="breadcrumbs">
				<ol class="breadcrumb">
					<li><a href="/admin">Админпанель</a></li>
					<li><a href="/admin/product">Управление товарами</a></li>
					<li class="active">Редактировать товар</li>
				</ol>
			</div>


			<h4>Редактировать товар #<?php echo $id; ?></h4>

			<br/>

			<div class="col-lg-4">
				<div class="login-form">
					<form action="#" method="post">

						<p>Название товара</p>
						<input type="text" name="name" placeholder="" value="<?php echo $product['name']; ?>">

						<p>Артикул</p>
						<input type="text" name="code" placeholder="" value="<?php echo $product['code']; ?>">

						<p>Стоимость: грн.</p>
						<input type="text" name="price" placeholder="" value="<?php echo $product['price']; ?>">

						<p>Категория</p>
						<select name="category_id">
							<?php if (is_array($categoriesList)): ?>
								<?php foreach ($categoriesList as $category): ?>
									<option value="<?php echo $category['id']; ?>"
										<?php if ($product['category_id'] == $category['id']) echo ' selected="selected"'; ?>>
										<?php echo $category['name']; ?>
									</option>
								<?php endforeach; ?>
							<?php endif; ?>
						</select>

						<br/><br/>

						<!--                        <p>Производитель</p>-->
						<!--                        <input type="text" name="brand" placeholder="" value="-->
						<?php //echo $product['brand']; ?><!--">-->

						<p>Детальное описание</p>
						<textarea id="text-area" name="description"><?php echo $product['description']; ?></textarea>

						<!--                        <br/><br/>-->
						<!---->
						<!--                        <p>Наличие на складе</p>-->
						<!--                        <select name="availability">-->
						<!--                            <option value="1" -->
						<?php //if ($product['availability'] == 1) echo ' selected="selected"'; ?><!-->
						<!--Да</option>-->
						<!--                            <option value="0" -->
						<?php //if ($product['availability'] == 0) echo ' selected="selected"'; ?><!-->
						<!--Нет</option>-->
						<!--                        </select>-->

						<br/><br/>

						<p>Новинка</p>
						<select name="is_new">
							<option value="1" <?php if ($product['is_new'] == 1) echo ' selected="selected"'; ?>>Да
							</option>
							<option value="0" <?php if ($product['is_new'] == 0) echo ' selected="selected"'; ?>>Нет
							</option>
						</select>

						<br/><br/>

						<p>Рекомендуемые</p>
						<select name="is_recommended">
							<option value="1" <?php if ($product['is_recommended'] == 1) echo ' selected="selected"'; ?>>
								Да
							</option>
							<option value="0" <?php if ($product['is_recommended'] == 0) echo ' selected="selected"'; ?>>
								Нет
							</option>
						</select>

						<br/><br/>

						<p>Статус</p>
						<select name="status">
							<option value="1" <?php if ($product['status'] == 1) echo ' selected="selected"'; ?>>
								Отображается
							</option>
							<option value="0" <?php if ($product['status'] == 0) echo ' selected="selected"'; ?>>Скрыт
							</option>
						</select>

						<br/><br/>

						<input type="submit" name="submit" class="btn btn-default" value="Сохранить">

						<br/><br/>

					</form>
				</div>
			</div>
			<div class="col-lg-8">
				<form method="post" action="#" enctype="multipart/form-data">
					<p>Изображение товара</p>

					<div style="display: inline-block">

						<?php $img = Product::getImage($id);

						foreach ($img as $row) : ?>

							<div style="display: inline-block">

								<?php if (strcmp($row['src'], "/upload/images/products/no-image.jpg")) : ?>

									<div class="adm-img" data-text="<?php echo $row['id'] ?>"
										 data-src="<?php echo $row['src'] ?>" data-id="<?php echo $row['id_product'] ?>"
										 style="width: 20px; height: 20px; background-image: url(/template/images/shop/close.gif); float: right; position: absolute;"></div>

								<?php endif; ?>

								<img src="<?php echo $row['src'] ?>" width="100" alt=""/>
							</div>

						<?php endforeach; ?>

					</div>

					<input type="file" name="image" placeholder="" accept="image/*">
					<br>
					<input type="submit" name="add_img" class="btn btn-default" value="Добавить">
				</form>
			</div>

		</div>
	</div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>
<script src="/template/js/image.js"></script>
