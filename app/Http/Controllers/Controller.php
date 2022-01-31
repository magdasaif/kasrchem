<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


class Controller extends BaseController
{
 /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Eradco System",
     *      description="Eradco API Documentation",
     *      @OA\Contact(
     *          email="engyasmeenali@gmail.com"
     *      ),
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="API Server"
     * )

     */

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
