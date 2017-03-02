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
	We use the work of https://github.com/petethepig/github-ribbons-css Copyright (C) 2012 Dmitry Filimonov for the fork me ribbon.
-->

<?php
session_start();
header('Cache-control: private'); // IE 6 FIX
if(isSet($_GET['lang']))
{
$lang = $_GET['lang'];
// register the session and set the cookie
$_SESSION['lang'] = $lang;
setcookie('lang', $lang, time() + (3600 * 24 * 30));
}
else if(isSet($_SESSION['lang']))
{
$lang = $_SESSION['lang'];
}
else if(isSet($_COOKIE['lang']))
{
$lang = $_COOKIE['lang'];
}
else
{
$lang = 'fr';
}
switch ($lang) {
case 'en':
$lang_file = 'lang.en.php';
break;
case 'fr':
$lang_file = 'lang.fr.php';
break;
default:
$lang_file = 'lang.fr.php';
}
include_once 'languages/'.$lang_file;
?>

<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no,maximum-scale=1.0,minimum-scale=1.0,">

	<link rel="stylesheet" href="css/tooltip.css" type="text/css" charset="utf-8">
	<link rel="stylesheet" href="css/style.css" type="text/css" charset="utf-8">
	<style>
		.hidden { display:none; }
		#spinner {position:absolute;left:50%;top:50%;margin-left:-25px;margin-top:-25px;height:50px;width:50px;background:url('img/spinner.gif') no-repeat;}
	</style>
	<title><?php echo $lang['PAGE_TITLE']; ?></title>

	<link href="css/ribbons.css" rel="stylesheet" type="text/css" />

<div class="ribbon right black">
  <a href="https://github.com/cedhuf/planetarium/"><?php echo $lang['FORK_GITHUB']; ?></a>
</div>

