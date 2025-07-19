<?php

$queries = [
    "pgsql" => [
        "CREATE TABLE IF NOT EXISTS utilisateur (
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
        )",

        "CREATE TABLE IF NOT EXISTS compte (
            id SERIAL PRIMARY KEY,
            numero_tel VARCHAR(20) NOT NULL UNIQUE,
            solde NUMERIC(15, 2) DEFAULT 0.00,
            is_default BOOLEAN DEFAULT FALSE,
            id_utilisateur INT NOT NULL REFERENCES utilisateur(id),
            date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )",

        "CREATE TABLE IF NOT EXISTS transaction (
            id SERIAL PRIMARY KEY,
            date_transaction TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            montant NUMERIC(15, 2) NOT NULL,
            type_transaction VARCHAR(20) CHECK (type_transaction IN ('PAIEMENT', 'TRANSFERT')) NOT NULL,
            id_compte_source INT NOT NULL REFERENCES compte(id),
            id_compte_destination INT REFERENCES compte(id),
            type_transfert VARCHAR(20) CHECK (type_transfert IN ('DEPOT', 'RETRAIT')),
            beneficiaire VARCHAR(100),
            reference_paiement VARCHAR(50)
        )"
    ],

    "mysql" => [
        "CREATE TABLE IF NOT EXISTS utilisateur (
            id INT AUTO_INCREMENT PRIMARY KEY,
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
        )",

        "CREATE TABLE IF NOT EXISTS compte (
            id INT AUTO_INCREMENT PRIMARY KEY,
            numero_tel VARCHAR(20) NOT NULL UNIQUE,
            solde DECIMAL(15, 2) DEFAULT 0.00,
            is_default BOOLEAN DEFAULT FALSE,
            id_utilisateur INT NOT NULL,
            date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id)
        )",

        "CREATE TABLE IF NOT EXISTS transaction (
            id INT AUTO_INCREMENT PRIMARY KEY,
            date_transaction TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            montant DECIMAL(15, 2) NOT NULL,
            type_transaction VARCHAR(20) CHECK (type_transaction IN ('PAIEMENT', 'TRANSFERT')) NOT NULL,
            id_compte_source INT NOT NULL,
            id_compte_destination INT,
            type_transfert VARCHAR(20) CHECK (type_transfert IN ('DEPOT', 'RETRAIT')),
            beneficiaire VARCHAR(100),
            reference_paiement VARCHAR(50),
            FOREIGN KEY (id_compte_source) REFERENCES compte(id),
            FOREIGN KEY (id_compte_destination) REFERENCES compte(id)
        )"
    ]
];
