<?php
/**
 * @desc    此处定义辅助函数
 * @author  skarner <2022-03-24 16:38>
 */

if (!function_exists('array_rebuild')) {
    /**
     * @desc    通过新的Key重建数组索引
     * @param array $array
     * @param string $key
     * @return array
     * @author  skarner <2022-03-24 16:40>
     */
    function array_rebuild(array $array, string $key): array
    {
        $data = [];
        if (empty($array) || empty($key)) {
            return $data;
        }

        foreach ($array as $item) {
            if ($index = Arr::get($item, $key)) {
                $data[$index] = $item;
            }
        }

        return $data;
    }
}

if (!function_exists('milli_2_second')) {
    /**
     * @desc    毫秒转秒
     * @param $millisecond
     * @return int
     * @author  skarner <2022-03-24 17:12>
     */
    function milli_2_second($millisecond): int
    {
        return intval($millisecond / 1000);
    }
}

if (!function_exists('second_2_milli')) {
    /**
     * @desc    毫秒转秒
     * @param string $second
     * @return int
     * @author  skarner <2022-03-24 17:12>
     */
    function second_2_milli(string $second): int
    {
        return intval($second * 1000);
    }
}

if (!function_exists('millisecond')) {
    /**
     * @desc    毫秒转秒
     * @return int
     * @author  skarner <2022-03-24 17:12>
     */
    function millisecond(): int
    {
        $microTime      = microtime();
        $microTimeArr   = explode(' ', $microTime);
        $microTimeFloat = bcadd($microTimeArr[0], $microTimeArr[1], 8);

        return intval($microTimeFloat * 1000);
    }
}

if (!function_exists('microsecond')) {
    /**
     * @desc    毫秒转秒
     * @return int
     * @author  skarner <2022-03-24 17:12>
     */
    function microsecond(): int
    {
        $microTime      = microtime();
        $microTimeArr   = explode(' ', $microTime);
        $microTimeFloat = bcadd($microTimeArr[0], $microTimeArr[1], 8);

        return intval($microTimeFloat * 1000 * 1000);
    }
}

if (!function_exists('memory_get_usage_format')) {

    /**
     * @desc    内存占用
     * @return string
     * @author  skarner <2022-03-24 17:12>
     */
    function memory_get_usage_format(): string
    {
        $memory = memory_get_usage();
        if ($memory < 1024) {
            $unit = 'bytes';
        } else if ($memory < 1048576) {
            $memory = round($memory / 1024, 2);
            $unit   = 'kilobytes';
        } else {
            $memory = round($memory / 1048576, 2);
            $unit   = 'megabytes';
        }

        return $memory . ' ' . $unit;
    }
}
