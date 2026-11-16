
-- ================================================================
-- BASE DE DONNEES : PRESSING_APP
-- Application de gestion de pressing
-- SGBD : MySQL 8.0
-- Framework : CakePHP 5
-- Encodage : UTF8MB4
-- Moteur : InnoDB
-- Devise : FCFA (montants entiers)
-- ================================================================

CREATE DATABASE IF NOT EXISTS pressing_app
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE pressing_app;

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ================================================================
-- 0. SUPPRESSION DES ANCIENNES STRUCTURES
-- ================================================================

DROP VIEW IF EXISTS v_monthly_revenue;
DROP VIEW IF EXISTS v_delivery_schedule;
DROP VIEW IF EXISTS v_overdue_orders;
DROP VIEW IF EXISTS v_unpaid_orders;
DROP VIEW IF EXISTS v_daily_cash_register;
DROP VIEW IF EXISTS v_order_balances;

DROP TRIGGER IF EXISTS trg_payments_before_insert;
DROP TRIGGER IF EXISTS trg_payments_before_update;

DROP TABLE IF EXISTS notifications;
DROP TABLE IF EXISTS order_status_histories;
DROP TABLE IF EXISTS payments;
DROP TABLE IF EXISTS deliveries;
DROP TABLE IF EXISTS couriers;
DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS tariffs;
DROP TABLE IF EXISTS services;
DROP TABLE IF EXISTS article_types;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS clients;

SET FOREIGN_KEY_CHECKS = 1;

-- ================================================================
-- 1. TABLE : clients
-- ================================================================

