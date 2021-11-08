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