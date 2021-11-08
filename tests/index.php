<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/test.php';
require_once __DIR__ . '/we-chat.php';

# 示例1
var_dump(TestConst::relationVk());

var_dump(TestConst::relationKv());

var_dump(TestConst::groupRelation('bb'));

var_dump(TestConst::groupRelationKv('bb'));

var_dump(TestConst::allRelation());

var_dump(TestConst::allRelationKv());

# 示例2
// todo 发送微信消息
$msg = WeChatMsgConst::buildMessage([
    "openid"=>"asdsadqwewqe",
    "content"=>"hello PHP~",
]);

