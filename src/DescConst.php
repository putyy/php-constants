<?php
declare(strict_types=1);

namespace Pt\Constants;

abstract class DescConst extends BaseConst
{
    /**
     * @var null | array
     */
    protected static $messageInfo = null;

    protected static $groupMessageInfo = null;

    protected static $allMessageInfo = null;

    protected static $messageInfoDescValue = null;

    protected static $groupMessageInfoKv = null;

    protected static $allMessageInfoKv = null;

    /**
     * @var string
     */
    protected static $messageAnnotationMark = 'Desc';

    /**
     * @var string
     */
    protected static $groupMessageAnnotationMark = 'Group';

    /**
     * @var null
     */
    protected static $descName = 'desc';

    /**
     * @var null
     */
    protected static $valueName = 'value';

    /**
     * 分解注释
     */
    private static function decomposeNotes(): void
    {
        try {
            static::$messageInfo[static::class] = [];
            $re = new \ReflectionClass(new static());
            foreach ($re->getReflectionConstants() as $obj) {
                $getDocComment = $obj->getDocComment() != '' ? $obj->getDocComment() : '';
                $pattern = '/@(\w+)\("(.*?)"\)\s*\\*/';
                preg_match_all($pattern, $getDocComment, $matches, PREG_SET_ORDER);
                $annotations = [];
                foreach ($matches as $match) {
                    $name = $match[1];
                    $value = $match[2];
                    $annotations[$name] = $value;
                }

                if (empty($annotations)) continue;

                // 注解说明必须
                if (!isset($annotations[static::$messageAnnotationMark])) continue;

                if (isset($annotations[static::$groupMessageAnnotationMark])) {
                    static::$groupMessageInfo[static::class][$annotations[static::$groupMessageAnnotationMark]][$obj->getValue()] = $annotations[static::$messageAnnotationMark];
                } else {
                    static::$messageInfo[static::class][$obj->getValue()] = $annotations[static::$messageAnnotationMark];
                }
                static::$allMessageInfo[static::class][$obj->getValue()] = $annotations[static::$messageAnnotationMark];
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

    public static function getDesc($mark): string
    {
        return static::getValueDescArr()[$mark];
    }

    /**
     * 常量值=>注解值.
     * @return array
     */
    public static function getValueDescArr(): array
    {
        self::checkDecomposeNotes();
        return static::$messageInfo[static::class];
    }

    /**
     *  注解值=>常量值
     * @return array
     */
    public static function getDescValueArr(): array
    {
        self::checkDecomposeNotes();
        return array_flip(static::$messageInfo[static::class]);
    }

    /**
     * 自定义键值 数组 [$valueName=>常量值, $descName=>注解值]
     * @return array
     */
    public static function getRelationDescValue(): array
    {
        if (isset(self::$messageInfoDescValue[static::class])) {
            return self::$messageInfoDescValue[static::class];
        }
        self::checkDecomposeNotes();
        $relation = [];
        foreach (self::$messageInfo[static::class] as $value => $desc) {
            $relation[] = [
                self::$valueName => $value,
                self::$descName => $desc,
            ];
        }
        return self::$messageInfoDescValue[static::class] = $relation;
    }

    /**
     * @param string $groupMark
     * @return array
     */
    public static function getGroupValueDescArr(string $groupMark): array
    {
        self::checkDecomposeNotes();
        return self::$groupMessageInfo[static::class][$groupMark];
    }

    /**
     * @param string $groupMark
     * @return array
     */
    public static function getGroupDescValueArr(string $groupMark): array
    {
        self::checkDecomposeNotes();
        return array_flip(self::$groupMessageInfo[static::class][$groupMark]);
    }

    /**
     * 获取常量对应注解关系数组(分组)
     * @param string $groupMark
     * @return array
     */
    public static function getGroupRelationDescValue(string $groupMark): array
    {
        if (isset(self::$groupMessageInfoKv[static::class])) {
            return self::$groupMessageInfoKv[static::class][$groupMark];
        }
        self::checkDecomposeNotes();
        $relation = [];
        foreach (self::$groupMessageInfo[static::class] as $index=>$item) {
            $relation[$index] = [];
            foreach ($item as $value => $desc) {
                $relation[$index][] = [
                    self::$valueName => $value,
                    self::$descName => $desc,
                ];
            }
        }
        self::$groupMessageInfoKv[static::class] = $relation;
        return self::$groupMessageInfoKv[static::class][$groupMark];
    }

    public static function allValueDescArr(): array
    {
        self::checkDecomposeNotes();
        return static::$allMessageInfo[static::class];
    }

    public static function allDescValueArr(): array
    {
        self::checkDecomposeNotes();
        return array_flip(static::$allMessageInfo[static::class]);
    }

    public static function allRelationDescValue(): array
    {
        if (isset(self::$allMessageInfoKv[static::class])) {
            return self::$allMessageInfoKv[static::class];
        }
        self::checkDecomposeNotes();
        $relation = [];
        foreach (self::$allMessageInfo[static::class] as $value => $desc) {
            $relation[] = [
                self::$valueName => $value,
                self::$descName => $desc,
            ];
        }
        return self::$allMessageInfoKv[static::class] = $relation;
    }
}
