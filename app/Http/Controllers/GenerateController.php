<?php

namespace App\Http\Controllers;

use App\Services\Generate\ClassroomService;
use App\Services\Generate\GroupsService;
use App\Services\Generate\SubjectsService;
use App\Services\Generate\UsersService;

class GenerateController extends Controller
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

        return 'Сущности успешно сгенерированны!';
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
        $service->createPupils(20);
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
}
