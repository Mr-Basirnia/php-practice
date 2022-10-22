<?php

class Notification
{
    public function send(string $type = 'sms', array $params)
    {
        if ($type == 'sms') {
            return $this->sendSms($params);
        }
        if ($type == 'email') {
            return $this->sendEmail($params);
        }
    }

    private function sendSms(array $params)
    {
    }

    private function sendEmail(array $params)
    {
    }
}
