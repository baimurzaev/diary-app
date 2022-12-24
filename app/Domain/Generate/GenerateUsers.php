<?php

namespace App\Domain\Generate;

class GenerateUsers
{
    /**
     * @param int $amount
     * @param int $groupId
     * @return array
     */
    public static function create(int $amount = 10, int $groupId = 2): array
    {
        $data = [];
        $generate = new GenerateName();

        for ($i = 1; $i <= $amount; $i++) {
            $data[] = [
                'name' => $generate->firstName(),
                'email' => sprintf("user%s_g%s@mail.ru", $i, $groupId),
                'password' => '',
                'middle_name' => $generate->middleName(),
                'last_name' => $generate->lastName(),
                'group_id' => $groupId,
            ];
        }

        return $data;
    }
}