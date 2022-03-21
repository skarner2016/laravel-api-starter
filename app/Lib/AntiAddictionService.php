<?php


namespace App\Lib;


use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class AntiAddictionService
{
    private $appId;
    private $secretKey;
    private $bizId;

    const ID_AUTHENTICATION_URI = 'https:// api.wlc.nppa.gov.cn/idcard/authentication/check';

    /**
     * AntiAddictionService constructor.
     * @param $appId
     * @param $secretKey
     * @param $bizId
     */
    public function __construct($appId, $secretKey, $bizId)
    {
        $this->appId     = $appId;
        $this->secretKey = $secretKey;
        $this->bizId     = $bizId;
    }

    public function checkIdCard($ai, $name, $idNum)
    {
        $client = new Client();
        $body   = [
            'ai'    => $ai,
            'name'  => $name,
            'idNum' => $idNum,
        ];

        $header = $this->getHeader($body, []);

        try {
            $response = $client->request('POST', self::ID_AUTHENTICATION_URI, [
                'headers' => $header['header'],
                'json'    => $header['encrypted_body'],
                'timeout' => 5,
            ]);
        } catch (GuzzleException $e) {
            dd('GuzzleException', $e->getCode(), $e->getLine(), $e->getMessage());
        } catch (Exception $e) {
            dd('Exception', $e->getCode(), $e->getLine(), $e->getMessage());
        }

        $content = $response->getBody()->getContents();

        dd(json_encode($content, true));
    }

    /**
     * 构建请求头
     * @param $body
     * @param $params
     * @return array
     */
    private function getHeader(array $body, $params): array
    {
        list($msec, $sec) = explode(' ', microtime());
        $timestamps = sprintf('%d', (floatval($msec) + floatval($sec)) * 1000);

        $signData = $this->sign($body, $params, $timestamps);
        $header   = [
            'Content-Type' => 'application/json;charset=utf-8',
            'appId'        => $this->appId,
            'bizId'        => $this->bizId,
            'timestamps'   => $timestamps,
            'sign'         => $signData['sign']
        ];

        return [
            'header'         => $header,
            'encrypted_body' => $signData['encrypted_body']
        ];
    }

    /**
     * @param $body
     * @param $params
     * @param $timestamps
     * @return array
     */
    private function sign(array $body, $params, $timestamps): array
    {
        $encryptedBody = empty($body) ? '' : json_encode(['data' => $this->bodyEncrypt($body)]);
        $sysParams     = [
            'appId'      => $this->appId,
            'bizId'      => $this->bizId,
            'timestamps' => $timestamps,
        ];
        $params        = array_merge($params, $sysParams);
        ksort($params);

        $baseString = "";
        foreach ($params as $k => $v) {
            $baseString .= $k . $v;
        }

        $baseString = $this->secretKey . $baseString . $encryptedBody;
        $sign       = hash('sha256', $baseString);

        return [
            'sign'           => $sign,
            'encrypted_body' => json_encode($encryptedBody, true),
        ];
    }

    /**
     * @param array $body
     * @return string
     */
    private function bodyEncrypt(array $body): string
    {
        $key     = hex2bin($this->secretKey);
        $cipher  = "aes-128-gcm";
        $ivlen   = openssl_cipher_iv_length($cipher);
        $iv      = openssl_random_pseudo_bytes($ivlen);
        $encrypt = openssl_encrypt(json_encode($body), $cipher, $key, OPENSSL_RAW_DATA, $iv, $tag);

//        dd($iv, $encrypt, $tag, base64_encode($iv . $encrypt . $tag));
        return base64_encode($iv . $encrypt . $tag);
    }
}
