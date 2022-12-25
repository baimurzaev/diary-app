<?php

namespace App\Domain\Generate;

final class GenerateName
{
    /**
     * @param $genderType
     * @return string
     */
    public function firstName($genderType): string
    {
        $list = ($genderType == 1) ? Constants::MALE_FIRST_NAMES : Constants::FEMALE_FIRST_NAMES;

        return $this->random($list);
    }

    /**
     * @return string
     */
    public function middleName($genderType): string
    {
        $list = ($genderType == 1) ? Constants::MALE_MIDDLE_NAME : Constants::FEMALE_MIDDLE_NAME;

        return $this->random($list);
    }

    /**
     * @return string
     */
    public function lastName($genderType): string
    {
        $list = ($genderType == 1) ? Constants::MALE_LAST_NAMES : Constants::FEMALE_LAST_NAMES;

        return $this->random($list);
    }

    /**
     * @return string
     */
    public function getFullname(): string
    {
        return sprintf('%s %s %s', $this->lastName(), $this->firstName(), $this->middleName());
    }

    /**
     * @param $data
     * @return string
     */
    private function random($data): string
    {
        return $data[array_rand($data)];
    }
}
