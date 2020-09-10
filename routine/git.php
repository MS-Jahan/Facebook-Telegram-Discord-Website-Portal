<?php
$fileContent = file_get_contents("routine.txt");

//echo(gettype($fileContent));
//echo(sha1($fileContent));

$shad = file_get_contents("sha_ttt.txt");
                        
$data = '{
  "message": "routine add",
  "sha" : "'.$shad.'",
  "committer": {
    "name": "Prodipto27FromApi",
    "email": "ist27thbatch@gmail.com"
  },
  "content": "'.base64_encode($fileContent).'"
}';

$token = "6598d6a4f67d20070b11ed36e0f15f09489d4748";

$url = "https://api.github.com/repos/prodipto27/prodipto27.github.io/contents/routine.txt";

$username = "prodipto27";

$curl_url = $url;
$curl_token_auth = 'Authorization: token ' . $token;
$ch = curl_init($curl_url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'User-Agent: $username', $curl_token_auth ));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

$response = curl_exec($ch);
$arr = json_decode($response);
file_put_contents("sha_ttt.txt", $arr->content->sha);
//return $response;

echo($response);


?>