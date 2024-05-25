<?php
use Core\Container;
test('example', function () {
    $container=new Container;
    $container->bind("foo",fn()=>"bar");
    $result=$container->resolve("foo")[0]();
    expect($result)->toEqual("bar");
});
test('example2', function () {
    $container=new Container;
    $container->bind("foo",fn()=>"bar");
    $result=$container->resolve("foo")[0]();
    expect($result)->toEqual("barr");
});