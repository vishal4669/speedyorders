<?php

namespace Modules\AdminApi\Http\Controllers\v1;


use App\Utils\Option;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\AdminApi\Http\Controllers\BaseController;


class ChatController extends BaseController
{
    public function chatScript()
    {
        $chatScript = Option::get('chat_script');
        return $this->success($chatScript);

    }
}
