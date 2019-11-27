<?php
$FRAS3S = $con->query("SELECT * FROM frases");
$TOTAL_FRASES = mysqli_num_rows($FRAS3S);

$FRASOS = $con->query("SELECT * FROM frases WHERE publicada = 0");
$FRASES_EN_COLA = mysqli_num_rows($FRASOS);
//
require_once('twitteroauth.php');

$consumerKey = 'l3o04CbpPqeIuNHnjXpDJhWe0';
$consumerSecret = '7o3SwLIQuFf8Q6QpFAjJOjorDuKX6JCx5Ucffr1LA2SbYlzqWS';
$oAuthToken     = '1155993504419631104-HnfJmeQs9RWZW6kNHyGUjYT4vdOZfb';
$oAuthSecret    = 'XUATR1Ex78hMc0rcZv4gx3WWPaFXtizgipk0HKmhfywhs';
//$tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);
$tw_username = 'fumoporrobot'; 
//------------Contar seguidores, y demás---------//

$tweetConnect = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);


$user = $tweetConnect->get("https://api.twitter.com/1.1/users/show.json?screen_name=".$tw_username);
$info = json_decode($user);
$fumoporro_following = intval($info->friends_count);
$fumoporro_followers = intval($info->followers_count);
$fumoporro_tweets = intval($info->statuses_count); 

//echo $followers_count;
$data = file_get_contents('https://cdn.syndication.twimg.com/widgets/followbutton/info.json?screen_names='.$tw_username); 
$parsed =  json_decode($data,true);
$seguidores_fumoporro =  $parsed[0]['followers_count'];
$tweets_fumoporro = $parsed[0]['statuses_count'];


function mostrarFrase($ID, $row){
$FRAS3S = $con->query("SELECT * FROM frases WHERE ID='$ID'");
$FRASES = $FRAS3S->fetch_row();
return $FRASES[$row];
}
?>