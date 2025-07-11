DO $$
BEGIN
   IF NOT EXISTS (
      SELECT FROM pg_database WHERE datname = 'maxitsa'
   ) THEN
      CREATE DATABASE maxitsa;
   END IF;
END
$$;


\c maxitsa;

-- TABLE utilisateur
CREATE TABLE utilisateur (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    type VARCHAR(20) CHECK (type IN ('CLIENT', 'SERVICE_COMMERCIAL')) NOT NULL,
    adresse VARCHAR(255),
    cni VARCHAR(20),
    cni_recto VARCHAR(255),
    cni_verso VARCHAR(255),
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- TABLE compte
CREATE TABLE compte (
    id SERIAL PRIMARY KEY,
    numero_tel VARCHAR(20) NOT NULL UNIQUE,
    solde NUMERIC(15, 2) DEFAULT 0.00,
    is_default BOOLEAN DEFAULT FALSE,
    id_utilisateur INT NOT NULL REFERENCES utilisateur(id),
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- TABLE transaction
CREATE TABLE transaction (
    id SERIAL PRIMARY KEY,
    date_transaction TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    montant NUMERIC(15, 2) NOT NULL,
    type_transaction VARCHAR(20) CHECK (type_transaction IN ('PAIEMENT', 'TRANSFERT')) NOT NULL,
    
    id_compte_source INT NOT NULL REFERENCES compte(id),
    id_compte_destination INT REFERENCES compte(id),
    type_transfert VARCHAR(20) CHECK (type_transfert IN ('DEPOT', 'RETRAIT')),
    
    beneficiaire VARCHAR(100),
    reference_paiement VARCHAR(50)
);
