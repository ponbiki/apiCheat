<?php

namespace ponbiki\apiCheat;

class ApiCalls implements iApiCalls
{
    protected function baseCurl($key, $arg)
    {
        $clean_key = \filter_var($key, FILTER_SANITIZE_STRING);
        $ch = \curl_init();
        \curl_setopt($ch, CURLOPT_URL, self::BASEURL . $arg);
        \curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-NSONE-Key: $clean_key"));
        \curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $body = \json_decode(\curl_exec($ch), true);
        \curl_close($ch);
        return $body;
    }
    public function keyValidate($key)
    {
        $arg = "zones";
        $body = self::baseCurl($key, $arg);
        if (array_key_exists('message', $body)) {
            return \FALSE;
        } else {
            $_SESSION['zones'] = self::zoneList($body);
            return \TRUE;
        }
    }
    
    private function zoneList($zones_array)
    {
        foreach ($zones_array as $zones) {
            $zone_hold[] = $zones['zone'];
        }
        return $zone_hold;
    }
}