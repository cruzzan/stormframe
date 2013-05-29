<!DOCTYPE html>
<html lang="sv"> 
    <head>
        <meta charset="ISO-8859-1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?=$title?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="themes/core/normalize.css">
        <link rel="stylesheet" href="<?=$stylesheet?>">
    </head>
    <body>
		<div id="header">
			<?=$header?>
		</div>
		<div id="main" role="main">
			<?=@$main?>
			<?=render_views()?>
		</div>
		<div id="footer">
			<?=$footer?>
		</div>
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            var _gaq=[['_setAccount','<?=$googleSiteID?>'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src='//www.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>