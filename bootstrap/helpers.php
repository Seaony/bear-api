<?php

if (!function_exists('mina')) {

    /**
     * Easywechat instance
     *
     * @return mixed
     */
    function mina()
    {
        return \EasyWeChat::miniProgram();
    }
}
