<?php
require_once 'Page.php';
$page = Page::getInstance();
?>
<!DOCTYPE HTML>
<html>
	<?php echo $page->head(); ?>

	<body class="landing is-preload">
		<div id="page-wrapper">

			<?php echo $page->nav(); ?>

			<?php echo $page->banner(); ?>
			
			<!-- Main -->
				<section id="main" class="container">
					<section class="box">
					<?php
					function typeEq($pass, $type) {
						if ( $_SESSION['thisPass'] == $pass ) {
							return " type=\"{$type}\" ";
						} else {
							return " type=\"hidden\" ";
						}
					}

					function valueEq($pass, $field) {
						if ( $_SESSION['thisPass'] == $pass ) {
							return " value=\"\" ";
						} elseif ( isset($_POST[$field]) ) {
							return " value=\"{$_POST[$field]}\" ";
						} else {
							return " value=\"\" ";
						}
					}
					
					if (isset($_POST['email']) && isset($_POST['password']) && 
						isset($_POST['password1']) && 
						$_POST['password'] == $_POST['password1']) {
							$_SESSION['thisPass'] = 1;
					} else {
						$_SESSION['thisPass'] = 0;
					}
					?>
						<form method="post" action=<?php echo "\"". ($_SESSION['thisPass'] == 0 ? "signup.php":"register.php") ."\""; ?> >
							<div class="row gtr-uniform gtr-50">

								<!-- zeroeth pass -->
								<div class="col-12">
									<input <?php echo typeEq(0, "email"); ?> name="email" id="email" <?php echo valueEq(0, "email"); ?> placeholder="Email" />
								</div>
								<div class="col-6 col-12-mobilep">
									<input <?php echo typeEq(0, "password"); ?> name="password" id="password" <?php echo valueEq(0, "password"); ?>  placeholder="Password" />
								</div>
								<div class="col-6 col-12-mobilep">
									<input <?php echo typeEq(0, "password"); ?> name="password1" id="password1" <?php echo valueEq(0, "password1"); ?>  placeholder="Password" />
								</div>
								
								<!-- first pass -->
								<div class="col-6 col-12-mobilep">
									<input <?php echo typeEq(1, "text"); ?> name="firstname" id="firstname" value="" placeholder="First name" />
								</div>
								<div class="col-6 col-12-mobilep">
									<input <?php echo typeEq(1, "text"); ?> name="lastname" id="lastname" value="" placeholder="Last name" />
								</div>
								<div class="col-12">
									<input <?php echo typeEq(1, "text"); ?> name="phone" id="phone" value="" placeholder="Phone number" />
								</div>

								<div class="col-12">
									<ul class="actions">
										<li><input type="submit" value="Sign Up!" class="button"/></li>
										<li><input type="reset" value="Reset" class="alt" /></li>
									</ul>
								</div>
							</div>
						</form>
					</section>

<!--
	<div class="col-12">
									<input type="text" name="address1" id="address1" value="" placeholder="Street address" />
								</div>
								<div class="col-12">
									<input type="text" name="address2" id="address2" value="" placeholder="Address line 2" />
								</div>
								<div class="col-6 col-12-mobilep">
									<input type="text" name="city" id="city" value="" placeholder="Town/City" />
								</div>
								<div class="col-3 col-12-mobilep">
									<select name="state" id="state">
										<option value="">- State -</option>
										<option value="NH">New Hampshire</option>
										<option value="MA">Massachusetts</option>
										<option value="XX">Mars</option>
										<option value="YL">Yolo</option>
									</select>
								</div>
								<div class="col-3 col-12-mobilep">
									<input type="text" name="zipcode" id="zipcode" value="" placeholder="Zip code" />
								</div>
-->
			<!-- Footer -->
				<footer id="footer">
					<ul class="icons">
						<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon brands fa-github"><span class="label">Github</span></a></li>
						<li><a href="#" class="icon brands fa-dribbble"><span class="label">Dribbble</span></a></li>
						<li><a href="#" class="icon brands fa-google-plus"><span class="label">Google+</span></a></li>
					</ul>
					<ul class="copyright">
						<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>
				</footer>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>