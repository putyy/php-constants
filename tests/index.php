<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/test.php';
require_once __DIR__ . '/we-chat.php';

// // todo 示例2
var_dump(TestConst::getValueDescArr());

var_dump(TestConst::getDescValueArr());

var_dump(TestConst::getRelationDescValue());

var_dump(TestConst::getGroupValueDescArr('ord_type'));

var_dump(TestConst::getGroupDescValueArr('bb'));

var_dump(TestConst::getGroupRelationDescValue('ord_type'));

var_dump(TestConst::allValueDescArr());

var_dump(TestConst::allDescValueArr());

var_dump(TestConst::allRelationDescValue());

// // todo 示例2
// // 发送微信消息
$msg = WeChatMsgConst::buildMessage([
    "openid"=>"asdsadqwewqe",
    "content"=>"hello PHP~",
], 1);
var_dump($msg);
