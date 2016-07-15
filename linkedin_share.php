<?php

    include_once('include/config.php');
    require_once('class/linkedin.php');

    $config = array(
        'client_id'     => LINKEDIN_APP_KEY,
        'client_secret' => LINKEDIN_SECRET_KEY,
        'access_token'  => LINKEDIN_ACCESS_TOKEN,
        'redirect_url'  => LINKEDIN_CALLBACK_URL
    );

    $linkedin = new LINKEDIN( $config );

    if (isset($_GET['code'])) {
        $code        = $_GET['code'];
        $accessToken = $this->linkedin->getAccessToken($code);
    } else if (isset($_GET['error'])) {
        echo $_GET['error'];
    }

    if (!$accessToken) {
        $this->linkedin->login();
        exit;
    } else {
        $message = "";
        $link    = "";
        $picture = "";
        $post_id = $this->linkedin->sharePost("", "", $message, $link, $picture);
    }
?>