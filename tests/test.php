<?php
class TestConst extends \Pt\Constants\DescConst {
    /**
     *
     * @Desc("555")
     *
     */
    const COMMENT_TXT = 11;

    /**
     * @Desc("666")
     *
     */
    const COMMENT_TXT_TWO = 22;

    /**
     * @Group("aa")
     * @Desc("33333")
     *
     */
    const COMMENT_TXT1 = 33;

    /**
     * @Group("aa")
     * @Desc("22222")
     *
     */
    const COMMENT_TXT_TWO2 = 44;


    /**
     * all的方式 属性值一样的话会覆盖前面的值
     * @Group("bb")
     * @Desc("777")
     *
     */
    const COMMENT_TXT3 = 333;

    /**
     * all的方式 属性值一样的话会覆盖前面的值
     * @Group("bb")
     * @Desc("888")
     *
     */
    const COMMENT_TXT_TWO3 = 444;
}