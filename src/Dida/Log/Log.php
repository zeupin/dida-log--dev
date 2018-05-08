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
     * 记录一行日志
     *
     * @param string $file
     * @param type $data
     */
    public static function write($file, $data)
    {
        $time = date("H:i:s");
        $result = file_put_contents($file, "$time $data\n", FILE_APPEND + LOCK_EX);
    }
}
