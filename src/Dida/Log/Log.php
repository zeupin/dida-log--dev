<?php
/**
 * Dida Framework  -- A Rapid Development Framework
 * Copyright (c) Zeupin LLC. (http://zeupin.com)
 *
 * Licensed under The MIT License.
 * Redistributions of files must retain the above copyright notice.
 */

namespace Dida\Log;

/**
 * Log
 */
class Log
{
    /**
     * Version
     */
    const VERSION = '20180508';

    /**
     * 默认的日志目录
     *
     * @var string
     */
    public static $dir = null;


    /**
     * 记录一行日志
     *
     * @param string $file
     * @param any $data
     *
     * @return bool 成功返回true，失败返回false
     */
    public static function write($data, $file = null)
    {
        if (!$file) {
            // 如果没有设置log目录，直接退出
            if (self::$dir === null || !file_exists(self::$dir) || !is_dir(self::$dir)) {
                return false;
            }

            // 日志文件名
            $date = date('Y-m-d');
            $file = realpath(self::$dir) . DIRECTORY_SEPARATOR . "{$date}.log";
        }

        // 日志内容
        $time = date("H:i:s");
        $data = var_export($data, true);
        $result = file_put_contents($file, "$time $data\n", FILE_APPEND + LOCK_EX);

        // 返回
        return ($result === false) ? false : true;
    }
}
