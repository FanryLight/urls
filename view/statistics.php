<html>
<head>
    <link rel="stylesheet" type="text/css" href="/web/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="/web/js/script.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<div class="page">
<a class="btn btn-default" href="/" role="button">Main</a>
	<h3>URL's statistics</h3>
    <table class="table table-hover">
		<thead>
			<tr>
				<th>URL</th>
				<th>Last request date</th>
				<th>Last title</th>
				<th>Last status</th>
			</tr>
		</thead>
	<tbody>
	<?php foreach ($data as $url) : ?>
		<tr>
			<td><a href="/statistics/chart/?id=<?= $url['id']?>"><?= $url['path']?></a></td>
			<td><?= $url['date']?></td>
			<td><?= $url['title']?></td>
			<td><?= $url['code']?></td>
		</tr>
	<?php endforeach ?>
	</tbody>
	</table>
</div>
</body>
</html>
