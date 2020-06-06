<?php
$at = '';
$subredits = array('data' => array());
if(isset($_GET['access_token'])){
	$at = $_GET['access_token'];
	
	if(!file_exists('recommended_broadcaster_prompts')){
		exec("curl -O -H 'authorization: Bearer $at' 'https://strapi.reddit.com/recommended_broadcaster_prompts'");
	}
}


if(file_exists('recommended_broadcaster_prompts')){
	$subredits = json_decode(file_get_contents('recommended_broadcaster_prompts'), true);
}

if(isset($_POST['title'])){
	
	echo("Starting stream:\n");
	$strem_data = '';
	exec("curl -d 'title=".$_POST['title']."' -H 'user-agent: Reddit/2020.16.0 (iPhone; iOS 13.3.1; Scale/2.00)' -H 'authorization: Bearer ".$at."' 'https://strapi.reddit.com/r/".$_POST['subredit']."/broadcasts'", $strem_data);
	$strem_data = implode("\n", $strem_data);
	$strem_data = json_decode($strem_data, true);
	echo("<p>server: rtmp://ingest.redd.it/inbound</p>\n");
	echo("<p>stream key: ".$strem_data['data']['streamer_key']."</p>\n");
	echo("<p>url: ".$strem_data['data']['post']['url']."</p>\n");
	exec('open '.escapeshellarg($strem_data['data']['post']['url']));
	passthru("killall php");

}
?>
<html>
<body>
<div id="result">
</div>
<script>
if(document.location.hash == ""){
	document.location.href = 'https://www.reddit.com/api/v1/authorize?client_id=ohXpoqrZYub1kg&response_type=token&redirect_uri=http://localhost:65010/callback&scope=*&state=SNOOKEY';
}else if(document.location.search == ""){
	document.location.search = document.location.hash.substr(1);
}else{
	document.getElementById('result').innerHTML = '';
	//document.getElementById('result').innerHTML = document.location.search;
}
</script>
<form method="post">
	<select name="subredit">
<?php	foreach($subredits['data'] AS $subredt): ?>
		<option value="<?= $subredt['subreddit_name'] ?>"><?= $subredt['subreddit_name'] ?></option>
<?php	endforeach; ?>
	</select>
	<input type="text" name="title">
	<input value="start stream" type="submit">
</form>
</body>
</html>
