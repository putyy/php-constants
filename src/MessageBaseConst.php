<?php
declare(strict_types=1);

namespace Pt\Constants;

abstract class MessageBaseConst extends BaseConst
{
    /**
     * @var null | array
     */
    protected static $messageInfo = null;

    protected static $groupMessageInfo = null;

    protected static $allMessageInfo = null;

    protected static $messageInfoKv = null;

    protected static $groupMessageInfoKv = null;

    protected static $allMessageInfoKv = null;

    /**
     * @var string
     */
    protected static $messageAnnotationMark = 'Message';

    /**
     * @var string
     */
    protected static $groupMessageAnnotationMark = 'Group';

    /**
     * @var null
     */
    protected static $keyName = 'desc';

    /**
     * @var null
     */
    protected static $valueName = 'value';

    /**
     * @param int | string $mark
     * @return string
     */
    public static function getMessage($mark): string
    {
        return static::relationVk()[$mark];
    }

    /**
     * 分解注释
     */
    private static function decomposeNotes(): void
    {
        try {
            static::$messageInfo[static::class] = [];
            $re = new \ReflectionClass(new static());
            foreach ($re->getReflectionConstants() as $obj) {
                preg_match('/\@' . static::$groupMessageAnnotationMark . '\("([\s\S]*?)"\)\s+\*/', $obj->getDocComment(), $group);
                preg_match('/\@' . static::$messageAnnotationMark . '\("([\s\S]*)"\)\s+\*/', $obj->getDocComment(), $match);
                if (isset($group[1])) {
                    static::$groupMessageInfo[static::class][$group[1]][$obj->getValue()] = $match[1] ?? '';
                } else {
                    static::$messageInfo[static::class][$obj->getValue()] = $match[1] ?? '';
                }
                static::$allMessageInfo[static::class][$obj->getValue()] = $match[1] ?? '';
            }
        } catch (\ReflectionException $exception) {
        }
    }

    protected static function checkDecomposeNotes()
    {
        if (!isset(static::$messageInfo[static::class])) {
            static::decomposeNotes();
        }
    }

    /**
     * 获取常量对应注解关系数组 value=>key
     * @return array
     */
    public static function relationVk(): array
    {
        self::checkDecomposeNotes();
        return static::$messageInfo[static::class];
    }

    /**
     * 获取常量对应注解关系数组
     * @return array
     */
    public static function relationKv(): array
    {
        if (isset(self::$messageInfoKv[static::class])) {
            return self::$messageInfoKv[static::class];
        }
        self::checkDecomposeNotes();
        $relation = [];
        foreach (self::$messageInfo[static::class] as $value => $desc) {
            $relation[] = [
                self::$valueName => $value,
                self::$keyName => $desc,
            ];
        }
        return self::$messageInfoKv[static::class] = $relation;
    }

    /**
     * 获取常量对应注解关系数组(分组)
     * @param string $groupMark
     * @return array
     */
    public static function groupRelation(string $groupMark): array
    {
        self::checkDecomposeNotes();
        return self::$groupMessageInfo[static::class][$groupMark];
    }

    /**
     * 获取常量对应注解关系数组(分组)
     * @param string $groupMark
     * @return array
     */
    public static function groupRelationKv(string $groupMark): array
    {
        if (isset(self::$groupMessageInfoKv[static::class])) {
            return self::$groupMessageInfoKv[static::class][$groupMark];
        }
        self::checkDecomposeNotes();
        $relation = [];
        foreach (self::$groupMessageInfo[static::class] as $item) {
            $relation[$groupMark] = [];
            foreach ($item as $value => $desc) {
                $relation[$groupMark][] = [
                    self::$valueName => $value,
                    self::$keyName => $desc,
                ];
            }
        }
        self::$groupMessageInfoKv[static::class] = $relation;
        return self::$groupMessageInfoKv[static::class][$groupMark];
    }


    /**
     * 获取常量对应注解关系数组-所有
     * @return array
     */
    public static function allRelation(): array
    {
        self::checkDecomposeNotes();
        return static::$allMessageInfo[static::class];
    }

    /**
     * 获取常量对应注解关系数组-所有
     * @return array
     */
    public static function allRelationKv(): array
    {
        if (isset(self::$allMessageInfoKv[static::class])) {
            return self::$allMessageInfoKv[static::class];
        }
        self::checkDecomposeNotes();
        $relation = [];
        foreach (self::$allMessageInfo[static::class] as $value => $desc) {
            $relation[] = [
                self::$valueName => $value,
                self::$keyName => $desc,
            ];
        }
        return self::$allMessageInfoKv[static::class] = $relation;
    }
}
