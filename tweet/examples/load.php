<?php

require_once '../src/twitter.class.php';

// enables caching (path must exists and must be writable!)
// Twitter::$cacheDir = dirname(__FILE__) . '/temp';


// ENTER HERE YOUR CREDENTIALS (see readme.txt)

$consumerKey = 'T3JcfusWig6yugZjzNdT3Oq2N'; 
$consumerSecret = 'gqr6ThMJbFMkkMQjKZZYMEdCG64dlhjj9P2RJuR1fNDu6ERwmn'; 
$accessToken = '3023098453-71wHm8DbRGs2OfccVXKQrcNOOSqxnNPHJpkJUkW'; 
$accessTokenSecret = 'Dnzp0qexdQiAQpUxG6GgxseLnrcQQJ4Vwx1FIvePCyjQu';

$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

$statuses = $twitter->load(Twitter::ME);

?>
<!doctype html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Twitter timeline demo</title>

<ul>
<?php foreach ($statuses as $status): ?>
	<li><a href="http://twitter.com/<?php echo $status->user->screen_name ?>"><img src="<?php echo htmlspecialchars($status->user->profile_image_url) ?>">
		<?php echo htmlspecialchars($status->user->name) ?></a>:
		<?php echo Twitter::clickable($status) ?>
		<small>at <?php echo date("j.n.Y H:i", strtotime($status->created_at)) ?></small>
	</li>
<?php endforeach ?>
</ul>
