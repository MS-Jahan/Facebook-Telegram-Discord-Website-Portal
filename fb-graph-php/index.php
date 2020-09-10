<?php 
require_once __DIR__ . '/vendor/autoload.php'; // change path as needed

$fb = new \Facebook\Facebook([
  'app_id' => '723205745146580',
  'app_secret' => 'f8a041cf8b0652912dd8ce7b08c11a9a',
  'default_graph_version' => 'v2.10',
  //'default_access_token' => '{access-token}', // optional
]);

try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get(
    '/325284454289807',
    '723205745146580|a2U0zFFCuMHqFuQrBIbaTfdRf8M'
  );
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
$graphNode = $response->getGraphNode();

echo $graphnode;