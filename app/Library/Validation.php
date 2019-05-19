<?php

namespace App\Library;

trait Validation
{
    public function required($data = [], $remove = [])
    {
        $empty = [];
        foreach ($data as $key => $value) {
            if (!in_array($key, $remove)) {
                if (empty($value)) {
                    $empty[$key] = ucfirst(str_replace('_', ' ', $key).' field is required');
                }
            }
        }
        return $empty;
    }

    public function filter($data = [])
    {
        $filtered = [];
        foreach ($data as $key => $value) {
            $item = trim($value);
            $item = stripslashes($item);
            $item = htmlspecialchars($item);
            $filtered[$key] = $item;
        }
        return $filtered;
    }

    public function validateEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 'Email address invalid !';
        }
    }

}