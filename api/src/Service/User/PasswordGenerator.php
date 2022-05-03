<?php

namespace App\Service\User;

use Exception;
use LogicException;
use RangeException;

class PasswordGenerator
{
    const chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const specialChars = '@$?!#';

    public function generate(int $length = 8): string
    {
        if ($length < 6 || $length > 15) {
            throw new RangeException('Password length must lay between 6 and 15');
        }

        $pieces = [];
        $max = mb_strlen(self::chars, '8bit') - 1;
        $maxSpecial = mb_strlen(self::specialChars, '8bit') - 1;

        try {
            for ($i = 0; $i < $length - 1; ++$i) {
                $pieces [] = self::chars[random_int(0, $max)];
            }
            $pieces [] = self::specialChars[random_int(0, $maxSpecial)];
            shuffle($pieces);
        } catch (Exception $exception) {
            throw new LogicException();
        }

        return implode('', $pieces);
    }
}
