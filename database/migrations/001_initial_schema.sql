CREATE TABLE IF NOT EXISTS users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(190) NOT NULL UNIQUE,
    senha_hash VARCHAR(255) NOT NULL,
    nome VARCHAR(120) NOT NULL,
    whatsapp VARCHAR(20) NULL,
    empresa_nome VARCHAR(160) NOT NULL,
    area_atuacao VARCHAR(120) NULL,
    email_verificado_em DATETIME NULL,
    trial_end DATETIME NOT NULL,
    plano_status ENUM('trial', 'active', 'past_due', 'blocked', 'canceled') NOT NULL DEFAULT 'trial',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS clientes (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    nome_razao VARCHAR(190) NOT NULL,
    cpf_cnpj VARCHAR(20) NULL,
    telefone VARCHAR(20) NULL,
    whatsapp VARCHAR(20) NULL,
    email VARCHAR(190) NULL,
    cep VARCHAR(9) NULL,
    endereco TEXT NULL,
    observacoes TEXT NULL,
    tags VARCHAR(255) NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_clientes_user FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS orcamentos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    cliente_id BIGINT UNSIGNED NOT NULL,
    status ENUM('proposta', 'enviado', 'aguardando', 'aprovado', 'nao_aprovou', 'cancelado') NOT NULL DEFAULT 'proposta',
    valor_total DECIMAL(10,2) NOT NULL DEFAULT 0,
    validade_dias INT UNSIGNED NOT NULL DEFAULT 7,
    pdf_path VARCHAR(255) NULL,
    public_token CHAR(64) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_orcamentos_user FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT fk_orcamentos_cliente FOREIGN KEY (cliente_id) REFERENCES clientes(id),
    UNIQUE KEY uq_orcamentos_public_token (public_token)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
