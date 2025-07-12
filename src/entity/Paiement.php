<?php
namespace MAXITSA\ENTITY;

class Paiement extends Transaction {
    private string $reference_paiement;
    private string $beneficiaire;

    // Getters
    public function getReferencePaiement(): string {
        return $this->reference_paiement;
    }

    public function getBeneficiaire(): string {
        return $this->beneficiaire;
    }

    // Setters
    public function setReferencePaiement(string $ref): void {
        $this->reference_paiement = $ref;
    }

    public function setBeneficiaire(string $beneficiaire): void {
        $this->beneficiaire = $beneficiaire;
    }

    public static function toObject(array $data): static {
        $obj = new static();
        $obj->setId($data['id']);
        $obj->setDateDebit($data['date_transaction']);
        $obj->setMontant((float)$data['montant']);
        $obj->setTypeTransaction(TypeTransaction::from($data['type_transaction']));
        $obj->setReferencePaiement($data['reference_paiement']);
        $obj->setBeneficiaire($data['beneficiaire']);
        $obj->setCompteSource(Compte::toObject(['id' => $data['id_compte_source']]));

        return $obj;
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'type_transaction' => $this->dateDebit,
            'montant' => $this->montant,
            'type_transaction' => $this->type_transaction->value,
            'reference_paiement' => $this->reference_paiement,
            'beneficiaire' => $this->beneficiaire,
            'id_compte_source' => $this->compte_source->getId()
        ];
    }
}
