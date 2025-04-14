<?php
namespace App\Presentation\Controller;

use App\Application\Exception\LoginAlreadyExistsException;
use App\Application\UseCase\GetStudentsWithoutGroup;
use App\Application\UseCase\RegisterStudent;
use App\Presentation\ViewModel\StudentView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class StudentController extends BaseController
{
    #[Route('/register', name: 'student_register', methods: ['POST'])]
    public function register(Request $request, RegisterStudent $registerStudent): JsonResponse
    {
        $data = $this->getJsonData($request);

        if (empty($data['login']) || empty($data['name']) || empty($data['password'])) {
            return $this->jsonError('Missing parameters');
        }

        try {
            $student = $registerStudent->handle(
                $data['login'],
                $data['name'],
                $data['password']
            );
        } catch (LoginAlreadyExistsException $e) {
            return $this->jsonError($e->getMessage(), 409); // HTTP 409 Conflict
        }

        $view = new StudentView(
            id: $student->id,
            name: $student->name,
            login: $student->login
        );

        return $this->jsonSuccess($view->toArray(), 201);
    }

    #[Route('/students-without-group', name: 'students_without_group', methods: ['GET'])]
    public function getStudentsWithoutGroup(GetStudentsWithoutGroup $useCase): JsonResponse
    {
        $students = $useCase->handle();

        $views = array_map(
            fn($dto) => (new StudentView($dto->id, $dto->name, $dto->login))->toArray(),
            $students
        );

        return $this->jsonSuccess($views);
    }

}
