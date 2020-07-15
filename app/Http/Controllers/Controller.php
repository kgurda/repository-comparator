<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    const L5_SWAGGER_CONST_HOST = 'http://localhost:8000';
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Repository comparator documentation",
     *      description="The project is a tool to compare two different repositories.",
     *      @OA\Contact(
     *          email="gurda.kasia@gmail.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="Local env"
     * )

     *
     * @OA\Tag(
     *     name="Repository controller",
     *     description="API Endpoints of Projects"
     * )
     */
}
