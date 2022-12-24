<?php

namespace App\Domain\Generate;

final class GenerateName
{
    /**
     * @return string
     */
    public function firstName(): string
    {
        return $this->random(Constants::MALE_FIRST_NAMES);
    }

    /**
     * @return string
     */
    public function middleName(): string
    {
        return $this->random(Constants::MALE_MIDDLE_NAME);
    }

    /**
     * @return string
     */
    public function lastName(): string
    {
        return $this->random(Constants::MALE_LAST_NAMES);
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
