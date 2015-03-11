<?php
/**
 * @file
 * User has successfully authenticated with Twitter. Access tokens saved to session and DB.
 */

/* Load required lib files. */
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

/* If access tokens are not available redirect to connect page. */
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
    header('Location: ./clearsessions.php');
}
/* Get user access tokens out of the session. */
$access_token = $_SESSION['access_token'];

/* Create a TwitterOauth object with consumer/user tokens. */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

/* If method is set change API call made. Test is called by default. */
//$content = $connection->get('account/verify_credentials');


/* Some example calls */
//$connection->get('users/show', array('screen_name' => 'abraham'));
//$content =$connection->post('statuses/update', array('status' => date(DATE_RFC822)));
//$content =$connection->post('statuses/update', array('status' => 'Commited code for hi51.'));
//$connection->post('statuses/destroy', array('id' => 5437877770));
//$connection->post('friendships/create', array('id' => 9436992));
//$connection->post('friendships/destroy', array('id' => 9436992));


function curl_call($Url, $authtoken){ 
    $ch = curl_init();
 
    curl_setopt($ch, CURLOPT_URL, $Url);
 
    curl_setopt($ch, CURLOPT_REFERER, "-");
    curl_setopt($ch, CURLOPT_USERAGENT, "MozillaHi5/1.0");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: token '. $authtoken));
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $output = curl_exec($ch);
print_r($output);
print_r(curl_error($ch));
    curl_close($ch);
    return $output;
}

define('GITHUB_API', 'https://api.github.com');
$AUTH_TOKEN = 'YOUR_AUTH_TOKEN_HERE';
$USER_NAME = 'YOUR_USER_NAME_HERE';


// get comments for this user
//https://api.github.com/user/repos
$result = curl_call(GITHUB_API."/user/repos", $AUTH_TOKEN);
$res = @json_decode($result);
if( !empty( $res ) ) {
    foreach( $res as $item ) {
        $repos[$item->id] = array(
            'name' => $item->name,
            'full_name' => $item->full_name,
            'comments_url_api' => str_replace("{/number}", "", $item->comments_url)
        );
        
    }
}

if(!empty($repos)) {
    foreach($repos as $key => $item) {
        $result = curl_call( $item['comments_url_api'], $AUTH_TOKEN );
        $res = @json_decode($result);
        if(!empty($res)) {
            foreach($res as $item) {
                $repos[$key]['comments']['id'] = $item->body;
            }
        }
    }
}

print_r($repos);



/* Include HTML to display on the page */
include('html.inc');
