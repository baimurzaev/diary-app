<?php

namespace App\Domain\Generate;

use Illuminate\Support\Facades\Hash;

class GenerateUsers
{
    /**
     * @param int $amount
     * @param int $groupId
     * @return array
     */
    public static function generate(int $amount, int $groupId): array
    {
        $data = [];
        $userGenerate = new GenerateName();

        for ($i = 1; $i <= $amount; $i++) {
            $data[] = [
                'name' => $userGenerate->firstName(),
                'email' => sprintf("user%s_g%s@mail.ru", $i, $groupId),
                'password' => Hash::make('12341234'),
                'middle_name' => $userGenerate->middleName(),
                'last_name' => $userGenerate->lastName(),
                'group_id' => $groupId,
            ];
        }

        return $data;
    }
}
