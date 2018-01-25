<?php

// by iShot (https://github.com/iShotFT/)
// Procedural example of using PHP to fetch from a public or private API.

// Push the directory separator (\ or / depending on OS) into a small variable (is better on the eyes)
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

// Define the options you use to call the api
$api_base_url = 'https://cryptopanic.com/api/posts/';
$api_get_options = array(
    "auth_token" => "-INSERT API KEY HERE-",
    "currencies" => "BTC"
);

// Pull the data from the webpage;
// http_build_query = http://php.net/http_build_query
// file_get_contents = http://php.net/manual/en/function.file-get-contents.php
// Allows us to easily merge the keys and the values of the array declared above
$encoded_json_output = file_get_contents($api_base_url . '?' . http_build_query($api_get_options,"","&"));

// Decode the returned json data with the built in PHP function
// json_decode = http://php.net/manual/en/function.json-decode.php
// We use the value TRUE as second parameter to turn it into a proper array
$decoded_json = json_decode($encoded_json_output, true);

// Show some basic info about the array
echo "Amount of items: " . count($decoded_json['results']) . "<br/>\r\n";
echo "<br/>\r\n";

// Loop through the decoded json (which is now an assoc array)
foreach ($decoded_json['results'] as $result) {
    // You can make a table, divs, whatever to display. As an example I'm just going to output a few basic items in the API.
    echo "<h3><a href=\"http://" . $result['source']['domain'] . "\">" . $result['source']['title'] . "</a></h3>\r\n";
    echo "Title: " . $result['title'] . "<br/>\r\n";
    echo "Link: <a href=\"" . $result['url'] . "\">Click</a><br/>\r\n";
    echo "<br/><br/>\r\n";
}
