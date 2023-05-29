<?php

namespace Src\Controllers;

use Src\Models\TestModel;

class TestController
{
  public function run(){
    // modelsの中のクラスTestModelをインスタンス化
    $model = new TestModel;
    // modelsの中のgetHelloメゾドを呼び出す
    echo $model->getHello();
  }
}

