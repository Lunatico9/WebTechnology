<?php
/* Smarty version 3.1.33, created on 2019-02-17 12:26:14
  from 'C:\wamp64\www\order-detail.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c6952e662d318_37306585',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0982b497d618cb89f46f18e25837db33555a7f13' => 
    array (
      0 => 'C:\\wamp64\\www\\order-detail.html',
      1 => 1550406366,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
    'file:footer.html' => 1,
  ),
),false)) {
function content_5c6952e662d318_37306585 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"Header"), 0, false);
?>

<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/heading-pages-01.jpg);">
		<h2 class="l-text2 t-center">
			Cart
		</h2>
	</section>

	<!-- Order -->
	<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
					<div class="leftbar p-r-20 p-r-0-sm">
						<h4 class="m-text14 p-b-7">
							Menu
						</h4>
			
						<ul class="p-b-54">
							<li class="p-t-4">
								<a href="user-panel.php" class="s-text13 active1">
									Profile
								</a>
							</li>
			
							<li class="p-t-4">
								<a href="addresses.php" class="s-text13">
									Adresses
								</a>
							</li>
			
							<li class="p-t-4">
								<a href="payments.php" class="s-text13">
									Payment methods
								</a>
							</li>
			
							<li class="p-t-4">
								<a href="orders.php" class="s-text13">
									Orders
								</a>
							</li>
			
							<li class="p-t-4">
								<a href="logout.php" class="s-text13">
									Logout
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
					<div class="card w-100">
						<div class="card-header text-center">
							Order #<?php echo $_smarty_tpl->tpl_vars['order']->value;?>

						</div>
						<div class="card-body">
							<p class="card-text">Dispatched to: <?php echo $_smarty_tpl->tpl_vars['addname']->value;?>
 in <?php echo $_smarty_tpl->tpl_vars['address']->value;?>
</p>
							<p class="card-text">Payed by: <?php echo $_smarty_tpl->tpl_vars['payname']->value;?>
 with <?php echo $_smarty_tpl->tpl_vars['card']->value;?>
</p>
							<p class="card-text">Payment status: <?php echo $_smarty_tpl->tpl_vars['status']->value;?>
</p>
						</div>
					</div>
					<br>
					<div class="card w-100">
						<div class="wrap-table-shopping-cart bgwhite">
							<table class="table">
								<tr class="table-head">
									<th class="column-1"></th>
									<th class="column-2">Product</th>
									<th class="column-3">Price</th>
								</tr>

								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
?>
								<tr class="table-row">
									<td class="column-1">
										<div class="cart-img-product b-rad-4 o-f-hidden">
											<img src="<?php echo $_smarty_tpl->tpl_vars['product']->value[1];?>
" alt="IMG-PRODUCT">
										</div>
									</td>
							
									<td class="column-2">
										<a href="product-detail.php?product=<?php echo $_smarty_tpl->tpl_vars['product']->value[0];?>
"><?php echo $_smarty_tpl->tpl_vars['product']->value[2];?>
x <?php echo $_smarty_tpl->tpl_vars['product']->value[0];?>
<br></a>
										<p><span class="s-text8"><?php echo $_smarty_tpl->tpl_vars['product']->value[3];?>
</span></p>
										<p><span class="s-text8"><?php echo $_smarty_tpl->tpl_vars['product']->value[4];?>
</span></p>
									</td>
							
									<td class="column-3">
										€ <?php echo $_smarty_tpl->tpl_vars['product']->value[5];?>

									</td>
								</tr>
								<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
							</table>
						</div>
						<div class="card-footer text-center">
								<a href="order-support.php" class="btn btn-outline-dark">Get Support</a>
						</div>
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
 src="js/main.js"><?php echo '</script'; ?>
>

</body>
</html>
<?php }
}
