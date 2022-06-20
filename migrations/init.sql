CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL
);

CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE role_routes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_id INT NOT NULL,
    route_path VARCHAR(100) NOT NULL,
    CONSTRAINT fk_role_routes_role_id FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);

CREATE TABLE user_roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    role_id INT NOT NULL,
    CONSTRAINT fk_user_roles_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_user_roles_role_id FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);

CREATE TABLE accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    parent_id INT NULL,
    code VARCHAR(100) NOT NULL,
    name VARCHAR(100) NOT NULL,
    transaction_type VARCHAR(100) NOT NULL
);

CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    account_id INT NOT NULL,
    subject_id INT NULL,
    bill_id INT NULL,
    user_id INT NULL,
    user_name VARCHAR(100) NULL,
    description TEXT NULL,
    amount VARCHAR(100) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_transactions_account_id FOREIGN KEY (account_id) REFERENCES accounts(id) ON DELETE CASCADE
);

CREATE TABLE subjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    special_id VARCHAR(100) NOT NULL,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    subject_type VARCHAR(45) NOT NULL,
    subject_group VARCHAR(45) NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE bills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subject_id INT NOT NULL,
    account_id INT NOT NULL,
    user_id INT NULL,
    user_name VARCHAR(100) NULL,
    name VARCHAR(100) NOT NULL,
    amount VARCHAR(100) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE sources (
    id INT AUTO_INCREMENT PRIMARY KEY,
    priority INT DEFAULT 0,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE activities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    parent_id INT DEFAULT NULL,
    code VARCHAR(100) NOT NULL,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE years (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    status INT DEFAULT 0,
    budget INT DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE budget_years (
    id INT AUTO_INCREMENT PRIMARY KEY,
    year_id INT NOT NULL,
    source_id INT NOT NULL,
    amount VARCHAR(100) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_budget_years_year_id FOREIGN KEY (year_id) REFERENCES years(id) ON DELETE CASCADE,
    CONSTRAINT fk_budget_years_source_id FOREIGN KEY (source_id) REFERENCES sources(id) ON DELETE CASCADE
);

CREATE TABLE budgets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    year_id INT NOT NULL,
    activity_id INT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_budgets_year_id FOREIGN KEY (year_id) REFERENCES years(id) ON DELETE CASCADE,
    CONSTRAINT fk_budgets_activity_id FOREIGN KEY (activity_id) REFERENCES activities(id) ON DELETE CASCADE
);

CREATE TABLE budget_sources (
    id INT AUTO_INCREMENT PRIMARY KEY,
    budget_id INT NOT NULL,
    source_id INT NOT NULL,
    amount VARCHAR(100) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_budget_sources_budget_id FOREIGN KEY (budget_id) REFERENCES budgets(id) ON DELETE CASCADE,
    CONSTRAINT fk_budget_sources_source_id FOREIGN KEY (source_id) REFERENCES sources(id) ON DELETE CASCADE
);

CREATE TABLE budget_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    budget_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    amount VARCHAR(100) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_budget_items_budget_id FOREIGN KEY (budget_id) REFERENCES budgets(id) ON DELETE CASCADE
);

CREATE TABLE application (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    address TEXT NOT NULL,
    phone VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);

INSERT INTO roles (id, name) VALUES (1, 'Administrator');

INSERT INTO role_routes (role_id,route_path) VALUE (1,'default/index');
INSERT INTO role_routes (role_id,route_path) VALUE (1,'sources/*');
INSERT INTO role_routes (role_id,route_path) VALUE (1,'years/*');
INSERT INTO role_routes (role_id,route_path) VALUE (1,'activities/*');
INSERT INTO role_routes (role_id,route_path) VALUE (1,'budgets/*');
INSERT INTO role_routes (role_id,route_path) VALUE (1,'budget-items/*');
INSERT INTO role_routes (role_id,route_path) VALUE (1,'accounts/*');
INSERT INTO role_routes (role_id,route_path) VALUE (1,'transactions/*');
INSERT INTO role_routes (role_id,route_path) VALUE (1,'subjects/*');
INSERT INTO role_routes (role_id,route_path) VALUE (1,'bills/*');
INSERT INTO role_routes (role_id,route_path) VALUE (1,'reports/*');

INSERT INTO application (name, address, phone, email) VALUES ('Keuangan','SMK Assyifa','0','0');
INSERT INTO users (name,username,password) VALUES ('Administrator','admin@admin.com','21232f297a57a5a743894a0e4a801fc3');
INSERT INTO user_roles (user_id,role_id) VALUES (1,1);

INSERT INTO accounts(code,name,transaction_type) VALUES ('1-001','Uang Sekolah','Db');
INSERT INTO accounts(code,name,transaction_type) VALUES ('1-002','Upah Staff / Dosen','Cr');