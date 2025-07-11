<?php

namespace APP\CORE;


class Validator
{
    private array $errors = [];

    public function isRequired(string $field, ?string $value): bool
    {
        $rs = empty($value);
        if ($rs) {
            $this->errors[$field][] = "Le champ $field est requis.";
            return false;
        }
        return true;
    }

    public function isEmail(string $field, string $value): bool
    {
        $rs = filter_var($value, FILTER_VALIDATE_EMAIL);

        if (!$rs) {
            $this->errors[$field][] = "Le champ $field doit être un email valide.";
            return false;
        }
        return true;
    }

    public function isPhone(string $field, string $value): bool
    {
        $rs = preg_match('/^\d{9,15}$/', $value);
        if (!$rs) {
            $this->errors[$field][] = "Le champ $field doit être un numéro de téléphone valide.";
            return false;
        }
        return true;
    }

    public function minLength(string $field, string $value, int $length): void
    {
        if (strlen($value) < $length) {
            $this->errors[$field][] = "Le champ $field doit contenir au moins $length caractères.";
        }
    }

    public function isSame(string $field, string $value, string $fieldToCompare, string $valueToCompare): void
    {
        if ($value !== $valueToCompare) {
            $this->errors[$field][] = "Le champ $field doit être identique au champ $fieldToCompare.";
        }
    }

    

    public function isAlphaNumeric(string $field, string $value): void
    {
        if (!ctype_alnum($value)) {
            $this->errors[$field][] = "Le champ $field doit être alphanumérique.";
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    public function hasError(string $key): bool
    {
        return array_key_exists($key, $this->errors);
    }
}
