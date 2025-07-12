<?php
namespace MAXITSA\ENTITY;

class Transfert extends Transaction {
    private TypeTransfert $type_transfert;
    private Compte $compteDestinataire;

    // Getters
    public function getTypeTransfert(): TypeTransfert {
        return $this->type_transfert;
    }

    public function getCompteDestinataire(): Compte {
        return $this->compteDestinataire;
    }

    // Setters
    public function setTypeTransfert(TypeTransfert $type): void {
        $this->type_transfert = $type;
    }

    public function setCompteDestinataire(Compte $compte): void {
        $this->compteDestinataire = $compte;
    }

    public static function toObject(array $data): static {
        $obj = new static();
        $obj->setId($data['id']);
        $obj->setDateDebit($data['date_debit']);
        $obj->setMontant((float)$data['montant']);
        $obj->setTypeTransaction(TypeTransaction::from($data['type_transaction']));
        $obj->setTypeTransfert(TypeTransfert::from($data['type_transfert']));
        $obj->setCompteSource(Compte::toObject(['id' => $data['id_compte_source']])); 
        $obj->setCompteDestinataire(Compte::toObject(['id' => $data['id_compte_destinataire']]));

        return $obj;
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'type_transaction' => $this->dateDebit,
            'montant' => $this->montant,
            'type_transaction' => $this->type_transaction->value,
            'type_transfert' => $this->type_transfert->value,
            'id_compte_source' => $this->compte_source->getId(),
            'id_compte_destinataire' => $this->compteDestinataire->getId()
        ];
    }
}
