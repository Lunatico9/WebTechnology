<?php
/* Smarty version 3.1.33, created on 2019-02-09 18:07:44
  from 'C:\wamp64\www\header.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c5f16f0ab3b05_31651336',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e4d1f0df58bc96e82c57e21deb1bcb1ddb35a2d1' => 
    array (
      0 => 'C:\\wamp64\\www\\header.html',
      1 => 1549735659,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c5f16f0ab3b05_31651336 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
	<title>Saam</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/themify/themify-icons.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/elegant-font/html-css/style.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/new.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/lightbox2/css/lightbox.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body class="animsition">

	<!-- header fixed -->
	<div class="wrap_header fixed-header2 trans-0-4">
		<!-- Logo -->
		<a href="index.php" class="logo">
			<img src="images/icons/img-logo-big.png" alt="IMG-LOGO">
		</a>

		<!-- Header Icon -->
		<div class="header-icons">
			<a href="accessControl.php" class="header-wrapicon1 dis-block">
				<img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
			</a>

			<span class="linedivide1"></span>

			<div class="header-wrapicon2">
				<a href="cart.php" class="header-wrapicon1 dis-block">
					<img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
				</a>
				<span class="header-icons-noti"><?php echo $_smarty_tpl->tpl_vars['items']->value;?>
</span>
			</div>
		</div>
	</div>

	<!-- Header -->
	<header class="header2">
		<!-- Header desktop -->
		<div class="container-menu-header-v2 p-t-26">
			<div class="topbar2">
				<div class="topbar-social">
					<a href="https://www.facebook.com/SaamLAquila/" class="topbar-social-item fa fa-facebook"></a>
					<a href="https://www.instagram.com/saam_laquila/" class="topbar-social-item fa fa-instagram"></a>
					<a href="https://www.pinterest.it/search/pins/?q=sala%20d%27arme%20achille%20marozzo&rs=typed&term_meta[]=sala%7Ctyped&term_meta[]=d%27arme%7Ctyped&term_meta[]=achille%7Ctyped&term_meta[]=marozzo%7Ctyped" class="topbar-social-item fa fa-pinterest-p"></a>
					<a href="https://www.youtube.com/user/AchilleMarozzoVideo" class="topbar-social-item fa fa-youtube-play"></a>
				</div>

				<!-- Logo2 -->
				<a href="index.php" class="logo2">
					<img src="images/icons/img-logo-big.png" alt="IMG-LOGO">
				</a>

				<div class="topbar-child2">
					<span class="topbar-email">
						<?php echo $_smarty_tpl->tpl_vars['user']->value;?>

					</span>

					<!--  -->
					<a href="accessControl.php" class="header-wrapicon1 dis-block m-l-30">
						<img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
					</a>

					<span class="linedivide1"></span>

					<div class="header-wrapicon2 m-r-13">
						<div class="header-wrapicon2">
							<a href="cart.php" class="header-wrapicon1 dis-block">
								<img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
							</a>
							<span class="header-icons-noti"><?php echo $_smarty_tpl->tpl_vars['items']->value;?>
</span>
						</div>
					</div>
				</div>
			</div>

			<div class="wrap_header">

				<!-- Menu -->
				<div class="wrap_menu">
					<nav class="menu">
						<ul class="main_menu">
							<li>
								<a href="index.php">Home</a>
							</li>

							<li>
								<a href="shop.php">Shop</a>
							</li>

							<li>
								<a href="about.php">About</a>
							</li>

							<li>
								<a href="contact.php">Contact</a>
							</li>
						</ul>
					</nav>
				</div>

				<!-- Header Icon -->
				<div class="header-icons">

				</div>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap_header_mobile">
			<!-- Logo moblie -->
			<a href="index.php" class="logo-mobile">
				<img src="images/icons/img-logo-big.png" alt="IMG-LOGO">
			</a>

			<!-- Button show menu -->
			<div class="btn-show-menu">
				<!-- Header Icon mobile -->
				<div class="header-icons-mobile">
					<a href="accessControl.php" class="header-wrapicon1 dis-block">
						<img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
					</a>

					<span class="linedivide2"></span>

					<div class="header-wrapicon2">
						<div class="header-wrapicon2">
							<a href="cart.php" class="header-wrapicon1 dis-block">
								<img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
							</a>
							<span class="header-icons-noti"><?php echo $_smarty_tpl->tpl_vars['items']->value;?>
</span>
						</div>
					</div>
				</div>

				<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</div>
			</div>
		</div>

		<!-- Menu Mobile -->
		<div class="wrap-side-menu" >
			<nav class="side-menu">
				<ul class="main-menu">
					<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
						<span class="topbar-child1">
							Free shipping for standard order over $100
						</span>
					</li>

					<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
						<div class="topbar-child2-mobile">
							<span class="topbar-email">
								<?php echo $_smarty_tpl->tpl_vars['name']->value;?>

							</span>
						</div>
					</li>

					<li class="item-topbar-mobile p-l-10">
						<div class="topbar-social-mobile">
							<a href="https://www.facebook.com/SaamLAquila/" class="topbar-social-item fa fa-facebook"></a>
							<a href="https://www.instagram.com/saam_laquila/" class="topbar-social-item fa fa-instagram"></a>
							<a href="https://www.pinterest.it/search/pins/?q=sala%20d%27arme%20achille%20marozzo&rs=typed&term_meta[]=sala%7Ctyped&term_meta[]=d%27arme%7Ctyped&term_meta[]=achille%7Ctyped&term_meta[]=marozzo%7Ctyped" class="topbar-social-item fa fa-pinterest-p"></a>
							<a href="https://www.youtube.com/user/AchilleMarozzoVideo" class="topbar-social-item fa fa-youtube-play"></a>
						</div>
					</li>

					<li class="item-menu-mobile">
						<a href="index.php">Home</a>
					</li>

					<li class="item-menu-mobile">
						<a href="shop.php">Shop</a>
					</li>

					<li class="item-menu-mobile">
						<a href="about.php">About</a>
					</li>

					<li class="item-menu-mobile">
						<a href="contact.php">Contact</a>
					</li>
				</ul>
			</nav>
		</div>
	</header><?php }
}
