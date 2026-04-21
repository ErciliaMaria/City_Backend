# City_Project

Backend para consulta e listagem de cidades, com integração de busca por CEP via ViaCEP.

## Sobre o projeto

Este repositório contém uma API em Laravel com foco em:

- Listagem paginada de cidades com filtro por nome.
- Busca de dados de cidade a partir de um CEP (Integração via API).
- Ambiente de desenvolvimento com Laravel Sail.

## Stack

- PHP 8.5.5
- Laravel 10
- Laravel Sail (Docker)
- PostgreSQL

## Clonando o projeto

Use SSH para clonar:

```bash
git clone git@github.com:ErciliaMaria/City_Backend.git
cd City_Backend
```

## Pré-requisitos

- Docker e Docker Compose instalados
- Composer instalado na máquina

## Subindo o projeto com Laravel Sail

1. Instale as dependências PHP:

```bash
composer install
```

2. Crie o arquivo de ambiente:

```bash
cp .env.example .env
```

3. Suba os containers:

```bash
./vendor/bin/sail up -d
```

4. Gere a APP_KEY:

```bash
./vendor/bin/sail artisan key:generate
```

5. Rode as migrations:

```bash
./vendor/bin/sail artisan migrate
```

6. Popule o banco com seed:

```bash
./vendor/bin/sail artisan db:seed
```

## Comandos úteis

- Parar containers:

```bash
./vendor/bin/sail down
```

## Estrutura de banco (resumo)

### Tabela ufs

- id (UUID, PK)
- estado (string)
- uf (char 2, único)
- timestamps

### Tabela cidades

- id (UUID, PK)
- uf_id (UUID, FK -> ufs.id)
- nome (string)
- cep (string, nullable)
- ddd (integer, nullable)
- codigo_ibge (string, nullable)
- timestamps

## Seeders

O DatabaseSeeder:

- Cria todas as UFs brasileiras.
- Cria 8 cidades por UF via factory.

## Rotas da API e funcionalidades

Base URL local: http://localhost

## Listagem de Cidades
- Método: GET
- Rota: /api/v1/cities
- Controller: CityController
- Listagem e paginação das Cidades.

### Busca por CEP

- Método: POST
- Rota: /api/v1/cep/search
- Controller: CepController
- Funcionalidade: consulta o ViaCEP (API de integração) e retorna dados da cidade para o CEP informado.



