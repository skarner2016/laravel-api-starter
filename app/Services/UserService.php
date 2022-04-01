<?php

namespace App\Services;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use InvalidArgumentException;

class UserService
{
    /**
     * @desc    获取 jwt_key
     * @return string
     * @author  skarner <2022-04-01 14:53>
     */
    private static function jwtKey(): string
    {
        $key = 'meoYiETnCmAWDgV26dNXCBo7W36UHoipw7Tzm7QwQ93w6wS6PK';

        return config('app.jwt_key', $key);
    }

    /**
     * @desc    获取 jwt_alg
     * @return string
     * @author  skarner <2022-04-01 15:05>
     */
    private static function jwtAlg(): string
    {
        $alg = 'HS256';

        return config('app.jwt_alg', $alg);
    }

    /**
     * @desc    生成 jwt
     * @param int    $userId
     * @param string $mobile
     * @param string $email
     * @return string
     * @author  skarner <2022-04-01 14:51>
     */
    public static function jwtEncode(int $userId, string $mobile, string $email): string
    {
        $key = self::jwtKey();
        $alg = self::jwtAlg();

        $ttl = 7;
        $ttl = config('app.jwt_ttl', $ttl);
        $ttl *= 86400;

        $payload = [
            'iss'     => config('app.url'),
            'exp'     => time() + $ttl,
            'user_id' => $userId,
            'mobile'  => $mobile,
            'email'   => $email,
        ];

        return JWT::encode($payload, $key, $alg);
    }

    /**
     * @desc    解码 jwt
     * @param string $jwt
     * @return array
     * @author  skarner <2022-04-01 14:55>
     */
    public static function jwtDecode(string $jwt): array
    {
        try {
            $key = self::jwtKey();
            $alg = self::jwtAlg();
            $key = new Key($key, $alg);

            return (array)JWT::decode($jwt, $key);
        } catch (InvalidArgumentException|Exception $e) {

            return [];
        }
    }
}
