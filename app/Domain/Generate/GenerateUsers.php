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
            $genderType = rand(Constants::GENDER_MALE, Constants::GENDER_FEMALE);
            $data[] = [
                'email' => sprintf("%s@mail.ru", mb_substr(md5(microtime(true) . $i), 1, 16)),
                'password' => Hash::make(Constants::GEN_PASSWORD),
                'name' => $userGenerate->firstName($genderType),
                'middle_name' => $userGenerate->middleName($genderType),
                'last_name' => $userGenerate->lastName($genderType),
                'group_id' => $groupId,
            ];
        }

        return $data;
    }
}
