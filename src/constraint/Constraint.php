<?php

namespace App\src\constraint;

class constraint
{
    public function notBlank($name, $value)
    {
        if (empty($value)) {
            return '<p>Le champs <i>' .$name. '</i> saisi est vide</p>';
        }
    }

    public function minLength($name, $value, $minSize)
    {
        if (strlen($value)< $minSize) {
            return '<p>Le champs <i>'  .$name. '</i> doit contenir au moins <strong>' .$minSize. '</strong> caratères</p>';
        }
    }

    public function maxLength($name, $value, $maxLength)
    {
        if (strlen($value)> $maxLength) {
            return '<p>Le champs <i>' .$name. '</i> doit contenir au maximum <strong>' .$maxLength. '</strong caractères</p>';
        }
    }
}