CREATE TABLE clients (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    phone VARCHAR(30) NOT NULL UNIQUE,
    address VARCHAR(255) DEFAULT NULL,
    neighborhood VARCHAR(100) DEFAULT NULL,

    created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ================================================================
-- 2. TABLE : users
-- ================================================================

CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    username VARCHAR(80) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,

    role VARCHAR(30) NOT NULL
        CHECK (role IN ('gerant', 'caissier', 'operateur')),

    is_active TINYINT(1) NOT NULL DEFAULT 1
        CHECK (is_active IN (0, 1)),

    created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ================================================================
-- 3. TABLE : article_types
-- ================================================================

CREATE TABLE article_types (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(100) NOT NULL UNIQUE,

    created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ================================================================
-- 4. TABLE : services
-- ================================================================

CREATE TABLE services (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(100) NOT NULL UNIQUE,

    created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ================================================================
-- 5. TABLE : tariffs
-- ================================================================

CREATE TABLE tariffs (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    article_type_id INT UNSIGNED NOT NULL,
    service_id INT UNSIGNED NOT NULL,

    price INT UNSIGNED NOT NULL DEFAULT 0,

    created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_tariffs_article_types
        FOREIGN KEY (article_type_id)
        REFERENCES article_types(id),

    CONSTRAINT fk_tariffs_services
        FOREIGN KEY (service_id)
        REFERENCES services(id),

    CONSTRAINT uq_tariffs_article_service
        UNIQUE (article_type_id, service_id)
) ENGINE=InnoDB;

-- ================================================================
-- 6. TABLE : orders
-- ================================================================

CREATE TABLE orders (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    ticket_number VARCHAR(50) NOT NULL UNIQUE,

    client_id INT UNSIGNED NOT NULL,
    user_id INT UNSIGNED NOT NULL,

    deposited_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    pickup_due_at DATE DEFAULT NULL,
    picked_up_at DATETIME DEFAULT NULL,

    status VARCHAR(30) NOT NULL DEFAULT 'recue'
        CHECK (
            status IN (
                'recue',
                'en_cours',
                'prete',
                'livree',
                'annulee'
            )
        ),

    discount INT UNSIGNED NOT NULL DEFAULT 0,

    observation TEXT DEFAULT NULL,

    created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_orders_clients
        FOREIGN KEY (client_id)
        REFERENCES clients(id),

    CONSTRAINT fk_orders_users
        FOREIGN KEY (user_id)
        REFERENCES users(id),

    INDEX idx_orders_client (client_id),
    INDEX idx_orders_user (user_id),
    INDEX idx_orders_status (status),
    INDEX idx_orders_deposited_at (deposited_at),
    INDEX idx_orders_pickup_due_at (pickup_due_at)
) ENGINE=InnoDB;

-- ================================================================
-- 7. TABLE : order_items
-- ================================================================

CREATE TABLE order_items (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    order_id INT UNSIGNED NOT NULL,
    article_type_id INT UNSIGNED NOT NULL,
    service_id INT UNSIGNED NOT NULL,

    quantity INT UNSIGNED NOT NULL,

    -- Prix historique appliqué au moment de la commande
    unit_price INT UNSIGNED NOT NULL,

    reception_condition TEXT DEFAULT NULL,

    created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_order_items_orders
        FOREIGN KEY (order_id)
        REFERENCES orders(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_order_items_article_types
        FOREIGN KEY (article_type_id)
        REFERENCES article_types(id),

    CONSTRAINT fk_order_items_services
        FOREIGN KEY (service_id)
        REFERENCES services(id),

    CHECK (quantity > 0),

    INDEX idx_order_items_order (order_id)
) ENGINE=InnoDB;

-- ================================================================
-- 8. TABLE : payments
-- ================================================================

CREATE TABLE payments (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    order_id INT UNSIGNED NOT NULL,
    user_id INT UNSIGNED NOT NULL,

    amount INT UNSIGNED NOT NULL,

    payment_method VARCHAR(30) NOT NULL
        CHECK (
            payment_method IN (
                'especes',
                'mobile_money',
                'autre'
            )
        ),

    paid_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_payments_orders
        FOREIGN KEY (order_id)
        REFERENCES orders(id),

    CONSTRAINT fk_payments_users
        FOREIGN KEY (user_id)
        REFERENCES users(id),

    CHECK (amount > 0),

    INDEX idx_payments_order (order_id),
    INDEX idx_payments_user (user_id),
    INDEX idx_payments_paid_at (paid_at)
) ENGINE=InnoDB;

-- ================================================================
-- 9. TABLE : order_status_histories
-- ================================================================

CREATE TABLE order_status_histories (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    order_id INT UNSIGNED NOT NULL,
    user_id INT UNSIGNED NOT NULL,

    old_status VARCHAR(30) DEFAULT NULL,
    new_status VARCHAR(30) NOT NULL,

    changed_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_status_histories_orders
        FOREIGN KEY (order_id)
        REFERENCES orders(id),

    CONSTRAINT fk_status_histories_users
        FOREIGN KEY (user_id)
        REFERENCES users(id),

    INDEX idx_status_histories_order (order_id)
) ENGINE=InnoDB;

-- ================================================================
-- 10. TABLE : notifications
-- ================================================================

CREATE TABLE notifications (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    order_id INT UNSIGNED NOT NULL,

    channel VARCHAR(30) NOT NULL
        CHECK (
            channel IN ('sms', 'appel', 'whatsapp')
        ),

    message TEXT DEFAULT NULL,

    sent_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_notifications_orders
        FOREIGN KEY (order_id)
        REFERENCES orders(id),

    INDEX idx_notifications_order (order_id)
) ENGINE=InnoDB;

-- ================================================================
-- 11. TABLE : couriers
-- ================================================================

CREATE TABLE couriers (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    name VARCHAR(150) NOT NULL,
    phone VARCHAR(30) NOT NULL UNIQUE,

    is_active TINYINT(1) NOT NULL DEFAULT 1
        CHECK (is_active IN (0, 1)),

    created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ================================================================
-- 12. TABLE : deliveries
-- ================================================================

CREATE TABLE deliveries (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    order_id INT UNSIGNED NOT NULL,
    courier_id INT UNSIGNED DEFAULT NULL,

    delivery_type VARCHAR(30) NOT NULL
        CHECK (
            delivery_type IN ('collecte', 'livraison')
        ),

    address VARCHAR(255) NOT NULL,

    fee INT UNSIGNED NOT NULL DEFAULT 0,

    scheduled_at DATETIME NOT NULL,
    completed_at DATETIME DEFAULT NULL,

    status VARCHAR(30) NOT NULL DEFAULT 'planifiee'
        CHECK (
            status IN (
                'planifiee',
                'en_cours',
                'effectuee',
                'echec',
                'annulee'
            )
        ),

    created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_deliveries_orders
        FOREIGN KEY (order_id)
        REFERENCES orders(id),

    CONSTRAINT fk_deliveries_couriers
        FOREIGN KEY (courier_id)
        REFERENCES couriers(id)
        ON DELETE SET NULL,

    INDEX idx_deliveries_order (order_id),
    INDEX idx_deliveries_courier (courier_id),
    INDEX idx_deliveries_scheduled_at (scheduled_at),
    INDEX idx_deliveries_status (status)
) ENGINE=InnoDB;

-- ================================================================
-- 13. VUE : SOLDE DES COMMANDES
-- ================================================================

CREATE OR REPLACE VIEW v_order_balances AS
SELECT
    t.*,

    (t.items_amount - t.discount + t.delivery_fees)
        AS total,

    (t.items_amount - t.discount + t.delivery_fees - t.paid)
        AS remaining_balance

FROM (
    SELECT
        o.id,
        o.ticket_number,
        o.client_id,
        c.name AS client_name,
        c.phone AS client_phone,

        o.deposited_at,
        o.pickup_due_at,
        o.status,
        o.discount,

        COALESCE((
            SELECT SUM(oi.quantity * oi.unit_price)
            FROM order_items oi
            WHERE oi.order_id = o.id
        ), 0) AS items_amount,

        COALESCE((
            SELECT SUM(d.fee)
            FROM deliveries d
            WHERE d.order_id = o.id
              AND d.status <> 'annulee'
        ), 0) AS delivery_fees,

        COALESCE((
            SELECT SUM(p.amount)
            FROM payments p
            WHERE p.order_id = o.id
        ), 0) AS paid

    FROM orders o
    INNER JOIN clients c ON c.id = o.client_id

) AS t;

-- ================================================================
-- 14. VUE : CAISSE JOURNALIERE
-- ================================================================

CREATE OR REPLACE VIEW v_daily_cash_register AS
SELECT
    DATE(paid_at) AS day,
    payment_method,
    COUNT(*) AS payment_count,
    SUM(amount) AS total_collected

FROM payments

GROUP BY DATE(paid_at), payment_method;

-- ================================================================
-- 15. VUE : COMMANDES IMPAYEES
-- ================================================================

CREATE OR REPLACE VIEW v_unpaid_orders AS
SELECT
    id,
    ticket_number,
    client_name,
    client_phone,
    status,
    total,
    paid,
    remaining_balance

FROM v_order_balances

WHERE remaining_balance > 0
AND status <> 'annulee';

-- ================================================================
-- 16. VUE : COMMANDES EN RETARD
-- ================================================================

CREATE OR REPLACE VIEW v_overdue_orders AS
SELECT
    id,
    ticket_number,
    client_name,
    client_phone,
    status,
    pickup_due_at,

    DATEDIFF(CURDATE(), pickup_due_at) AS days_late

FROM v_order_balances

WHERE status IN ('recue', 'en_cours', 'prete')
AND pickup_due_at < CURDATE();

-- ================================================================
-- 17. VUE : PLANNING DES COLLECTES ET LIVRAISONS
-- ================================================================

CREATE OR REPLACE VIEW v_delivery_schedule AS
SELECT
    d.id,
    d.order_id,
    d.scheduled_at,
    d.delivery_type,

    o.ticket_number,

    c.name AS client_name,
    c.phone AS client_phone,

    d.address,
    d.fee,

    COALESCE(cr.name, 'Non affecte') AS courier_name,

    d.status

FROM deliveries d

INNER JOIN orders o
    ON o.id = d.order_id

INNER JOIN clients c
    ON c.id = o.client_id

LEFT JOIN couriers cr
    ON cr.id = d.courier_id

WHERE d.status IN ('planifiee', 'en_cours');

-- ================================================================
-- 18. VUE : CHIFFRE D'AFFAIRES MENSUEL
-- ================================================================

CREATE OR REPLACE VIEW v_monthly_revenue AS
SELECT
    DATE_FORMAT(deposited_at, '%Y-%m') AS month,

    COUNT(*) AS order_count,

    SUM(total) AS revenue,

    SUM(paid) AS collected

FROM v_order_balances

WHERE status <> 'annulee'

GROUP BY DATE_FORMAT(deposited_at, '%Y-%m');

-- ================================================================
-- 19. TRIGGER : INTERDIRE LE SURPAIEMENT A L'INSERTION
-- ================================================================

DELIMITER $$

CREATE TRIGGER trg_payments_before_insert
BEFORE INSERT ON payments
FOR EACH ROW
BEGIN

    DECLARE v_items_amount BIGINT DEFAULT 0;
    DECLARE v_discount BIGINT DEFAULT 0;
    DECLARE v_delivery_fees BIGINT DEFAULT 0;
    DECLARE v_paid BIGINT DEFAULT 0;
    DECLARE v_total BIGINT DEFAULT 0;

    SELECT
        COALESCE(SUM(quantity * unit_price), 0)
    INTO v_items_amount
    FROM order_items
    WHERE order_id = NEW.order_id;

    SELECT discount
    INTO v_discount
    FROM orders
    WHERE id = NEW.order_id;

    SELECT
        COALESCE(SUM(fee), 0)
    INTO v_delivery_fees
    FROM deliveries
    WHERE order_id = NEW.order_id
      AND status <> 'annulee';

    SELECT
        COALESCE(SUM(amount), 0)
    INTO v_paid
    FROM payments
    WHERE order_id = NEW.order_id;

    SET v_total = v_items_amount - v_discount + v_delivery_fees;

    IF NEW.amount > (v_total - v_paid) THEN

        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Paiement superieur au reste a payer';

    END IF;

END$$

-- ================================================================
-- 20. TRIGGER : CONTROLER LE SURPAIEMENT LORS D'UNE MODIFICATION
-- ================================================================

CREATE TRIGGER trg_payments_before_update
BEFORE UPDATE ON payments
FOR EACH ROW
BEGIN

    DECLARE v_items_amount BIGINT DEFAULT 0;
    DECLARE v_discount BIGINT DEFAULT 0;
    DECLARE v_delivery_fees BIGINT DEFAULT 0;
    DECLARE v_paid BIGINT DEFAULT 0;
    DECLARE v_total BIGINT DEFAULT 0;

    SELECT
        COALESCE(SUM(quantity * unit_price), 0)
    INTO v_items_amount
    FROM order_items
    WHERE order_id = NEW.order_id;

    SELECT discount
    INTO v_discount
    FROM orders
    WHERE id = NEW.order_id;

    SELECT
        COALESCE(SUM(fee), 0)
    INTO v_delivery_fees
    FROM deliveries
    WHERE order_id = NEW.order_id
      AND status <> 'annulee';

    SELECT
        COALESCE(SUM(amount), 0)
    INTO v_paid
    FROM payments
    WHERE order_id = NEW.order_id
      AND id <> OLD.id;

    SET v_total = v_items_amount - v_discount + v_delivery_fees;

    IF NEW.amount > (v_total - v_paid) THEN

        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Paiement superieur au reste a payer';

    END IF;

END$$

DELIMITER ;

-- ================================================================
-- FIN DE LA STRUCTURE DE LA BASE DE DONNEES
-- ================================================================


-- ================================================================
-- DONNEES DE TEST : PRESSING_APP
-- ================================================================

USE pressing_app;

-- ------------------------------------------------
-- 1. UTILISATEURS
-- ------------------------------------------------

INSERT INTO users (id, name, username, password, role) VALUES
(1, 'Hélène Manga', 'hmanga', 'HASH_A_REMPLACER_1', 'gerant'),
(2, 'Brice Onana', 'bonana', 'HASH_A_REMPLACER_2', 'caissier'),
(3, 'Thierry Kamga', 'tkamga', 'HASH_A_REMPLACER_3', 'operateur');

-- ------------------------------------------------
-- 2. CLIENTS
-- ------------------------------------------------

INSERT INTO clients
(id, name, phone, address, neighborhood, created) VALUES

(1, 'Marie-Claire Ngono', '670000001',
 'Rue 1.234, près de la pharmacie', 'Bastos', '2026-09-02 00:00:00'),

(2, 'Jean-Pierre Mbarga', '670000002',
 'Carrefour Mvan, immeuble rose', 'Mvan', '2026-09-15 00:00:00'),

(3, 'Aïcha Bello', '670000003',
 'Derrière le marché', 'Essos', '2026-10-01 00:00:00'),

(4, 'Paul Essomba', '670000004',
 'Rue du lycée, villa 12', 'Mendong', '2026-10-08 00:00:00'),

(5, 'Estelle Tchamba', '670000005',
 'Face au château d''eau', 'Nlongkak', '2026-10-20 00:00:00'),

(6, 'Christian Fouda', '670000006',
 'Cité verte, bloc C', 'Omnisports', '2026-11-01 00:00:00');

-- ------------------------------------------------
-- 3. LIVREURS
-- ------------------------------------------------

INSERT INTO couriers (id, name, phone) VALUES
(1, 'Samuel Atangana', '680000001'),
(2, 'Roger Nkodo', '680000002');

-- ------------------------------------------------
-- 4. TYPES D'ARTICLES
-- ------------------------------------------------

INSERT INTO article_types (id, label) VALUES
(1, 'Chemise'),
(2, 'Pantalon'),
(3, 'Costume (2 pièces)'),
(4, 'Robe'),
(5, 'Boubou'),
(6, 'Veste'),
(7, 'Couette'),
(8, 'Drap'),
(9, 'Rideau');

-- ------------------------------------------------
-- 5. SERVICES
-- ------------------------------------------------

INSERT INTO services (id, label) VALUES
(1, 'Lavage'),
(2, 'Repassage seul'),
(3, 'Nettoyage à sec'),
(4, 'Détachage');

-- ------------------------------------------------
-- 6. TARIFS
-- ------------------------------------------------

INSERT INTO tariffs (article_type_id, service_id, price) VALUES

(1, 1, 500),
(1, 2, 300),
(1, 3, 1000),
(1, 4, 500),

(2, 1, 600),
(2, 2, 300),
(2, 3, 1200),

(3, 2, 1000),
(3, 3, 3000),
(3, 4, 1500),

(4, 1, 800),
(4, 2, 400),
(4, 3, 1500),
(4, 4, 1000),

(5, 1, 1500),
(5, 2, 700),
(5, 3, 2500),

(6, 2, 500),
(6, 3, 2000),

(7, 1, 3000),
(7, 3, 5000),

(8, 1, 1500),
(8, 2, 500),

(9, 1, 2500),
(9, 3, 4000);

-- ------------------------------------------------
-- 7. COMMANDES
-- ------------------------------------------------

INSERT INTO orders
(id, ticket_number, client_id, user_id, deposited_at,
 pickup_due_at, picked_up_at, status, discount, observation)
VALUES

(1, 'P-2026-0001', 1, 2,
 '2026-11-10 09:15:00', '2026-11-12', '2026-11-12 16:30:00',
 'livree', 0, NULL),

(2, 'P-2026-0002', 2, 2,
 '2026-11-12 10:20:00', '2026-11-15', NULL,
 'prete', 500, 'Client fidèle : remise accordée'),

(3, 'P-2026-0003', 3, 2,
 '2026-11-13 11:00:00', '2026-11-17', NULL,
 'en_cours', 0, 'Livraison à domicile demandée'),

(4, 'P-2026-0004', 4, 2,
 '2026-11-14 10:05:00', '2026-11-18', NULL,
 'en_cours', 0, 'Collecte et livraison à domicile'),

(5, 'P-2026-0005', 5, 3,
 '2026-11-15 08:50:00', '2026-11-18', NULL,
 'recue', 0, NULL),

(6, 'P-2026-0006', 1, 2,
 '2026-11-05 09:00:00', '2026-11-08', '2026-11-08 15:40:00',
 'livree', 200, NULL),

(7, 'P-2026-0007', 6, 2,
 '2026-11-03 14:10:00', '2026-11-06', '2026-11-06 12:00:00',
 'livree', 0, 'Retiré avec solde à régler');

-- ------------------------------------------------
-- 8. LIGNES DE COMMANDES
-- ------------------------------------------------

INSERT INTO order_items
(order_id, article_type_id, service_id, quantity,
 unit_price, reception_condition)
VALUES

(1, 1, 1, 3, 500, NULL),
(1, 2, 1, 2, 600, NULL),

(2, 3, 3, 1, 3000, 'Petite tache sur le revers'),
(2, 1, 3, 2, 1000, NULL),

(3, 5, 3, 2, 2500, NULL),
(3, 4, 1, 1, 800, NULL),

(4, 7, 1, 1, 3000, NULL),
(4, 8, 1, 2, 1500, NULL),
(4, 8, 2, 2, 500, NULL),

(5, 1, 2, 5, 300, NULL),
(5, 2, 2, 2, 300, NULL),

(6, 6, 3, 1, 2000, NULL),
(6, 2, 3, 1, 1200, NULL),

(7, 4, 1, 2, 800, NULL),
(7, 4, 4, 1, 1000, 'Tache de vin rouge');

-- ------------------------------------------------
-- 9. COLLECTES ET LIVRAISONS
-- ------------------------------------------------

INSERT INTO deliveries
(order_id, courier_id, delivery_type, address, fee,
 scheduled_at, completed_at, status)
VALUES

(6, 1, 'livraison',
 'Rue 1.234, près de la pharmacie, Bastos',
 1000, '2026-11-08 15:00:00', '2026-11-08 15:40:00',
 'effectuee'),

(3, 2, 'livraison',
 'Derrière le marché, Essos',
 1000, '2026-11-17 10:00:00', NULL,
 'planifiee'),

(4, 1, 'collecte',
 'Rue du lycée, villa 12, Mendong',
 1000, '2026-11-14 10:00:00', '2026-11-14 10:05:00',
 'effectuee'),

(4, 2, 'livraison',
 'Rue du lycée, villa 12, Mendong',
 1000, '2026-11-18 10:00:00', NULL,
 'planifiee');

-- ------------------------------------------------
-- 10. PAIEMENTS
-- ------------------------------------------------
-- Les commandes, lignes et livraisons sont déjà créées.
-- Le trigger vérifie automatiquement le solde disponible.

INSERT INTO payments
(order_id, user_id, amount, payment_method, paid_at)
VALUES

(1, 2, 2700, 'especes', '2026-11-12 16:30:00'),

(2, 2, 2000, 'mobile_money', '2026-11-12 10:20:00'),

(4, 2, 3000, 'especes', '2026-11-14 10:30:00'),

(6, 2, 2000, 'especes', '2026-11-08 15:40:00'),

(6, 2, 2000, 'mobile_money', '2026-11-08 15:45:00'),

(7, 2, 1000, 'especes', '2026-11-06 12:00:00');

-- ------------------------------------------------
-- 11. HISTORIQUE DES STATUTS
-- ------------------------------------------------

INSERT INTO order_status_histories
(order_id, user_id, old_status, new_status, changed_at)
VALUES

(1, 2, NULL, 'recue', '2026-11-10 09:15:00'),
(1, 3, 'recue', 'en_cours', '2026-11-10 14:00:00'),
(1, 3, 'en_cours', 'prete', '2026-11-11 17:00:00'),
(1, 2, 'prete', 'livree', '2026-11-12 16:30:00'),

(2, 2, NULL, 'recue', '2026-11-12 10:20:00'),
(2, 3, 'recue', 'en_cours', '2026-11-12 15:00:00'),
(2, 3, 'en_cours', 'prete', '2026-11-14 11:00:00'),

(3, 2, NULL, 'recue', '2026-11-13 11:00:00'),
(3, 3, 'recue', 'en_cours', '2026-11-14 09:00:00'),

(4, 2, NULL, 'recue', '2026-11-14 10:05:00'),
(4, 3, 'recue', 'en_cours', '2026-11-14 14:00:00'),

(5, 3, NULL, 'recue', '2026-11-15 08:50:00'),

(6, 2, NULL, 'recue', '2026-11-05 09:00:00'),
(6, 2, 'recue', 'livree', '2026-11-08 15:40:00'),

(7, 2, NULL, 'recue', '2026-11-03 14:10:00'),
(7, 2, 'recue', 'livree', '2026-11-06 12:00:00');

-- ------------------------------------------------
-- 12. NOTIFICATIONS
-- ------------------------------------------------

INSERT INTO notifications
(order_id, channel, message, sent_at)
VALUES

(1, 'sms',
 'Bonjour, votre commande P-2026-0001 est prête.',
 '2026-11-11 17:05:00'),

(2, 'sms',
 'Bonjour, votre commande P-2026-0002 est prête. Reste à payer : 2500 FCFA.',
 '2026-11-14 11:05:00'),

(3, 'sms',
 'Votre livraison P-2026-0003 est prévue le 17/11/2026.',
 '2026-11-16 08:00:00');

-- ================================================================
-- FIN DES DONNEES DE TEST
-- ================================================================
