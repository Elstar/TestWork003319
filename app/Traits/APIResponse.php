<?php


namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Response;
use Throwable;

trait APIResponse
{

    /** Success JSON ответ
     * @param array|object $data
     * @param  string|null  $message
     * @param  int|null  $code
     * @return JsonResponse
     */
    public function sendResponse($data = [], ?string $message = '', ?int $code = 200): JsonResponse
    {
        return Response::json(self::makeResponse(true, $message, $data), $code);
    }


    /** Success JSON ответ, только данные, без каких либо полей
     * @param array $data
     * @param  int|null  $code
     * @return JsonResponse
     */
    public function sendData(array $data = [], ?int $code = 200): JsonResponse
    {
        return Response::json($data, $code);
    }


    public function sendErrorTrace(Throwable $exception, ?string $message = null): JsonResponse
    {
        $error_message = (!empty($message)) ? $message.' Error: ' : '';
        $error_message .= $exception->getMessage();

        $params = [
            'message' => $exception->getMessage(),
        ];

        // подробный режим если дебажим приложение
        if (env('APP_DEBUG') === true) {
            $params['class_exception'] = get_class($exception);
            $params['code'] = $exception->getCode();
            $params['line'] = $exception->getLine();
            $params['file'] = $exception->getFile();
            $params['trace'] = $exception->getTrace();
        }

        return $this->sendError($error_message, 422, $params);
    }

    /** Error JSON ответ
     * @param string $error
     * @param int|null $code
     * @param array $data
     * @return JsonResponse
     */
    public function sendError(string $error, ?int $code = 403, array $data = []): JsonResponse
    {
        return Response::json(self::makeResponse(false, $error, $data), $code);
    }

    public static function sendResponseStatic($data, ?string $message = '', ?int $code = 200): JsonResponse
    {
        return Response::json(self::makeResponse(true, $message, $data), $code);
    }

    public static function sendErrorStatic($error, $code = 403, $data = []): JsonResponse
    {
        return Response::json(self::makeResponse(false, $error, $data), $code);
    }

    protected static function makeResponse(bool $success, ?string $message = '', $data = []): array
    {
        $result = [
            'success' => $success,
        ];

        if (!empty($data)) {
            $result['data'] = $data;
        }

        if (!empty($message)) {
            $result['message'] = $message;
        }

        return $result;
    }

}
