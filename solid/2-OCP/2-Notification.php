<?php

class Notification
{
    public function send(string $type = 'sms', array $params)
    {
        $notificationClass = 'App\\Notification\\' . ucfirst($type);

        return (new $notificationClass())->send($params);
    }
}

$notification = new Notification();
$notification->send('email' , []);