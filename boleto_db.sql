

CREATE TABLE IF NOT EXISTS boleto (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    data_vencimento TEXT NOT NULL,
    data_emissao TEXT NOT NULL,
    data_pagamento TEXT,
    valor REAL NOT NULL,
    desconto REAL DEFAULT 0,
    juros REAL DEFAULT 0,
    multa REAL DEFAULT 0,
    mora REAL DEFAULT 0,
    valor_pago REAL
);