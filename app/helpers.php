<?php

    /**
     * str_replace — 子字符串替换
     * Route::currentRouteName - 获取当前路由
     * 
     * @return string
     * 
     */
    function route_class(){
        
        return str_replace('.', '-', Route::currentRouteName());      
    }