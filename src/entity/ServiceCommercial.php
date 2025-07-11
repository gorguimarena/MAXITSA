<?php
namespace MAXITSA\ENTITY;

class ServiceCommercial extends Utilisateur {
    private string $email;

    public static function toObject(array $data): static {
        $sc = new static();

        $sc->setPassword($data['password']);
        $sc->setTypeUser(TypeUser::from($data['type']));
        $sc->email = $data['email'];

        return $sc;
    }

    public function toArray(): array {
        return [
            'email' => $this->email,
            'type' => $this->getTypeUser()->value,
            'password' => $this->getPassword()
        ];
    }

    public function getEmail(): string {
        return $this->email;
    }
}
