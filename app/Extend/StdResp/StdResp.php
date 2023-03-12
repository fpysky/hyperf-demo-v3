<?php

declare(strict_types=1);

namespace App\Extend\StdResp;

use App\Constants\BaseCode;
use App\Constants\StatusCode;
use Hyperf\Contract\Arrayable;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\HttpServer\Response;
use Hyperf\Utils\Collection;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

trait StdResp
{
    use StdOutput;

    public function success($input, string $msg = '', int $code = BaseCode::Ok->value): PsrResponseInterface
    {
        return match (true) {
            is_string($input) => $this->message($input),
            $input instanceof Collection => $this->collection($input, $msg, $code),
            $input instanceof Arrayable,
            $input instanceof \JsonSerializable,
            is_array($input),
            $input instanceof \stdClass => $this->item($input, $msg, $code),
            $input === null => $this->message(),
            default => throw new \RuntimeException("can't handle input data."),
        };
    }

    public function item($input, string $msg, int $code = BaseCode::Ok->value): PsrResponseInterface
    {
        return $this->buildResp($msg, $code, $input);
    }

    public function error(string $msg = '服务器错误', int $code = BaseCode::ServerError->value, mixed $data = null): PsrResponseInterface
    {
        return $this->buildResp($msg, $code, $data, StatusCode::ServerError);
    }

    public function message(string $msg = '', int $code = BaseCode::Ok->value): PsrResponseInterface
    {
        return $this->buildResp($msg, $code);
    }

    public function collection(Collection $collection, string $msg, int $code = BaseCode::Ok->value): PsrResponseInterface
    {
        return $this->buildResp($msg, $code, $collection);
    }

    private function buildResp(string $msg, int $code, mixed $data = null, StatusCode $statusCode = StatusCode::Ok): PsrResponseInterface
    {
        return $this->response
            ->json($this->buildStruct($msg, $code, $data))
            ->withStatus($statusCode->value);
    }
}
