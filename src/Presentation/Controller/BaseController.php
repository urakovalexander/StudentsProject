<?php
namespace App\Presentation\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class BaseController extends AbstractController
{
    protected function getJsonData(Request $request): array
    {
        $data = json_decode($request->getContent(), true);
        return is_array($data) ? $data : [];
    }

    protected function jsonError(string $message, int $status = 400): JsonResponse
    {
        return new JsonResponse(['error' => $message], $status);
    }

    protected function jsonSuccess(array $data, int $status = 200): JsonResponse
    {
        return new JsonResponse($data, $status);
    }
}
