<?php

namespace App\Services;

class CURLService {
    public function retrieveData($url, $proxy = null, $tls = true)
    {
        try {
            $ch = curl_init();

            if ($ch === false) {
                throw new \Exception('failed to initialize');
            }

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/72.4.208 Chrome/66.4.3359.208 Safari/537.36');
            curl_setopt($ch, CURLOPT_REFERER, 'https://www.google.com');
            curl_setopt($ch, CURLOPT_ENCODING, '');

            $headers = array(
                'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/72.4.208 Chrome/66.4.3359.208 Safari/537.36',
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
                'Accept-Encoding: gzip, deflate, br',
                'Accept-Language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5'
            );
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_HTTPGET, true);


            $content = curl_exec($ch);

            if ($content === false) {
                throw new \Exception(curl_error($ch), curl_errno($ch));
            }

            curl_close($ch);

            return $content;
        } catch (\Exception $e) {
            trigger_error(sprintf('Curl failed with error #%d: %s', $e->getCode(), $e->getMessage())
                , E_USER_ERROR);
        }
    }
}
