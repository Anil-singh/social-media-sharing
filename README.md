## Social Media Sharing 
        Sharing of site contents on social meadia Facebook,Linkedin,Twitter

### Share on Facebook
    $facebook    = new Facebook( $config ); 

    $accessToken = "";
    if($accessToken == "" )
        $accessToken = $this->facebook->getAccessToken();

    if ($accessToken) {
        $message              = "What to share"; // message to share
        $link                 = "link to be share"; // sharing link
        $picture              = "picture url to be share";  // picture url to be share
        $post_id = $this->facebook->sharePost( $accessToken, $link, $message, $picture );
    } else {
        redirect($this->facebook->loginUrl());
    }

### Share on Twitter
    $config = array(
        'consumerKey' => TWITTER_CONSUMER_KEY,
        'consumerSecret' => TWITTER_CONSUMER_SECRET,
        'oauthToken' => TWITTER_ACCESS_TOKEN,
        'oauthTokenSecret' => TWITTER_ACCESS_SECRET
    );

    $message              = "What to share"; // message to share max 140 characters.
    $link                 = "link to be share"; // sharing link
    $picture              = "picture url to be share";  // picture url to be share

    $twitter = new Twitter( $config );
    $post_id = $twitter->postStatusesUpdateWithMedia($picture, $link, $message);
### Share on Linkedin

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


### Dependecies
        PHP 5.5

### Social Media configurations - include/config.php
    Create an app on social media using developer account and replace following config contants
    /* Facebook */
    define( 'FACEBOOK_APP_ID', '');
    define( 'FACEBOOK_APP_SECRET', '');
    define( 'FACEBOOK_RETURN_URL', '');
    /* Linkedin */
    define( 'LINKEDIN_APP_KEY', '' );
    define( 'LINKEDIN_SECRET_KEY', '');
    define( 'LINKEDIN_ACCESS_TOKEN', '');
    define( 'LINKEDIN_CALLBACK_URL', '');
    /* Twitter */
    define( 'TWITTER_CONSUMER_KEY', "" );
    define( 'TWITTER_CONSUMER_SECRET', "");
    define( 'TWITTER_ACCESS_TOKEN', "");
    define( 'TWITTER_ACCESS_SECRET', "");

## API Reference
    1. Facebook PHP sdk from Facebook.
    2. Twitter PHP sdk from Twitter.


