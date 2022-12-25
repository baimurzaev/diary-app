<?php

namespace App\Http\Controllers;

use App\Domain\Generate\Constants;
use App\Domain\Generate\GenerateUsers;
use App\Models\Classroom;
use App\Models\ClassroomUser;
use App\Services\Generate\ClassroomService;
use App\Services\Generate\GroupsService;
use App\Services\Generate\SubjectsService;
use App\Services\Generate\UsersService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

final class GenerateController extends Controller
{
    /**
     * @return string
     */
    public function generateAll(): string
    {
        $this->createSubjects();

        $this->createClassrooms();

        $this->createGroups();

        $this->createUsers();

        $this->createLinkUserToClassroom();

        return 'Сущности успешно сгенерированны!';
    }

    public function createLinkUserToClassroom()
    {
        foreach (Classroom::all() as $classroom) {
            ClassroomUser::create([
                'user_id' => Auth::id(),
                'classroom_id' => $classroom->id
            ]);
        }
    }

    public function createGroups(): void
    {
        $service = new GroupsService();
        $service->createGroups();
    }

    /**
     * @return void
     */
    public function createUsers(): void
    {
        $service = new UsersService();
        $service->createTeachers(2);

        $service->createPupils(30);
    }

    /**
     * @return void
     */
    public function createSubjects(): void
    {
        $service = new SubjectsService();
        $service->create();
    }

    public function createClassrooms(): void
    {
        $service = new ClassroomService();
        $service->create();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function generatePupils(Request $request): JsonResponse
    {
        if ($request->isMethod('post')) {
            $classroomId = (int)$request->id;

            if ($classroomId > 0) {
                $classroom = Classroom::find($classroomId);

                if ($classroom) {
                    $service = new UsersService();
                    $service->generatePupilsForClassroom($classroomId);
                }

                return response()->json(['status' => "ok"]);
            }
        }

        return response()->json(['status' => "err"]);
    }
}
