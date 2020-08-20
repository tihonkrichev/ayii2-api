<?php

namespace api\v1\controllers;

use core\ApiController;

class IndexController extends ApiController
{
    /**
     * Displays homepage.
     *
     * @return array
     */
    public function actionIndex()
    {
        return ['Hello World'];
    }


}
