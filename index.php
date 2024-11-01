<!DOCTYPE html>
<html>
<head>
<title>Web Push Notifications in PHP</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="style.css" type="text/css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
</head>
<body>
    <div class="phppot-container">
        <h1>Web Push Notification using PHP in a Browser</h1>
        <p>This example shows a web push notification from PHP on
            browser automatically every 10 seconds. The notification
            also closes automatically just after 5 seconds.</p>
    </div>
    <script>
        // enable this if you want to make only one call and not repeated calls automatically
        // pushNotify();

        // following makes an AJAX call to PHP to get notification every 10 secs
        setInterval(function() { pushNotify(); }, 10000);

        function pushNotify() {
        	if (!("Notification" in window)) {
        		// checking if the user's browser supports web push Notification
        		alert("Web browser does not support desktop notification");
        	}
        	if (Notification.permission !== "granted")
        		Notification.requestPermission();
        	else {
        		$.ajax({
        			url: "push-notify.php",
        			type: "POST",
        			success: function(data, textStatus, jqXHR) {
        				// if PHP call returns data process it and show notification
        				// if nothing returns then it means no notification available for now
        				if ($.trim(data)) {
        					var data = jQuery.parseJSON(data);
        					console.log(data);
        					notification = createNotification(data.title, data.icon, data.body, data.url);

        					// closes the web browser notification automatically after 5 secs
        					setTimeout(function() {
        						notification.close();
        					}, 5000);
        				}
        			},
        			error: function(jqXHR, textStatus, errorThrown) { }
        		});
        	}
        };

        function createNotification(title, icon, body, url) {
        	var notification = new Notification(title, {
        		icon: icon,
        		body: body,
        	});
        	// url that needs to be opened on clicking the notification
        	// finally everything boils down to click and visits right
        	notification.onclick = function() {
        		window.open(url);
        	};
        	return notification;
        }
    </script>
</body>
</html>