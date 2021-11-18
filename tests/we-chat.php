<?php
declare(strict_types=1);

class WeChatMsgConst extends \Pt\Constants\DescConst
{
    /**
     * @Desc("
    {
    "touser":"{{openid}}",
    "msgtype":"text",
    "text":
    {
    "content":"{{content}}"
    }
    }")
     */
    const COMMENT_TXT = 1;

    /**
     * @param array $data
     * @param int $mark
     * @return string
     */
    public static function buildMessage(array $data, int $mark): string
    {
        return parent::replace($data, parent::getDesc($mark));
    }
}