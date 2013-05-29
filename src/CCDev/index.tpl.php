<h1>The Developer Controller</h1>
<p>This is what you can do for now:</p>
<ul>
<?php foreach($menu as $text => $link):?>
	<li><a href="<?=$link?>"><?=$text?></a></li>
<?php endforeach;?>
</ul>