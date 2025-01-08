<?php 

require_once "core/base.php";

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>⚡ PHPUnitTests</title>
	<link rel="stylesheet" type="text/css" href="public/css/style.css">
	<script type="text/javascript" src="public/vendor/jquery-3.7.1.min.js"></script>
	<script type="text/javascript" src="public/js/app.js"></script>
</head>
<body>
	<h1 class="title">⚡ PHPUnitTests</h1>
	<div class="path">tests<?=$path?></div>
	<div class="list">
		<?php if (!empty($backPath)): ?>
			<div><a href="?path=<?=urlencode($backPath)?>"><span class="icon">🞀</span> Back</a></div>
		<?php endif ?>
		<?php if ($execPath): ?>
			<pre id="testResults" data-path="tests<?=$execPath?>"></pre>
			<script type="text/javascript">
				$(function() {
					runTest();
				});
			</script>
		<?php else: ?>
			<?php foreach ($folders as $folder): ?>
				<div class="folder"><a href="?path=<?=urlencode($folder)?>"><span class="icon">📁</span><?=basename($folder)?></a></div>
			<?php endforeach ?>
			<?php foreach ($files as $file): ?>
				<div class="file"><a href="?exec=<?=urlencode($file)?>"><span class="icon">⚡</span><?=basename($file)?></a></div>
			<?php endforeach ?>
		<?php endif ?>
	</div>
</body>
</html>
