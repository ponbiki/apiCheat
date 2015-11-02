<?php

namespace ponbiki\apiCheat;

class ApiCalls implements iApiCalls
{
    public function keyValidate($key)
    {
        $clean_key = \filter_var($key, FILTER_SANITIZE_STRING);
        $ch = \curl_init();
        \curl_setopt($ch, CURLOPT_URL, self::BASEURL ."zones");
        \curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-NSONE-Key: $clean_key"));
        \curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $body = \json_decode(\curl_exec($ch), true);
        \curl_close($ch);
        if (array_key_exists('message', $body)) {
            return \FALSE;
        } else {
            return \TRUE;
        }
    }
}