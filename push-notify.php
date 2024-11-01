<?php
// if there is anything to notify, then return the response with data for
// push notification else just exit the code
$webNotificationPayload['title'] = 'Push Notification from PHP';
$webNotificationPayload['body'] = 'PHP to browser web push notification.';
$webNotificationPayload['icon'] = 'https://phppot.com/badge.png';
$webNotificationPayload['url'] = 'https://phppot.com';
echo json_encode($webNotificationPayload);
exit();
?>