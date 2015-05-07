<?php
    header('HTTP/1.1 503 Service Temporarily Unavailable');
    header('Status: 503 Service Temporarily Unavailable');
    header('Retry-After: 7200');
?>
<!DOCTYPE html>
<html>
    <head>
	<title>CNC-Stats.com - website offline</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
	<div>Website is offline due to data migration process. We'll be back in next 10-15 minutes.</div>
	<!--<div>Website is currently offline, because of databases migration. We'll be back in about 1 hours (about 11:00 PM UTC)<div>-->
    </body>
</html>
