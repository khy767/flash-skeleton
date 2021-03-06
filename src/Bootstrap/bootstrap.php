<?php
use App\Bootstrap\DependencyProvider;
use App\View\ApiView;
use App\Middleware\Log;

use App\Controller\TestController;
use App\Rpc\TestRpc;


//route
$app->group('/api',  function(){
    $this->get('/test', TestController::class . ':output');
})->add(Log::class);


//dependency
$container = $app->getContainer();
$container['provider'] = function ($c) {
    return new DependencyProvider($c);
};
$container['logger'] = function ($c) {
    return $c['provider']->getLogger();
};
$container['view'] = function ($c) {
    return new ApiView($c['response']);
};

$container['testRpc'] = function ($c) {
    return new TestRpc($c);
};
