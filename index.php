<?php include('khipu-lib.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="images/favicon.ico">

	<title>Llena los datos para tu compra.</title>

	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="css/cover.css" rel="stylesheet">

	<!-- Just for debugging purposes. Don't actually copy this line! -->
	<!--[if lt IE 9]>
	<script src="js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>

<div class="site-wrapper">

	<div class="site-wrapper-inner">

		<div class="cover-container">

			<div class="masthead clearfix">
				<div class="inner">
					<h3 class="masthead-brand">Comercio de ejemplo</h3>
					<ul class="nav masthead-nav">
						<li class="active"><a href="#">Demo</a></li>
						<li><a href="https://khipu.com/page/api">API Rest</a></li>
						<li><a href="https://khipu.com/page/biblioteca-javascript">Biblioteca Javascript</a></li>
					</ul>
				</div>
			</div>

			<div class="inner cover">
				<h1 class="cover-heading">Llena los datos para tu compra.</h1>

				<form class="form-horizontal" role="form" action="demo-send.php" method="post">
					<div class="form-group <?php echo $_REQUEST['invalid'] ? 'has-error' : ''; ?>">
						<label for="email" class="col-sm-4 control-label">Ingresa tu correo electr&oacute;nico</label>

						<div class="col-sm-8">
							<input type="email" class="form-control" id="email" name="email" placeholder="mi@correo.cl">
						</div>

					</div>
					<div class="form-group">
						<label for="bankId" class="col-sm-4 control-label">Elije tu banco</label>

						<div class="col-sm-8">
							<select name="bankId" class="form-control" id="bankId">
								<?php
								$banks = khipu_get_banks();
								foreach ($banks as $bank) {
									echo "<option value=\"" . $bank['id'] . "\">" . $bank['name'] . "</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-10">
							<button type="submit" class="btn btn-primary">Revisar orden y pagar</button>
						</div>
					</div>
				</form>

			</div>

			<div class="mastfoot">
				<div class="inner">
					<p>Cover template for <a href="http://getbootstrap.com">Bootstrap</a>, by <a
							href="https://twitter.com/mdo">@mdo</a>.</p>
				</div>
			</div>

		</div>

	</div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/docs.min.js"></script>
</body>
</html>
