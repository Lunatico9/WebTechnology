<?php
/* Smarty version 3.1.33, created on 2019-02-17 10:51:37
  from 'C:\wamp64\www\add-address.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c693cb9c8f618_32209330',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '95f6581d4b6eec0fd19504355f38e6d0f8d23bd7' => 
    array (
      0 => 'C:\\wamp64\\www\\add-address.html',
      1 => 1550400685,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
    'file:footer.html' => 1,
  ),
),false)) {
function content_5c693cb9c8f618_32209330 (Smarty_Internal_Template $_smarty_tpl) {
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
			<div class="col-6">
				<form method="POST" action="add-address.php">
					<h4 class="m-text26 p-b-36 p-t-15">
						Add new address
					</h4>
		
					<?php if ($_smarty_tpl->tpl_vars['error']->value == 1) {?>
					<div class="alert alert-danger">
						<strong>Error!</strong> You've alredy used this address name.
					</div>
					<?php }?>
	
					<div class="bo4 of-hidden size15 m-b-20">
						<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="address-name" placeholder="Address Name" required>
					</div>
					
					<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="name" placeholder="Name" required>
					</div>

					<div class="bo4 of-hidden size15 m-b-20">
						<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="surname" placeholder="Surname" required>
					</div>
					
					<div class="bo4 of-hidden size15 m-b-20">
						<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="address" placeholder="Address" required>
					</div>

					<div class="bo4 of-hidden size15 m-b-20">
						<input class="sizefull s-text7 p-l-22 p-r-22" type="number" name="civ" placeholder="Civic number" required>
					</div>

					<div class="bo4 of-hidden size15 m-b-20">
						<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="city" placeholder="City" required>
					</div>

					<div class="bo4 of-hidden size15 m-b-20">
						<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="region" placeholder="Region" required>
					</div>

					<div class="bo4 of-hidden size15 m-b-20">
						<input class="sizefull s-text7 p-l-22 p-r-22" type="number" name="cap" placeholder="CAP" required>
					</div>

					<div class="bo4 of-hidden size15 m-b-20">
						<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="country" placeholder="Country" required>
					</div>

					<div class="w-size25">
						<!-- Button -->
						<button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4">
							Submit
						</button>
					</div>
				</form>
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
