<?php
/* Smarty version 3.1.33, created on 2019-02-15 20:24:45
  from 'C:\wamp64\www\shop.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c67200d2b4330_74573781',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'acf8d610c3f299e547366876bd40ede79ce8acae' => 
    array (
      0 => 'C:\\wamp64\\www\\shop.html',
      1 => 1550262279,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
    'file:footer.html' => 1,
  ),
),false)) {
function content_5c67200d2b4330_74573781 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"Header"), 0, false);
?>

<!-- Title Page -->
<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(images/heading-pages-02.jpg);">
	<h2 class="l-text2 t-center">
		Women
	</h2>
	<p class="m-text13 t-center">
		New Arrivals Women Collection 2018
	</p>
</section>


<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
				<div class="leftbar p-r-20 p-r-0-sm">
					<!-- NEED DROPDOWN ON SIDENAV -->
					<h4 class="m-text14 p-b-7">
						Categories
					</h4>

					<ul class="p-b-54">
						<li class="p-t-4">
							<a href="shop.php" class="s-text13 active1">
								All
							</a>
						</li>

						<li class="p-t-4">
							<a href="shop.php?onsale=onsale" class="s-text13 active1">
								On Sale
							</a>
						</li>

						<li class="p-t-4">
							<a href="shop.php?catalogue=swords" class="s-text13">
								Swords
							</a>
						</li>

						<li class="p-t-4">
							<a href="shop.php?catalogue=shields" class="s-text13">
								Shields
							</a>
						</li>

						<li class="p-t-4">
							<a href="shop.php?catalogue=protective gears" class="s-text13">
								Protective gears
							</a>
						</li>

						<li class="p-t-4">
							<a href="shop.php?catalogue=manuscripts" class="s-text13">
								Manuscripts
							</a>
						</li>

						<li class="p-t-4">
							<a href="shop.php?catalogue=accessories" class="s-text13">
								Accesories
							</a>
						</li>
					</ul>
					<div class="search-product pos-relative bo4 of-hidden">
						<form method="POST" action="shop.php">
							<input class="s-text7 size6 p-l-23 p-r-50" type="text" name="search-product" placeholder="Search Products...">
							<button class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4" type="submit">
								<i class="fs-12 fa fa-search" aria-hidden="true"></i>
							</button>
						</form>
					</div>
					</ul>
				</div>
			</div>
			<!-- NEED AJAX OR JS FUNCTION -->
			<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
				<div class="flex-sb-m flex-w p-b-35">
					<div class="flex-w">
						<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
							<form method="POST" action="shop.php">
								<select class="selection-2" id="sorting" name="sorting">
									<option>Default Sorting</option>
									<option value="popularity">Popularity</option>
									<option value="lth">Price: low to high</option>
									<option value="htl">Price: high to low</option>
								</select>
							</form>
						</div>


						<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
							<form method="POST" action="shop.php">
								<select class="selection-2" name="price">
									<option>Price</option>
									<option>€0.00 - €50.00</option>
									<option>€50.00 - €100.00</option>
									<option>€100.00 - €200.00</option>
									<option>€200.00+</option>
								</select>
							</form>
						</div>
					</div>

					<span class="s-text8 p-t-5 p-b-5">
							Showing <?php echo $_smarty_tpl->tpl_vars['prd']->value;?>
 of <?php echo $_smarty_tpl->tpl_vars['total_prd']->value;?>
 results
					</span>
				</div>

				<!-- Product -->
				<!-- NEED JS Function to show results after 12 (remove hidden attribute and update span value -->
				<div class="row">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product');
$_smarty_tpl->tpl_vars['product']->iteration = 0;
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->iteration++;
$__foreach_product_0_saved = $_smarty_tpl->tpl_vars['product'];
?>
					<?php if ($_smarty_tpl->tpl_vars['product']->iteration > 12) {?>
					<div hidden class="col-sm-12 col-md-6 col-lg-4 p-b-50">
					<?php } else { ?>
					<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
					<?php }?>
						<!-- Block2 -->
						<div class="block2">
							<?php if (isset($_smarty_tpl->tpl_vars['product']->value[3])) {?>
							<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
								<img src="<?php echo $_smarty_tpl->tpl_vars['product']->value[2];?>
" alt="IMG-PRODUCT">

								<div class="block2-overlay trans-0-4">
									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<button name="<?php echo $_smarty_tpl->tpl_vars['product']->value[0];?>
" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</button>
									</div>
								</div>
							</div>
							<?php } else { ?>
							<div class="block2-img wrap-pic-w of-hidden pos-relative">
								<img src="<?php echo $_smarty_tpl->tpl_vars['product']->value[2];?>
" alt="IMG-PRODUCT">

								<div class="block2-overlay trans-0-4">
									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<button name="<?php echo $_smarty_tpl->tpl_vars['product']->value[0];?>
" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</button>
									</div>
								</div>
							</div>
							<?php }?>
							<div class="block2-txt p-t-20">
								<a href="product-detail.php?product=<?php echo $_smarty_tpl->tpl_vars['product']->value[0];?>
" class="block2-name dis-block s-text3 p-b-5">
									<?php echo $_smarty_tpl->tpl_vars['product']->value[0];?>

								</a>

								<?php if (isset($_smarty_tpl->tpl_vars['product']->value[3])) {?>
								<span class="block2-oldprice m-text7 p-r-5">
									<?php echo $_smarty_tpl->tpl_vars['product']->value[1];?>

								</span>
								<span class="block2-newprice m-text8 p-r-5">
								    <?php echo $_smarty_tpl->tpl_vars['product']->value[3];?>

								</span>
								<?php } else { ?>
								<span class="block2-price m-text6 p-r-5">
									€ <?php echo $_smarty_tpl->tpl_vars['product']->value[1];?>

								</span>
								<?php }?>
							</div>
						</div>
					</div>
					<?php
$_smarty_tpl->tpl_vars['product'] = $__foreach_product_0_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</div>
			</div>
		</div>
	</div>
</section>


<?php $_smarty_tpl->_subTemplateRender("file:footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"Footer"), 0, false);
?>


<!-- Back to top -->
<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
</div>

<!-- Container Selection -->
<div id="dropDownSelect1"></div>
<div id="dropDownSelect2"></div>



<!--===============================================================================================-->
<?php echo '<script'; ?>
 type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"><?php echo '</script'; ?>
>
<!--===============================================================================================-->
<?php echo '<script'; ?>
 type="text/javascript" src="vendor/animsition/js/animsition.min.js"><?php echo '</script'; ?>
>
<!--===============================================================================================-->
<?php echo '<script'; ?>
 type="text/javascript" src="vendor/bootstrap/js/popper.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"><?php echo '</script'; ?>
>
<!--===============================================================================================-->
<?php echo '<script'; ?>
 type="text/javascript" src="vendor/select2/select2.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
    $(".selection-1").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });

    $(".selection-2").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect2')
    });
<?php echo '</script'; ?>
>
<!--===============================================================================================-->
<?php echo '<script'; ?>
 type="text/javascript" src="vendor/daterangepicker/moment.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="vendor/daterangepicker/daterangepicker.js"><?php echo '</script'; ?>
>
<!--===============================================================================================-->
<?php echo '<script'; ?>
 type="text/javascript" src="vendor/slick/slick.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="js/slick-custom.js"><?php echo '</script'; ?>
>
<!--===============================================================================================-->
<?php echo '<script'; ?>
 type="text/javascript" src="vendor/sweetalert/sweetalert.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
    $('.block2-btn-addcart').each(function(){
        var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
        $(this).on('click', function(){
            swal(nameProduct, "is added to cart!", "success");
        });
    });
<?php echo '</script'; ?>
>

<!--===============================================================================================-->
<?php echo '<script'; ?>
 type="text/javascript" src="vendor/noui/nouislider.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
    /*[ No ui ]
    ===========================================================*/
    var filterBar = document.getElementById('filter-bar');

    noUiSlider.create(filterBar, {
        start: [ 50, 200 ],
        connect: true,
        range: {
            'min': 50,
            'max': 200
        }
    });

    var skipValues = [
        document.getElementById('value-lower'),
        document.getElementById('value-upper')
    ];

    filterBar.noUiSlider.on('update', function( values, handle ) {
        skipValues[handle].innerHTML = Math.round(values[handle]) ;
    });
<?php echo '</script'; ?>
>
<!--===============================================================================================-->
<?php echo '<script'; ?>
 src="js/main.js"><?php echo '</script'; ?>
>

</body>
</html>
<?php }
}
