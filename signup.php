<?php
require_once 'Page.php';
$page = Page::getInstance();
?>
<!DOCTYPE HTML>
<!--
	Alpha by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Alpha by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="landing is-preload">
		<div id="page-wrapper">

			<?php echo $page->nav(); ?>

			<!-- Banner -->
			<section id="banner">
				<h2>Sign up for <?php echo $page->title(); ?> !
				<br />
				With 6% interest on your funds!</h2>
				<p>Putting better-than-savings interest in your checking account</p>
			</section>

			<!-- Main -->
				<section id="main" class="container">
					<section class="box">
						<form method="post" action="register.php">
							<div class="row gtr-uniform gtr-50">
								<div class ="col-4 col-12-mobilep">
									<input type="text" name="username" id="username" value="" placeholder="Username" />
								</div>
								<div class="col-4 col-12-mobilep">
									<input type="password" name="password" id="password" value="" placeholder="Password" />
								</div>
								<div class="col-4 col-12-mobilep">
									<input type="password" name="password1" id="password1" value="" placeholder="Password" />
								</div>
								<div class="col-6 col-12-mobilep">
									<input type="text" name="firstname" id="firstname" value="" placeholder="First name" />
								</div>
								<div class="col-6 col-12-mobilep">
									<input type="text" name="lastname" id="lastname" value="" placeholder="Last name" />
								</div>
								<div class="col-12">
									<input type="email" name="email" id="email" value="" placeholder="Email" />
								</div>
								<div class="col-12">
									<input type="text" name="phone" id="phone" value="" placeholder="Phone number" />
								</div>
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
								<div class="col-12">
									<ul class="actions">
										<li><input type="submit" value="Sign Up!" class="button"/></li>
										<li><input type="reset" value="Reset" class="alt" /></li>
									</ul>
								</div>
							</div>
						</form>
					</section>

					<section class="box special features">
						<div class="features-row">
							<section>
								<span class="icon solid major fa-bolt accent2"></span>
								<h3>Magna etiam</h3>
								<p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
							</section>
							<section>
								<span class="icon solid major fa-chart-area accent3"></span>
								<h3>Ipsum dolor</h3>
								<p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
							</section>
						</div>
						<div class="features-row">
							<section>
								<span class="icon solid major fa-cloud accent4"></span>
								<h3>Sed feugiat</h3>
								<p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
							</section>
							<section>
								<span class="icon solid major fa-lock accent5"></span>
								<h3>Enim phasellus</h3>
								<p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
							</section>
						</div>
					</section>

					<div class="row">
						<div class="col-6 col-12-narrower">

							<section class="box special">
								<span class="image featured"><img src="images/pic02.jpg" alt="" /></span>
								<h3>Sed lorem adipiscing</h3>
								<p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
								<ul class="actions special">
									<li><a href="#" class="button alt">Learn More</a></li>
								</ul>
							</section>

						</div>
						<div class="col-6 col-12-narrower">

							<section class="box special">
								<span class="image featured"><img src="images/pic03.jpg" alt="" /></span>
								<h3>Accumsan integer</h3>
								<p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
								<ul class="actions special">
									<li><a href="#" class="button alt">Learn More</a></li>
								</ul>
							</section>

						</div>
					</div>

				</section>

			<!-- CTA -->
				<section id="cta">

					<h2>Sign up for beta access</h2>
					<p>Blandit varius ut praesent nascetur eu penatibus nisi risus faucibus nunc.</p>

					<form>
						<div class="row gtr-50 gtr-uniform">
							<div class="col-8 col-12-mobilep">
								<input type="email" name="email" id="email" placeholder="Email Address" />
							</div>
							<div class="col-4 col-12-mobilep">
								<input type="submit" value="Sign Up" class="fit" />
							</div>
						</div>
					</form>

				</section>

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