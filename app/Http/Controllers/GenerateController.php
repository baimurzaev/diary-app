<?php

namespace App\Http\Controllers;

use App\Services\Generate\GroupsService;
use App\Services\Generate\SubjectsService;
use App\Services\Generate\UsersService;

class GenerateController extends Controller
{

    /**
     * @return void
     */
    public function generateAll(): void
    {
        $this->createUsers();
        $this->createGroups();
        $this->createSubjects();
        $this->createClassrooms();
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
        $service->createPupils();
        $service->createTeachers();
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
        $service = new SubjectsService();
        $service->create();
    }
}
