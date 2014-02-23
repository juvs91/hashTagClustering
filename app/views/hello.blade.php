<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
	<style>
		@import url(//fonts.googleapis.com/css?family=Lato:700);

		body {
			margin:0;
			font-family:'Lato', sans-serif;
			color: #999;
		}
	</style>
</head>
<body>
	<div>
		<h1>Valoraci&oacute;n</h1>
		<ul>
			@foreach ($feelings as $key => $value)
				<li>{{$key}} - <b>{{$value}}</b></li>
			@endforeach
		</ul>

	</div>
</body>
</html>
