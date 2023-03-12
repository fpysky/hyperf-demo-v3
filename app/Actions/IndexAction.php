<?php

declare(strict_types=1);

namespace App\Actions;

use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Psr\Http\Message\ResponseInterface;

#[Controller]
class IndexAction extends AbstractAction
{
    #[RequestMapping(path: '/', methods: 'GET')]
    public function handle(): ResponseInterface
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        $data = [
            'method' => $method,
            'message' => "Hello {$user}.",
        ];

        return $this->success($data);
    }
}
