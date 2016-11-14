<?php
// Coppermine configuration file
// MySQL configuration
if ($_SERVER["HTTP_HOST"] == 'localhost:8086')
{
$CONFIG['dbserver'] = "localhost";
$CONFIG['dbname'] = "sample";
$CONFIG['dbuser'] = "root";
$CONFIG['dbpass'] = "Bau720123";
}
if ($_SERVER["HTTP_HOST"] != 'localhost:8086')
{
$CONFIG['dbserver'] = "localhost";
$CONFIG['dbname'] = "littleb1_sample";
$CONFIG['dbuser'] = "littleb1_bau";
$CONFIG['dbpass'] = "V9loCkToAK1n";
}

// MySQL TABLE NAMES PREFIX
$CONFIG['TABLE_PREFIX'] =                'cpg15x_';
?>