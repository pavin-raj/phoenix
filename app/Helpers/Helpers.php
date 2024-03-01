<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

// Generate Random IP Addresses
function generateRandomIPAddress() {
  // Exclude private and reserved ranges
  $privateRanges = ['10.0.0.0/8', '172.16.0.0/12', '192.168.0.0/16'];
  $reservedRanges = ['0.0.0.0/8', '9.0.0.0/8', '127.0.0.0/8'];

  // Generate random octets for each part
  $octet1 = rand(1, 244); // Exclude first and last octets of private ranges
  $octet2 = rand(0, 255);
  $octet3 = rand(0, 255);
  $octet4 = rand(0, 255);

  // Assemble and validate the IP address
  $ipAddress = $octet1 . "." . $octet2 . "." . $octet3 . "." . $octet4;

  // Ensure it's not in a private or reserved range
  if (in_array(long2ip(ip2long($ipAddress)), $privateRanges) || in_array(long2ip(ip2long($ipAddress)), $reservedRanges)) {
    return generateRandomIPAddress(); // Try again if invalid
  }

  return $ipAddress;
}


// Cookie Functions


// Get Cookies
function getTaskCookie(){
  // Get cookie and convert it into array
  $json = Cookie::get('task_id');
  $array = json_decode($json);
  
  // $array must be of type countable|array, not null
  $array = isset($array) ? $array : [];
  return $array;
}

// Store a new cookie
function storeTaskCookie($taskId){
  $array = getTaskCookie();
  // If values are in array, append else create 
  $array = isset($array) ? array_merge($array, [$taskId]) : [$taskId];
  echo count($array) . "<br>";
  echo implode(' ',$array);
  $json = json_encode($array);
  Cookie::queue(cookie::make('task_id', $json, 10080));
}

