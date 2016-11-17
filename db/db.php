
<?php

$db = mysql_connect("localhost", "root", "toor");
if (!$db) {
    die("Error:" . mysql_error());
}
mysql_select_db("TIP", $db);
//mysql_select_db("test_db", $db);

//$result = mysql_query("select * from SchoolListings order by Groups");

