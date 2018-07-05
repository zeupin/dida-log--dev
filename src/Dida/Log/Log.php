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
     * 记录一条日志
     *
     * @return bool 成功返回true，失败返回false
     */
    public static function write($var)
    {
        // 参数个数
        $num_args = func_num_args();
        if (!$num_args) {
            return false;
        }

        // 如果没有设置log目录，直接退出
        if (self::$dir === null || !file_exists(self::$dir) || !is_dir(self::$dir)) {
            return false;
        }

        // 日志文件名
        $date = date('Y-m-d');
        $file = realpath(self::$dir) . DIRECTORY_SEPARATOR . "{$date}.log";

        // 参数列表
        $args = func_get_args();

        // 待输出内容
        $output = [];
        $time = date("H:i:s");
        foreach ($args as $arg) {
            $content = var_export($arg, true);
            $output[] = "$time $content\n";
        }

        // 写文件
        $result = file_put_contents($file, implode('', $output), FILE_APPEND + LOCK_EX);

        // 返回
        return ($result === false) ? false : true;
    }


    /**
     * 将一个变量记录到$dir/$file中。
     *
     * @param string $file
     * @param any $var
     */
    public static function writeTo($file, $var)
    {
        // 参数个数
        $num_args = func_num_args();
        if (!$num_args) {
            return false;
        }

        // 如果没有设置log目录，直接退出
        if (self::$dir === null || !file_exists(self::$dir) || !is_dir(self::$dir)) {
            return false;
        }

        // 日志文件名
        $target = realpath(self::$dir) . DIRECTORY_SEPARATOR . "$file";

        // 参数列表
        $args = func_get_args();

        // 待输出内容
        $output = [];
        $time = date("H:i:s");
        for ($i = 1; $i < $num_args; $i++) {
            $arg = $args[$i];
            $content = var_export($arg, true);
            $output[] = "$time $content\n";
        }

        // 写文件
        $result = file_put_contents($target, implode('', $output), FILE_APPEND + LOCK_EX);

        // 返回
        return ($result === false) ? false : true;
    }
}