</head>
<body class="system">
	<div id="starfield">
	</div>

	<div id="spinner"></div>

	<img id="glow" src="img/glow.png">

	<div id="title">
		<h1 class="franchise"><span class="marketing"><?php echo $lang['HOME_TITLE']; ?></h1>
		<span id="subtitle" class="carto"><?php echo $lang['HOME_SUBTITLE']; ?></span>
	</div>

	<div id="instructions" class="carto loading">
		<?php echo $lang['HOME_START_TEXT']; ?>
	</div>

	<div id="toggle-credits" class="loading">
		<span class="marketing">Credits</span>
	</div>

	<section id="credits">
		<span id="madeby" class="carto">Made on Earth by <a href="http://www.littleworkshop.fr/" target="_blank" title="Visit Little Workshop">Little Workshop</a></span>
		<div id="door">
			<div></div>
			<div></div>
		</div>
		<div id="doorlight">
			<div></div>
			<div></div>
		</div>
		<div id="authors">
			<p id="guillaume">
				<span class="marketing">design by</span>
				<span class="bebas">Guillaume Lecollinet</span>
				<span class="carto"><a target="_blank" href="http://twitter.com/glecollinet/" title="follow Guillaume on Twitter">@glecollinet</a></span>
			</p>
			<p id="franck">
				<span class="marketing">code by</span>
				<span class="bebas">Franck Lecollinet</span>
				<span class="carto"><a target="_blank" href="http://twitter.com/whatthefranck/" title="follow Franck on Twitter">@whatthefranck</a></span>
			</p>
		</div>
		<section id="typefaces">
			<header>
				<span class="separator"></span>
				<span id="title-hr" class="marketing">typefaces</span>
				<span class="separator"></span>
			</header>
			<ul>
				<li class="carto">Marketing Script <br/><span>by</span> <a href="http://www.steffmann.de/" target="_blank" title="Dieter Steffmann">Dieter Steffmann</a></li>
				<li class="carto">Franchise <br/><span>by</span> <a href="http://www.derekweathersbee.com/" target="_blank" title="Derek Weathersbee">Derek Weathersbee</a></li>
				<li class="carto">Bebas <br/><span>by</span> <a href="http://dharmatype.com/flat-it" target="_blank" title="Flat-it Type Foundry">Flat-it</a></li>
				<li class="carto">CartoGothic Std <br/><span>by</span> <a href="http://www.fontsite.com/" target="_blank" title="FontSite Inc.">FontSite Inc.</a></li>
			</ul>
		</section>
	</section>

	<ul id="planets" class="loading">
		<li id="mercury" class="planet"></li>
		<li id="venus" class="planet"></li>
		<li id="earth" class="planet"></li>
		<li id="mars" class="planet"></li>
		<li id="jupiter" class="planet"></li>
		<li id="saturn" class="planet"></li>
		<li id="uranus" class="planet"></li>
		<li id="neptune" class="planet"></li>
	</ul>

	<div id="gui" class="shrink">
		<div id="container"></div>

		<div id="ruler">
		</div>

		<div id="counter">
			<span class="carto"><?php echo $lang['COUNTER_SUN']; ?></span><br />
			<span id="kilometers" class="bebas"></span>
		</div>

		<div id="back">
			<span class="carto"><?php echo $lang['NAV_BACK']; ?></span>
		</div>

		<div id="moveleft">
			<div id="previous">
				<img src="img/previous.svg" alt="<?php echo $lang['NAV_PREVIOUS_PLANET']; ?>">
			</div>
		</div>

		<div id="moveright">
			<div id="next">
				<img src="img/previous.svg" alt="<?php echo $lang['NAV_NEXT_PLANET']; ?>">
			</div>
		</div>

		<section class="content hidden" id="mercury-info">
			<article id="mercury-window" class="window">
				<div class="reflect">
					<h1 class="bebas">
						<?php echo $lang['PLANET_MERCURY_NAME']; ?>
					</h1>
					<p class="carto"><?php echo $lang['PLANET_MERCURY_ABOUT']; ?></p>
				</div>
			</article>
			<div id="mercury-missions">
				<h2 class="bebas"><?php echo $lang['PLANET_MERCURY_OBSERVATION']; ?></h2>
				<ul>
					<li><img src="img/mercuryobs1.png" alt=""></li>
					<li><img src="img/mercuryobs2.png" alt=""></li>
					<li><img src="img/mercuryobs3.png" alt=""></li>
				</ul>
				<img id="mariner10" src="img/mariner10.png" alt="">
				<img id="techarrow" src="img/30years.png" alt="">
				<img id="messenger" src="img/messenger.png" alt="">
			</div>
		</section>

		<section class="content hidden" id="venus-info">
			<article id="venus-window" class="window">
				<div class="reflect">
					<h1 class="bebas">
						<?php echo $lang['PLANET_VENUS_NAME']; ?>
					</h1>
					<p><?php echo $lang['PLANET_VENUS_ABOUT']; ?></p>
				</div>
			</article>
			<ul id="venus-atmosphere" class="bebas">
				<li>65 KM
					<span>-100°C</span>
					<span><?php echo $lang['PLANET_VENUS_CLOUD']; ?></span>
				</li>
				<li>50 KM
					<span>0°C</span>
					<span><?php echo $lang['PLANET_VENUS_HAZE']; ?></span>
				</li>
				<li>38 KM
					<span>25°C</span>
					<span><?php echo $lang['PLANET_VENUS_TROPO']; ?></span>
				</li>
				<li>0 KM
					<span>467°C</span>
					<span><?php echo $lang['PLANET_VENUS_LEVEL']; ?></span>
				</li>
			</ul>
		</section>

		<section class="content hidden" id="earth-info">
			<article id="earth-window" class="window">
				<div class="reflect">
					<h1 class="bebas">
						<?php echo $lang['PLANET_EARTH_NAME']; ?>
					</h1>
					<p><?php echo $lang['PLANET_EARTH_ABOUT']; ?></p>
				</div>
			</article>
			<div id="earth-moon" class="grid moon">
				<img id="distance" src="img/distance.png" alt="">
			</div>
			<ul id="earth-facts" class="properties bebas">
				<li class="mass">
					<img src="img/mass.svg" alt="mass">
					5.9736 <small>x</small> 10<span class="exposant">24</span> kg
					<span><?php echo $lang['PLANET_EARTH_MASS']; ?></span>
				</li>
				<li class="perimeter">
					<img src="img/perimeter.svg" alt="perimeter">
					40,075,016 km
					<span><?php echo $lang['PLANET_EARTH_CIRCUMFERENCE']; ?></span>
				</li>
				<li class="revolution">
					<img src="img/revolution.svg" alt="revolution">
					365 <?php echo $lang['PLANET_EARTH_DAYS']; ?>
					<span><?php echo $lang['PLANET_EARTH_ORB_PERIOD']; ?></span>
				</li>
				<li class="temperature">
					<img src="img/temperature.svg" alt="temperature">
					-89.2&deg;C to 57.8&deg;C
					<span><?php echo $lang['PLANET_EARTH_TEMP']; ?></span>
				</li>
			</ul>
		</section>

		<section class="content hidden" id="mars-info">
			<article id="mars-window" class="window">
				<div class="reflect">
					<h1 class="bebas">
						<?php echo $lang['PLANET_MARS_NAME']; ?>
					</h1>
					<p><?php echo $lang['PLANET_MARS_ABOUT']; ?></p>
				</div>
			</article>
			<ul id="volcanoes" class="bebas">
				<li><?php echo $lang['PLANET_MARS_OLYMPUS']; ?><span>27,000 M</span><hr /></li>
				<li><?php echo $lang['PLANET_MARS_EVEREST']; ?><span>8,848 M</span><hr /></li>
				<li><?php echo $lang['PLANET_MARS_FUJI']; ?><span>3,776 M</span><hr /></li>
			</ul>
		</section>

		<section class="content hidden" id="jupiter-info">
			<article id="jupiter-window" class="window">
				<div class="reflect">
					<h1 class="bebas">
						<?php echo $lang['PLANET_JUPITER_NAME']; ?>
					</h1>
					<p><?php echo $lang['PLANET_JUPITER_ABOUT']; ?></p>
				</div>
			</article>
			<ul id="jupiter-moons" class="properties bebas">
				<li><img src="img/iopicto.png" alt="">
					IO
					<span><?php echo $lang['PLANET_JUPITER_IO']; ?></span>
				</li>
				<li><img src="img/europapicto.png" alt="">
					EUROPA
					<span><?php echo $lang['PLANET_JUPITER_EUROPA']; ?></span>
				</li>
				<li><img src="img/ganymedepicto.png" alt="">
					GANYMEDE
					<span><?php echo $lang['PLANET_JUPITER_GANYMEDE']; ?></span>
				</li>
				<li><img src="img/callistopicto.png" alt="">
					CALLISTO
					<span><?php echo $lang['PLANET_JUPITER_CALLISTO']; ?></span>
				</li>
			</ul>
			<div id="galilean-moons" class="grid bebas"></div>
		</section>

		<section class="content hidden" id="saturn-info">
			<article id="saturn-window" class="window">
				<div class="reflect">
					<h1 class="bebas">
						<?php echo $lang['PLANET_SATURN_NAME']; ?>
					</h1>
					<p><?php echo $lang['PLANET_SATURN_ABOUT']; ?></p>
				</div>
			</article>
			<div id="rings-origin">
				<h2 class="bebas"><?php echo $lang['PLANET_SATURN_RINGS_TITLE']; ?></h2>
				<p class="carto"><?php echo $lang['PLANET_SATURN_RINGS']; ?></p>
				<ul id="arrows" class="bebas">
					<li><span>1</span>
						<img class="saturnarrow" src="img/saturn-arrow1.png" alt="">
						<img class="rings" src="img/rings1.png" alt="">
						</li>
					<li><span>2</span>
						<img class="saturnarrow" src="img/saturn-arrow2.png" alt="">
						<img class="rings" src="img/rings2.png" alt="">
						</li>
					<li><span>3</span>
						<img class="saturnarrow" src="img/saturn-arrow3.png" alt="">
						<img class="rings" src="img/rings3.png" alt="">
						</li>
				</ul>
			</div>
		</section>

		<section class="content hidden" id="uranus-info">
			<article id="uranus-window" class="window">
				<div class="reflect">
					<h1 class="bebas">
						<?php echo $lang['PLANET_URANUS_NAME']; ?>
					</h1>
					<p><?php echo $lang['PLANET_URANUS_ABOUT']; ?></p>
				</div>
			</article>
			<div id="axial-tilt" class="grid">
				<h2 class="bebas"><?php echo $lang['PLANET_URANUS_TILT']; ?></h2>
				<img src="img/tilt.png" alt="">
				<span class="bebas">98°</span>
			</div>
			<div id="uranus-atmosphere">
				<h2 class="bebas"><?php echo $lang['PLANET_URANUS_ATMOSPHERE']; ?></h2>
				<div id="hydrogen">
					<div></div>
					<div></div>
					<div></div>
					<span class="bebas">85.3%<br />
						<?php echo $lang['PLANET_URANUS_HYDROGEN']; ?>
					</span>
				</div>
				<div id="helium">
					<div></div>
					<div></div>
					<div></div>
					<span class="bebas">15.3%<br />
						<?php echo $lang['PLANET_URANUS_HELIUM']; ?>
					</span>
				</div>
				<div id="methane">
					<div></div>
					<div></div>
					<div></div>
					<span class="bebas">2.3%<br />
						<?php echo $lang['PLANET_URANUS_METHANE']; ?>
					</span>
				</div>
				<div id="deuteride">
					<div></div>
					<div></div>
					<div></div>
					<span class="bebas">0.01%<br />
						<?php echo $lang['PLANET_URANUS_HYDRO_DEUT']; ?>
					</span>
				</div>
			</div>
		</section>

		<section class="content hidden" id="neptune-info">
			<article id="neptune-window" class="window">
				<div class="reflect">
					<h1 class="bebas">
						<?php echo $lang['PLANET_NEPTUNE_NAME']; ?>
					</h1>
					<p><?php echo $lang['PLANET_NEPTUNE_ABOUT']; ?></p>
				</div>
			</article>
			<ul id="neptune-facts" class="bebas">
				<li><img src="img/wind.png" alt="">
					2100 <span>km/h</span>
					<br />
					<span class="carto"><?php echo $lang['PLANET_NEPTUNE_WIND']; ?></span>
				</li>
				<li><img src="img/satellite.png" alt="">
					13 <span><?php echo $lang['PLANET_NEPTUNE_SATS']; ?></span>
					<br />
					<span class="carto"><?php echo $lang['PLANET_NEPTUNE_STATS2']; ?></span>
				</li>
				<li><img src="img/time.png" alt="">
					164 <span><?php echo $lang['PLANET_NEPTUNE_EARTH']; ?></span>
					<br />
					<span class="carto"><?php echo $lang['PLANET_NEPTUNE_REVO']; ?></span>
				</li>
			</ul>
			<div id="flyby">
				<img src="img/earthicon.png" alt="">
				<img src="img/246min.png" alt="">
				<img id="voyager2" src="img/voyager2.png" alt="Voyager 2">
			</div>
		</section>
	</div>

	<div id="counters"></div>

	<script data-main="main" src="js/require-jquery-1.4.4.min.js"></script>
</body>
</html>
