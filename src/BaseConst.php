<?php
declare(strict_types=1);

namespace Pt\Constants;

abstract class BaseConst
{
    /**
     * @param array $data
     * @return array
     */
    protected static function contrast(array $data): array
    {
        $search =
        $replace = [];
        foreach ($data as $k => $v) {
            $search[] = '{{' . $k . '}}';
            $replace[] = addslashes($v);
        }
        return [$search, $replace];
    }

    /**
     * @param array $data
     * @param string $string
     * @return string
     */
    public static function replace(array $data, string $string): string
    {
        list($search, $replace) = static::contrast($data);
        return $search ? str_replace($search, $replace, $string) : $string;
    }
}