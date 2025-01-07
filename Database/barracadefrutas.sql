-- Classificações das frutas
create table classificacaos(
    id serial primary key,
    classificacao VARCHAR(20) NOT NULL CHECK (classificacao IN ('extra', 'primeira', 'segunda', 'terceira')),
    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de frutas
create table frutas(
    id serial primary key,
    classificacao_id integer not null,
    nome VARCHAR(100) NOT NULL,
    fresca boolean not null,
    qtd_disponivel integer not null,
    preco NUMERIC(10,2) NOT NULL,
    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

alter table frutas add foreign key(classificacao_id) references classificacaos(id);

-- Tabela de usuários
create table users(
    id serial primary key,
    username varChar not null,
    password text not null,
    documento varChar not null,
    isAdm boolean not null,
    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de vendas
create table vendas(
    id SERIAL PRIMARY KEY,
    fruta_id INTEGER REFERENCES frutas(id),
    vendedor_id INTEGER REFERENCES users(id),
    qtd_vendida integer not null,
    desconto INTEGER NOT NULL CHECK (desconto IN (0, 5, 10, 15, 20, 25)),
    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
