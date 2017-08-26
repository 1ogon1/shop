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
				<div class="product-details"><!--product-details-->
					<div class="row">
						<div class="col-sm-5">
							<div class="view-product">

								<div class="full-img">

									<?php $res = Product::getOneImage($product['id']); ?>

									<?php foreach ($res as $row) : ?>

										<img id="big-img" src="<?php echo $row['src']; ?>" alt=""/>

									<?php endforeach; ?>

								</div>

								<div style="display: inline-block">

									<?php $res = Product::getImage($product['id']); ?>

									<?php foreach ($res as $row) : ?>
										<div class="all-img">

											<img src="<?php echo $row['src']; ?>" alt="" width="50px" height="50px"/>

										</div>
									<?php endforeach; ?>
								</div>

							</div>
						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->

								<?php if ($product['is_new']): ?>
									<img src="/template/images/product-details/new.jpg" class="newarrival" alt=""/>
								<?php endif; ?>

								<h2><?php echo $product['name']; ?></h2>
								<p>Код товара: <?php echo $product['code']; ?></p>
								<span>
                                    <span><?php echo $product['price']; ?> грн.</span>
                                    <a href="#" data-id="<?php echo $product['id']; ?>"
									   class="btn btn-default add-to-cart">
                                        <i class="fa fa-shopping-cart"></i>В корзину
                                    </a>
                                </span>
								<!--                                <p><b>Наличие:</b> -->
								<?php //echo Product::getAvailabilityText($product['availability']); ?><!--</p>-->
								<!--                                <p><b>Производитель:</b> -->
								<?php //echo $product['brand']; ?><!--</p>-->
							</div><!--/product-information-->
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12">
							<br/>
							<h5>Описание товара</h5>
							<?php echo $product['description']; ?>
						</div>
					</div>

				</div><!--/product-details-->

			</div>
		</div>
	</div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>
<script src="/template/js/image.js"></script>
