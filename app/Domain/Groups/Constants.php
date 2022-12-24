<?php

namespace App\Domain\Groups;

final class Constants
{
    const TEACHER = 1;
    const PUPIL = 2;
    const ADMINISTRATOR = 3;

    /**
     * @var array|string[]
     */
    public static array $types = [
        self::TEACHER => 'Учитель',
        self::PUPIL => 'Ученик',
        self::ADMINISTRATOR => 'Администратор'
    ];
}
