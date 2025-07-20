<?php

namespace MAXITSA\ENTITY;


class Client extends Utilisateur
{
    private string $prenom;
    private string $nom;
    private string $cni;
    private string $cni_recto;
    private string $cni_verso;
    private string $adresse;

    public static function toObject(array $data): static
    {
        $client = new static();

        $client->setId($data['id_utilisateur'] ?? $data['id'] ?? '');
        $client->setPassword($data['password'] ?? '');
        $client->setTypeUser(TypeUser::from($data['type']));
        $client->prenom = $data['prenom'] ?? '';
        $client->nom = $data['nom'] ?? '';
        $client->cni = $data['cni'] ?? '';
        $client->cni_recto = $data['cni_recto'] ?? '';
        $client->cni_verso = $data['cni_verso'] ?? '';
        $client->adresse = $data['adresse'] ?? '';

        return $client;
    }

    public function toArray(): array
    {
        
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'cni' => $this->cni,
            'cni_recto' => $this->cni_recto,
            'cni_verso' => $this->cni_verso,
            'adresse' => $this->adresse,
            'type' => $this->getTypeUser()->value,
            'password' => $this->getPassword()
        ];
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function getCni(): string
    {
        return $this->cni;
    }

    public function setCni(string $cni): void
    {
        $this->cni = $cni;
    }

    public function getCniRecto(): string
    {
        return $this->cni_recto;
    }

    public function setCniRecto(string $cni_recto): void
    {
        $this->cni_recto = $cni_recto;
    }

    public function getCniVerso(): string
    {
        return $this->cni_verso;
    }

    public function setCniVerso(string $cni_verso): void
    {
        $this->cni_verso = $cni_verso;
    }

    public function getAdresse(): string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): void
    {
        $this->adresse = $adresse;
    }
}
