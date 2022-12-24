<?php

namespace App\Domain\Groups;

final class Constants
{
    const GROUP_TEACHER = 1;
    const GROUP_PUPIL = 2;
    const GROUP_ADMINISTRATOR = 3;

    /**
     * @var array|string[]
     */
    public static array $types = [
        self::GROUP_TEACHER => 'Учитель',
        self::GROUP_PUPIL => 'Ученик',
        self::GROUP_ADMINISTRATOR => 'Администратор'
    ];
}
