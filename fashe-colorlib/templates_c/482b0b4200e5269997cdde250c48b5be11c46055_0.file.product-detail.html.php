<?php
/* Smarty version 3.1.33, created on 2019-02-17 16:07:17
  from 'C:\wamp64\www\fashe-colorlib\product-detail.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c6986b5cafc80_94454908',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '482b0b4200e5269997cdde250c48b5be11c46055' => 
    array (
      0 => 'C:\\wamp64\\www\\fashe-colorlib\\product-detail.html',
      1 => 1550419633,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
    'file:footer.html' => 1,
  ),
),false)) {
function content_5c6986b5cafc80_94454908 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"Header"), 0, false);
?>

	<!-- breadcrumb -->
	<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
		<a href="index.php" class="s-text16">
			Home
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<a href="shop.php?catalogue=<?php echo $_smarty_tpl->tpl_vars['catalogo']->value;?>
" class="s-text16">
			<?php echo $_smarty_tpl->tpl_vars['catalogo']->value;?>

			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<a href="shop.php?category=<?php echo $_smarty_tpl->tpl_vars['categoria']->value;?>
" class="s-text16">
			<?php echo $_smarty_tpl->tpl_vars['categoria']->value;?>

			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<span class="s-text17">
			<?php echo $_smarty_tpl->tpl_vars['nome']->value;?>
 Detail
		</span>
	</div>

	<!-- Product Detail -->
	<div class="container bgwhite p-t-35 p-b-80">
		<div class="flex-w flex-sb">
			<div class="w-size13 p-t-30 respon5">
				<div class="wrap-slick3 flex-sb flex-w">
					<div class="wrap-slick3-dots"></div>

					<div class="slick3">
						<div class="item-slick3" data-thumb="images/thumb-item-01.jpg">
							<div class="wrap-pic-w">
								<img src="images/product-detail-01.jpg" alt="IMG-PRODUCT">
							</div>
						</div>

						<div class="item-slick3" data-thumb="images/thumb-item-02.jpg">
							<div class="wrap-pic-w">
								<img src="images/product-detail-02.jpg" alt="IMG-PRODUCT">
							</div>
						</div>

						<div class="item-slick3" data-thumb="images/thumb-item-03.jpg">
							<div class="wrap-pic-w">
								<img src="images/product-detail-03.jpg" alt="IMG-PRODUCT">
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="w-size14 p-t-30 respon5">
				<h4 class="product-detail-name m-text16 p-b-13" id="productName">
					<?php echo $_smarty_tpl->tpl_vars['prodotto']->value;?>

				</h4>
				
				<?php if (isset($_smarty_tpl->tpl_vars['prezzos']->value)) {?>
				<span class="block2-oldprice m-text7 p-r-5">
					€ <?php echo $_smarty_tpl->tpl_vars['prezzo']->value;?>

				</span>

				<span class="block2-newprice m-text8 p-r-5">
					€ <?php echo $_smarty_tpl->tpl_vars['prezzos']->value;?>

				</span>
				<?php } else { ?>
				<span class="block2-price m-text6 p-r-5">
					€ <?php echo $_smarty_tpl->tpl_vars['prezzo']->value;?>

				</span>
				<?php }?>
				
				<!-- Size -->
				<div class="p-t-33 p-b-60">
					<div class="flex-m flex-w p-b-10">
						<div class="s-text15 w-size15 t-center">
							Size
						</div>

						<div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
							<select class="selection-2" name="size" id="productSize">
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sizes']->value, 'size');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['size']->value) {
?>
								<option><?php echo $_smarty_tpl->tpl_vars['size']->value[0];?>
</option>
								<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
							</select>
						</div>
					</div>

                    <!-- Color -->
					<div class="flex-m flex-w">
						<div class="s-text15 w-size15 t-center">
							Color
						</div>

						<div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
							<select class="selection-2" name="color" id="productColor">
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['colors']->value, 'color');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['color']->value) {
?>
								<option><?php echo $_smarty_tpl->tpl_vars['color']->value[0];?>
</option>
								<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
							</select>
						</div>
					</div>

					<div class="flex-r-m flex-w p-t-10">
						<div class="w-size16 flex-m flex-w">
							<div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
								<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
								</button>

								<input class="size8 m-text18 t-center num-product" type="number" name="num-product" id="productNumber" value="1">

								<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
								</button>
							</div>

							<div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
								<!-- Button --> 
								<!-- AJAX here --> 
								<button onclick="addToCart()" id="button" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
									Add to Cart
								</button>
							</div>
						</div>
					</div>
				</div>

                <!-- Categories -->
				<div class="p-b-45">
					<span class="s-text8">Categories: <?php echo $_smarty_tpl->tpl_vars['categoria']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['catalogo']->value;?>
.</span>
				</div>

				<!-- Descriptions -->
				<div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Description
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							<?php echo $_smarty_tpl->tpl_vars['desc1']->value;?>

						</p>
					</div>
				</div>

				<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Additional information
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							<?php echo $_smarty_tpl->tpl_vars['desc2']->value;?>

						</p>
					</div>
				</div>

			</div>
		</div>
	</div>


	<!-- Related Product -->
	<section class="relateproduct bgwhite p-t-45 p-b-138">
		<div class="container">
			<div class="sec-title p-b-60">
				<h3 class="m-text5 t-center">
					Related Products
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">
					
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['relprod']->value, 'product');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
?>
					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative">
								<img src="<?php echo $_smarty_tpl->tpl_vars['product']->value[2];?>
" alt="IMG-PRODUCT">

								<div class="block2-overlay trans-0-4">
									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<button onclick="addToCart()" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</button>
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20">
								<a href="product-detail.php?product=<?php echo $_smarty_tpl->tpl_vars['product']->value[0];?>
" class="block2-name dis-block s-text3 p-b-5">
									<?php echo $_smarty_tpl->tpl_vars['product']->value[0];?>

								</a>

								<?php if (isset($_smarty_tpl->tpl_vars['product']->value[3])) {?>
								<span class="block2-oldprice m-text7 p-r-5">
									€ <?php echo $_smarty_tpl->tpl_vars['product']->value[1];?>

								</span>
								<span class="block2-newprice m-text8 p-r-5">
									€ <?php echo $_smarty_tpl->tpl_vars['product']->value[3];?>

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
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
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
				swal(nameProduct, "is added to cart !", "success");
			});
		});
	<?php echo '</script'; ?>
>
<!--===============================================================================================-->
<!--    <?php echo '<script'; ?>
 type="text/javascript">
        function addToCart () {
            var name = $("#productName").text();
            request = new XMLHttpRequest();
            request.onreadystatechange = function () {
                alert("RESPONSE RECEIVED");
            }
            request.open("POST", "function.php", true);
            request.send("sanitizeString($" + name + ");");
            alert (name);
        }
    <?php echo '</script'; ?>
>
-->
    <?php echo '<script'; ?>
 type="text/javascript">
        function addToCart() {
            alert("SCRIPT");
            var name = $("#productName").text();
            var number = $("#productNumber").val();
            var color = $("#productColor").val();
            var size = $("#productSize").val();
            size = sanitizeString(size);
            color = sanitizeString(color);
            number = sanitizeString(number);
            name = sanitizeString(name);
            $.post("addToCart.php", 
                {
                    name: name,
                    number: number,
                    color: color,
                    size: size
                },
                function (result){
                    alert(result);
                })
            }
    <?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
 type="text/javascript">
        function sanitizeString(str){
            str = str.replace(/[^a-z0-9áéíóúñü \.,_-]/gim,"");
            return str.trim();
        }
    <?php echo '</script'; ?>
>


	<?php echo '<script'; ?>
 src="js/main.js"><?php echo '</script'; ?>
>

</body>
</html>
<?php }
}
