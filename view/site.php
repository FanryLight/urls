<html>
<head>
    <link rel="stylesheet" type="text/css" href="/web/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="/web/js/script.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
<body>
<div class="page">
	<div class="form-horizontal">
		<div class="form-group">
			<label for="result" class="col-sm-2 control-label">Enter your URLs</label>
			<div class="col-sm-10">
				<textarea  class="form-control" id="area"></textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" onclick="javascript:sendURLs()" class="btn btn-success">Get Information</button>
				<a class="btn btn-info right" href="/statistics" role="button">View Statistics</a>
			</div>
		</div>
	</div>
	<p class="bg-danger" id="error"></p>
	<table class="table table-hover" id="result">
		<thead>
			<tr>
				<th>Path</th>
				<th>Code</th>
				<th>Title</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
</body>
</html>
