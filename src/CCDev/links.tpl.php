<h1>The Developer Controller</h1>
<p>This is what you can do for now:</p>
<ul>
<?php foreach($menu as $text => $link):?>
	<li><a href="<?=$link?>"><?=$text?></a></li>
<?php endforeach;?>
</ul>
<h2>CRequest::CreateUrl()</h2>
<p>Here is a list of urls created using above method with various settings. All links should lead to this same page.</p>
<ul>
	<?php foreach($urls as $text => $link):?>
		<li><a href="<?=$link?>"><?=$text?></a></li>
	<?php endforeach;?>
</ul>
<p>Enables various and flexible url-strategy.</p>