<?php
/* Smarty version 3.1.33, created on 2019-02-17 17:43:23
  from 'C:\wamp64\www\checkout.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c699d3b3a47a9_34265009',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0b9160a4e0182a5a7e428aa7d6484267b65d18be' => 
    array (
      0 => 'C:\\wamp64\\www\\checkout.html',
      1 => 1550425346,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
    'file:footer.html' => 1,
  ),
),false)) {
function content_5c699d3b3a47a9_34265009 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"Header"), 0, false);
?>

<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/heading-pages-01.jpg);">
		<h2 class="l-text2 t-center">
			Cart
		</h2>
	</section>

	<!-- Cart -->
	<section class="cart bgwhite p-t-70 p-b-100">
		<div class="container">
			<div class="row">
				<div class="col-8">
					<form method="POST" action="checkout.php">
						<div class="card w-100">
							<div class="card-header">
								Select a delivery address
							</div>
							<div class="card-body">
								<div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
									<select class="selection-2" name="address">
										<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['addresses']->value, 'address');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['address']->value) {
?>
										<option value="<?php echo $_smarty_tpl->tpl_vars['address']->value[0];?>
"> <?php echo $_smarty_tpl->tpl_vars['address']->value[1];?>
 <?php echo $_smarty_tpl->tpl_vars['address']->value[2];?>
 | <?php echo $_smarty_tpl->tpl_vars['address']->value[3];?>
 <?php echo $_smarty_tpl->tpl_vars['address']->value[4];?>
, <?php echo $_smarty_tpl->tpl_vars['address']->value[5];?>
</option>
										<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
									</select>
								</div>
							</div>
						</div>

						<div class="card w-100">
							<div class="card-header">
								Select payment method
							</div>
							<div class="card-body">
								<div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
									<select class="selection-2" name="payment">
										<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['payments']->value, 'payment');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['payment']->value) {
?>
										<option value="<?php echo $_smarty_tpl->tpl_vars['payment']->value[0];?>
"><?php echo $_smarty_tpl->tpl_vars['payment']->value[1];?>
 <?php echo $_smarty_tpl->tpl_vars['payment']->value[2];?>
 | <?php echo $_smarty_tpl->tpl_vars['payment']->value[3];?>
 <?php echo $_smarty_tpl->tpl_vars['payment']->value[4];?>
</option>
										<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
									</select>
								</div>
							</div>
						</div>

						<div class="card w-100">
							<div class="card-header">
								Choose a delivery option
							</div>
							<div class="card-body">
								<div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
									<select class="selection-2" name="courier">
										<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['deloptions']->value, 'option');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['option']->value) {
?>
										<option value="<?php echo $_smarty_tpl->tpl_vars['option']->value[0];?>
"><?php echo $_smarty_tpl->tpl_vars['option']->value[1];?>
 €<?php echo $_smarty_tpl->tpl_vars['option']->value[2];?>
</option>
										<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
									</select>
								</div>
							</div>
						</div>

						<div class="card w-30 text-center">
							<div class="card-body">
								<input type="submit" class="btn" name="confirm" value="Confirm order"></input>
							</div>
						</div>
					</form>
				</div>
				
				<div class="col-4">
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
