<?php
// The string is a hexadecimal representation of a 32-bytes long string of random bytes.
$cfg['blowfish_secret'] = sodium_hex2bin('f16ce59f45714194371b48fe362072dc3b019da7861558cd4ad29e4d6fb13851');
$i=0;
$i++;
$cfg['Servers'][$i]['host'] = 'localhost:3308';
$cfg['Servers'][$i]['connect_type'] = 'tcp';
$cfg['Servers'][$i]['compress'] = false;

$cfg['Servers'][$i]['auth_type']     = 'cookie';
// if you insist on "root" having no password:
// $cfg['Servers'][$i]['AllowNoPassword'] = true;