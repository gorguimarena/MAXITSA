<?php

namespace APP\CORE;

use APP\CORE\ENUM\ValidatorMessage;

class Validator
{
    private array $errors = [];

    public function isRequired(string $field, ?string $value): bool
    {
        $rs = empty($value);
        if ($rs) {
            $this->errors[$field][] = ValidatorMessage::REQUIRED->format([
                'field' => $field
            ]);
            return false;
        }
        return true;
    }

    public function isEmail(string $field, string $value): bool
    {
        $rs = filter_var($value, FILTER_VALIDATE_EMAIL);
        if (!$rs) {
            $this->errors[$field][] = ValidatorMessage::EMAIL->format([
                'field' => $field
            ]);
            return false;
        }
        return true;
    }

    public function isPhone(string $field, string $value): bool
    {
        $rs = preg_match('/^\d{9,15}$/', $value);
        if (!$rs) {
            $this->errors[$field][] = ValidatorMessage::PHONE->format([
                'field' => $field
            ]);
            return false;
        }
        return true;
    }

    public function minLength(string $field, string $value, int $length): void
    {
        if (strlen($value) < $length) {
            $this->errors[$field][] = ValidatorMessage::MIN_LENGTH->format([
                'field' => $field,
                'length' => $length
            ]);
        }
    }

    public function isSame(string $field, string $value, string $fieldToCompare, string $valueToCompare): void
    {
        if ($value !== $valueToCompare) {
            $this->errors[$field][] = ValidatorMessage::SAME->format([
                'field' => $field,
                'otherField' => $fieldToCompare
            ]);
        }
    }

    public function isAlphaNumeric(string $field, string $value): void
    {
        if (!ctype_alnum($value)) {
            $this->errors[$field][] = ValidatorMessage::ALPHA_NUM->format([
                'field' => $field
            ]);
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
