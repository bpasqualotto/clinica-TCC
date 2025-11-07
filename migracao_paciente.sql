-- Migração para área do paciente
CREATE DATABASE IF NOT EXISTS clinica_medica DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE clinica_medica;

-- Tabela de pacientes
CREATE TABLE IF NOT EXISTS pacientes (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(120) NOT NULL,
  email VARCHAR(160) NOT NULL UNIQUE,
  senha VARCHAR(255) NOT NULL,
  telefone VARCHAR(30),
  nascimento DATE,
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Relaciona agendamentos ao paciente (opcional)
ALTER TABLE agendamentos
  ADD COLUMN IF NOT EXISTS paciente_id INT UNSIGNED NULL,
  ADD INDEX IF NOT EXISTS idx_ag_paciente (paciente_id);

-- Chave estrangeira (ignora erro se já existir)
ALTER TABLE agendamentos
  ADD CONSTRAINT fk_ag_paciente
  FOREIGN KEY (paciente_id) REFERENCES pacientes(id)
  ON UPDATE CASCADE ON DELETE SET NULL;

-- Opcional: Tabela de exames
CREATE TABLE IF NOT EXISTS exames (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  paciente_id INT UNSIGNED NOT NULL,
  tipo VARCHAR(120) NOT NULL,
  data_exame DATE NOT NULL,
  resultado TEXT,
  status ENUM('pendente','pronto','entregue') DEFAULT 'pendente',
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_ex_paciente (paciente_id),
  CONSTRAINT fk_ex_paciente FOREIGN KEY (paciente_id) REFERENCES pacientes(id)
    ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
