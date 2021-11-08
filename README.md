## 自用常量基础类库
```
composer require putyy/php-constants
```

### 示例1
```php
// todo 发送微信消息
$msgData= WeChatMsgConst::buildMessage([
    "openid"=>"asdsadqwewqe",
    "content"=>"hello PHP~",
]);

```

### 示例1
```php
<?php
class TestConst extends \Pt\Constants\MessageBaseConst {
    /**
     *
     * @Message("555")
     *
     */
    const COMMENT_TXT = 11;

    /**
     * @Message("666")
     *
     */
    const COMMENT_TXT_TWO = 22;

    /**
     * @Group("aa")
     * @Message("33333")
     *
     */
    const COMMENT_TXT1 = 33;

    /**
     * @Group("aa")
     * @Message("22222")
     *
     */
    const COMMENT_TXT_TWO2 = 44;


    /**
     * all的方式 属性值一样的话会覆盖前面的值
     * @Group("bb")
     * @Message("777")
     *
     */
    const COMMENT_TXT3 = 333;

    /**
     * all的方式 属性值一样的话会覆盖前面的值
     * @Group("bb")
     * @Message("888")
     *
     */
    const COMMENT_TXT_TWO3 = 444;
}
```


```shell
# var_dump(TestConst::relationVk());
array(2) {
  [11]=>
  string(3) "555"
  [22]=>
  string(3) "666"
}

# var_dump(TestConst::relationKv());
array(2) {
  [0]=>
  array(2) {
    ["value"]=>
    int(11)
    ["desc"]=>
    string(3) "555"
  }
  [1]=>
  array(2) {
    ["value"]=>
    int(22)
    ["desc"]=>
    string(3) "666"
  }
}

# var_dump(TestConst::groupRelation('bb'));
array(2) {
  [333]=>
  string(3) "777"
  [444]=>
  string(3) "888"
}

# var_dump(TestConst::groupRelationKv('bb'));
array(2) {
  [0]=>
  array(2) {
    ["value"]=>
    int(333)
    ["desc"]=>
    string(3) "777"
  }
  [1]=>
  array(2) {
    ["value"]=>
    int(444)
    ["desc"]=>
    string(3) "888"
  }
}

# var_dump(TestConst::allRelation());
array(6) {
  [11]=>
  string(3) "555"
  [22]=>
  string(3) "666"
  [33]=>
  string(5) "33333"
  [44]=>
  string(5) "22222"
  [333]=>
  string(3) "777"
  [444]=>
  string(3) "888"
}

# var_dump(TestConst::allRelationKv());
array(6) {
  [0]=>
  array(2) {
    ["value"]=>
    int(11)
    ["desc"]=>
    string(3) "555"
  }
  [1]=>
  array(2) {
    ["value"]=>
    int(22)
    ["desc"]=>
    string(3) "666"
  }
  [2]=>
  array(2) {
    ["value"]=>
    int(33)
    ["desc"]=>
    string(5) "33333"
  }
  [3]=>
  array(2) {
    ["value"]=>
    int(44)
    ["desc"]=>
    string(5) "22222"
  }
  [4]=>
  array(2) {
    ["value"]=>
    int(333)
    ["desc"]=>
    string(3) "777"
  }
  [5]=>
  array(2) {
    ["value"]=>
    int(444)
    ["desc"]=>
    string(3) "888"
  }
}

```
