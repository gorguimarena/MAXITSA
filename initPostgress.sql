CREATE DATABASE maxitsa;

USE maxitsa;
-- TABLE utilisateur
CREATE TABLE utilisateur (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    type VARCHAR(20) CHECK (type IN ('client', 'service_commercial')) NOT NULL,
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
    type_transaction VARCHAR(20) CHECK (type_transaction IN ('paiement', 'transfert')) NOT NULL,
    
    id_compte_source INT NOT NULL REFERENCES compte(id),
    id_compte_destination INT REFERENCES compte(id),
    type_transfert VARCHAR(20) CHECK (type_transfert IN ('depot', 'retrait')),
    
    beneficiaire VARCHAR(100),
    reference_paiement VARCHAR(50)
);

-- Clients
INSERT INTO utilisateur (nom, prenom, password, type, adresse, cni, cni_recto, cni_verso) VALUES
('Dupont', 'Jean', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'client', '12 Rue de Paris, 75001', '1234567890', 'dupont_recto.jpg', 'dupont_verso.jpg'),
('Martin', 'Sophie', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'client', '34 Avenue des Champs, 75008', '0987654321', 'martin_recto.jpg', 'martin_verso.jpg'),
('Bernard', 'Pierre', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'client', '56 Boulevard Saint-Germain, 75005', '1122334455', 'bernard_recto.jpg', 'bernard_verso.jpg');

-- Service Commercial
INSERT INTO utilisateur (nom, prenom, password, email, type) VALUES
('Leroy', 'Alice', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'a.leroy@maxitsa.com', 'service_commercial'),
('Petit', 'Thomas', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 't.petit@maxitsa.com', 'service_commercial');

-- Comptes principaux
INSERT INTO compte (numero_tel, solde, is_default, id_utilisateur) VALUES
('0612345678', 1500.00, TRUE, 1),
('0698765432', 2300.50, TRUE, 2),
('0711223344', 500.00, TRUE, 3);

-- Comptes secondaires
INSERT INTO compte (numero_tel, solde, is_default, id_utilisateur) VALUES
('0622334455', 200.00, FALSE, 1),
('0644556677', 0.00, FALSE, 1),
('0688990011', 750.25, FALSE, 2),
('0633445566', 100.00, FALSE, 3);

-- Transactions
INSERT INTO transaction (date_transaction, montant, type_transaction, id_compte_source, beneficiaire, reference_paiement) VALUES
('2023-01-15 12:00:00', 45.90, 'paiement', 1, 'EDF', 'FACT-EDF-001'),
('2023-01-16 08:30:00', 29.99, 'paiement', 2, 'SFR', 'FACT-SFR-002'),
('2023-01-17 17:45:00', 15.50, 'paiement', 3, 'Carrefour', 'CB-20230117'),
('2023-01-18 13:20:00', 120.00, 'paiement', 1, 'Free Mobile', 'FACT-FREE-003'),
('2023-01-19 09:10:00', 60.00, 'paiement', 2, 'Amazon', 'CMD-AMZ-456');
