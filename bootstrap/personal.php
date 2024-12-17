<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--add external css and srcipt -->
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- add internal css style-->
	<style>
		.bg-1 {
			background-color: #1079b2;
			color: #ffffff;
		}
		.bg-2 {
			background-color:#ffebaa ;
			color: #000000;
		}
		.bg-3 {
			background-color: #ffffff;
			color: #000000;
		}
		.container-fluid {
			padding-top: 70px;
			padding-bottom: 70px;
			padding-left: 50px;
    	padding-right: 50px;
		}
	</style>
	<title>Bootstrap Personal Profile</title>
</head>
<body id="myPage">
	<div class="container-fluid bg-1 text-center" id="hello">
	<h3>Hello</h3>
	<img src="../img/cat2.jpg" class="img-circle" alt="myself" width="250" >
	<h3>I'm Yuntian</h3>
</div>

<div class="container-fluid bg-2 text-center" id="context">
	<h3>About myself</h3>
	<p>UKM Year 3</p>
<div class="col-sm-4">
	<p>UKMfolio requested you to authenticate yourself. Please enter your Matric Number / UKMPer / Identification and password in the form below.</p>
	<img src="../img/coin.jpg" class="img-responsive" alt="Image" style="display:inline">
</div>
<div class="col-sm-4">
	<p>UKMfolio requested you to authenticate yourself. Please enter your Matric Number / UKMPer / Identification and password in the form below.</p>
	<img src="../img/festival.jpg" class="img-responsive" alt="Image" style="display:inline">
</div>
<div class="col-sm-4">
	<p>UKMfolio requested you to authenticate yourself. Please enter your Matric Number / UKMPer / Identification and password in the form below.</p>
	<img src="../img/map.jpg" class="img-responsive" alt="Image" style="display:inline">
</div>
</div>

<div class="container-fluid bg-3 text-center" id="tail" >
	<h3>Language</h3>
	<p>HTML, PHP</p>
	<a href="#" class="btn btn-default btn-lg">
		<span class="glyphicon glyphicon-search"></span>Search</a>
</div>

<div class="container-fluid" style="background-color: #dddddd" id="contact">
  <h3 class="text-center">Leave me message</h3>
  <div class="row">
    <div class="col-sm-5">
      <p><span class="glyphicon glyphicon-map-marker"></span> UKM,FTSM</p>
      <p><span class="glyphicon glyphicon-envelope"></span> a197547@siswa.ukm.edu.my</p>
    </div>
    <form action="mailto:a197547@siswa.ukm.edu.my?subject=Good day" method="get">
    <div class="col-sm-7">
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="subject" name="subject" placeholder="Subject" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="cc" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="body" placeholder="Comment" rows="5"></textarea><br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button  class="btn btn-default pull-right" type="submit">Send</button>
        </div>
      </div>
    </div>
    </form>
  </div>
</div>
</body>
</html>
