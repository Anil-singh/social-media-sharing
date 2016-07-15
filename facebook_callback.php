// start code to push on facebook // 
    if ($media == 'facebook') {
        $accessToken          = "";
        $longLivedAccessToken = $_SESSION['facebook_access_token'];
        $tokenVailidity       = false;
        if ($longLivedAccessToken) {
            $accessToken = $this->facebook->checkTokenValidity($longLivedAccessToken);
        }
        if (!$accessToken) {
            $this->session->set_userdata('back_url', $back_url);
            $this->session->set_userdata('link', $link);
            $this->session->set_userdata('picture', $picture);
            $this->session->set_userdata('message', $message);
            redirect($this->facebook->loginUrl());
        } else {
            $post_id = $this->facebook->sharePost( $accessToken, $link, $message, $picture );
        }
    }
    // end code to push listing on facebook //

    

    // start code to push listing on twitter //      
    if ($media == 'twitter') {
        $config = array(
            'consumerKey' => $this->session->userdata('twitter_consumer_key'),
            'consumerSecret' => $this->session->userdata('twitter_consumer_secret'),
            'oauthToken' => $this->session->userdata('twitter_access_token'),
            'oauthTokenSecret' => $this->session->userdata('twitter_access_secret')
        );
        $this->load->library('twitter', $config);
        $post_id = $this->twitter->postStatusesUpdateWithMedia($picture, $link, $message);
    }
    // end code to push listing on twitter //

    if ($post_id) {
        $this->session->set_flashdata('success_message', "Property Posted successfully on $media");
        $this->session->set_flashdata('check', "$media");
    } else {
        $this->session->set_flashdata('error_message', "Property not posted successfully on $media");
        $this->session->set_flashdata('check', "$media");
    }
    redirect(base_url() . "index.php/listings/socialMedia/" . $mlsId . "/" . $propertyType);
    exit;