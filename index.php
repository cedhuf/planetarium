<!DOCTYPE html>
<!--
   ________         ___  __              __           _
  /_  __/ /  ___   / _ \/ /__ ____  ___ / /____ _____(_)_ ____ _
   / / / _ \/ -_) / ___/ / _ `/ _ \/ -_) __/ _ `/ __/ / // /  ' \
  /_/ /_//_/\__/ /_/  /_/\_,_/_//_/\__/\__/\_,_/_/ /_/\_,_/_/_/_/

  An (HTML5 + CSS3 + SVG) x JS experiment

  Created by Little Workshop http://www.littleworkshop.fr

  * Libraries used : jQuery, Raphaël, RequireJS
  * Go check out the source on GitHub at : http://github.com/[insert repo URL]
  * Supported in Firefox 4, Chrome, Safari
-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no,maximum-scale=1.0,minimum-scale=1.0,">
	<link rel="stylesheet" href="css/style.css" type="text/css" charset="utf-8">

	<title><?php echo $lang['PAGE_TITLE']; ?></title>

	<link href="css/ribbons.css" rel="stylesheet" type="text/css" />

<div class="ribbon right black">
  <a href="https://github.com/cedhuf/planetarium/"><?php echo $lang['FORK_GITHUB']; ?></a>
</div>

</head>
<body class="system">
	<div id="starfield">
	</div>

	<img id="glow" src="img/glow.png">

	<div id="title">
		<h1 class="franchise"><span class="marketing">The </span> Planetarium</h1>
		<span id="subtitle" class="carto">An Astronomical Adventure !</span>
	</div>

	<div id="instructions" class="carto">
		<a href="planet.php?lang=fr">FR</a>---
		<a href="planet.php?lang=en">EN</a>
	</div>

	<div id="toggle-credits" class="loading">
		<span class="marketing">Credits</span>
	</div>

	<div id="counters"></div>


</body>
</html>
