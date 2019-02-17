<?php
/* Smarty version 3.1.33, created on 2019-02-17 10:05:06
  from 'C:\wamp64\www\addresses.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c6931d28f53c6_54436014',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2e9de69b4ade6f3d70e8704cddb7119cff286690' => 
    array (
      0 => 'C:\\wamp64\\www\\addresses.html',
      1 => 1550397768,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
    'file:footer.html' => 1,
  ),
),false)) {
function content_5c6931d28f53c6_54436014 (Smarty_Internal_Template $_smarty_tpl) {
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
					<div class="card-body text-center">
						<a href="add-address.php" class="btn btn-outline-dark">Add new address</a>
					</div>
				</div>
				<br>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['addresses']->value, 'address');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['address']->value) {
?>
				<div class="card w-100">
					<div class="card-body">
						<h5 class="card-title"><?php echo $_smarty_tpl->tpl_vars['address']->value[0];?>
:</h5>
						<h6 class="card-text"><?php echo $_smarty_tpl->tpl_vars['address']->value[1];?>
 <?php echo $_smarty_tpl->tpl_vars['address']->value[2];?>
</h6>
						<p class="card-text"><?php echo $_smarty_tpl->tpl_vars['address']->value[3];?>
, <?php echo $_smarty_tpl->tpl_vars['address']->value[4];?>
</p>
						<p class="card-text"><?php echo $_smarty_tpl->tpl_vars['address']->value[5];?>
, <?php echo $_smarty_tpl->tpl_vars['address']->value[6];?>
 <?php echo $_smarty_tpl->tpl_vars['address']->value[7];?>
</p>
						<p class="card-text"><?php echo $_smarty_tpl->tpl_vars['address']->value[8];?>
</p>
						<div class="text-center">
							<a href="addresses.php?delete=<?php echo $_smarty_tpl->tpl_vars['address']->value[0];?>
" class="btn btn-outline-dark">Delete</a>
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
            swal(nameProduct, "is added to cart !", "success");
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
