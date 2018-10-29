<?php

class Pub
{
    public static function curlData($url, $req)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Accept: application/json']);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($curl, CURLOPT_HEADER, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($req));

        if (!$json = curl_exec($curl)) {
            echo curl_error($curl);
        }

        curl_close($curl);

        return json_decode($json, true);
    }

    public function curlPost($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
        if (!$result = curl_exec($ch)) {
            echo curl_error($ch);
        }
        curl_close($ch);

        return $result;
    }

    public static function elements($arr, $req, $err = null)
    {
        $diff = array_values(array_diff($arr, array_keys($req)));
        if (count($diff) > 0) :
            $err = '必須項目 '.json_encode($diff, true).' 未入力';
        endif;

        if ($err == null):
            $data['result'] = true; else:
            $data['result'] = false;
        $data['message'] = $err;
        endif;

        return $data;
    }

    public static function checkElements($elements, $req)
    {
        foreach ($elements as $el) {
            if (!array_key_exists($el, $req)) {
                $req[$el] = null;
            }
        }

        return $req;
    }
}
