<?php

class HashTagRequestor
{

  private $accessToken;
  private $accessTokenSecret;
  private $consumerKey;
  private $consumerSecret;
  private $url = 'https://api.twitter.com/1.1/search/tweets.json';

  protected $oauth;

  public function __construct($accessToken, $accessTokenSecret, $consumerKey, $consumerSecret)
  {
    if(!in_array('curl', get_loaded_extensions()))
    {
      throw new Exception('You need to install cURL');
    }

    if(!$accessToken || !$accessTokenSecret || !$consumerKey || !$consumerSecret)
    {
      throw new Exception('Incorrect params');
    }

    $this->accessToken = $accessToken;
    $this->accessTokenSecret = $accessTokenSecret;
    $this->consumerKey = $consumerKey;
    $this->consumerSecret = $consumerSecret;
  }

  public function buildOauth($search)
  {

    if(!$search)
    {
      throw new Exception('You must specify a search param');
    }

    $accessToken = $this->accessToken;
    $accessTokenSecret = $this->accessTokenSecret;
    $consumerKey = $this->consumerKey;
    $consumerSecret = $this->consumerSecret;

    $search = '%23' . $search;

    $oauth = [
      'oauth_consumer_key' => $consumerKey,
      'oauth_nonce' => time(),
      'oauth_signature_method' => 'HMAC-SHA1',
      'oauth_token' => $accessToken,
      'oauth_timestamp' => time(),
      'oauth_version' => '1.0',
      'q' => $search
      ];

      $baseInfo = $this->buildBaseString($this->url, $oauth);
      $compositeKey = rawurlencode($consumerSecret) . '&' . rawurlencode($accessTokenSecret);
      $oauthSignature = base64_encode(hash_hmac('sha1', $baseInfo, $compositeKey, true));
      $oauth['oauth_signature'] = $oauthSignature;

      $this->search = $search;
      $this->oauth = $oauth;

      return $this;
    }

    public function request()
    {

      $header = array($this->buildAuthorizationHeader($this->oauth), 'Expect:');

      $options = [
        CURLOPT_HTTPHEADER => $header,
        CURLOPT_HEADER => false,
        CURLOPT_URL => $this->url . '?q=' . $this->search,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 10,
      ];

      $feed = curl_init();
      curl_setopt_array($feed, $options);
      $json = curl_exec($feed);
      curl_close($feed);

      return $json;
    }

    private function buildBaseString($baseURI, $params)
    {
      $return = array();
      ksort($params);

      foreach($params as $key=>$value)
      {
        $return[] = "$key=" . $value;
      }

      return "GET&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $return));
    }

    private function buildAuthorizationHeader($oauth)
    {
      $return = 'Authorization: OAuth ';
      $values = array();

      foreach($oauth as $key => $value)
      {
        $values[] = "$key=\"" . rawurlencode($value) . "\"";
      }

      $return .= implode(', ', $values);
      return $return;
    }

  }
