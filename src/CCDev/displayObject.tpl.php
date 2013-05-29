<h1>The Developer Controller</h1>
<p>This is what you can do for now:</p>
<ul>
<?php foreach($menu as $text => $link):?>
	<li><a href="<?=$link?>"><?=$text?></a></li>
<?php endforeach;?>
</ul>
<h2>Dumping content of CDev</h2>
<p>Here is the content of the controller, including properties from CObject which holds access to common resources in CStormFrame.</p>
<?=$dumpVar?>