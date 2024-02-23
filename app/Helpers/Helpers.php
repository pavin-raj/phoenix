<?php

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

