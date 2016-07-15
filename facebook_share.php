<?php

    include_once('include/config.php');
    require_once('class/facebook.php');

    $config['appId']     = FACEBOOK_APP_ID;
    $config['appSecret'] = FACEBOOK_APP_SECRET;
    $config['returnUrl'] = FACEBOOK_RETURN_URL;

	$facebook    = new Facebook( $config ); 

    $accessToken = "";
    if($accessToken == "" )
        $accessToken = $this->facebook->getAccessToken();

    if ($accessToken) {
        $message              = "What to share"; // message to share
        $link                 = "link to be share"; // sharing link
        $picture              = "picture url to be share";	// picture url to be share
        $post_id = $this->facebook->sharePost( $accessToken, $link, $message, $picture );
    } else {
        redirect($this->facebook->loginUrl());
    }
    // end code to push listing on facebook //     
?>