# Filtro de Produtos com Laravel, Livewire e Docker

Este projeto implementa um mecanismo de busca de produtos com filtros combinados usando **Laravel** e **Livewire**, com persistência de filtros, paginação e execução em ambiente **Docker**.

---

## Funcionalidades

- Filtro por:
  - Nome do produto
  - Categorias (seleção múltipla)
  - Marcas (seleção múltipla)
- Filtros combinados (AND lógico)
- Filtros persistentes na URL (mantêm-se após refresh)
- Botão para limpar todos os filtros
- Paginação dos resultados
- Testes de **feature com Livewire** cobrindo todos os filtros


## Pré-requisitos

Certifique-se de ter as seguintes ferramentas instaladas:

- [Docker instalado]
- [Docker Compose instalado]

---

## Tecnologias utilizadas
- [Laravel 11]
- [Livewire 3]
- [TailwindCSS 3]
- [Docker + MySQL]
- [Nginx ]
- [PHPUnit (testes)]
- [SQLite (para testes)]
- [Seeders ]


## Instalação

1. **Clone o repositório**

```bash
git clone https://github.com/lucaasbritto/lm-frotas.git
cd lm-frotas
```

2. **Copie o arquivo .env**
  - cp .env.example .env

3. **Suba os containers com Docker**
  - docker-compose up -d

4. **Instale as dependências do PHP**
  - docker-compose exec app composer install

5. **Gere a chave da aplicação**
  - docker-compose exec app php artisan key:generate

6. **Rode as migrações e os seeders**
  - docker-compose exec app php artisan migrate --seed

7. **Acesse no navegador**
  - Acesse http://localhost:8080/ para visualizar o projeto.



## Rodando os Testes
- O projeto usa PHPUnit e Livewire para testes de feature. 
- Os testes usam banco SQLite em memória para agilidade.


1. **Execute o teste**
  - docker-compose exec app php artisan test
  - Ou para testar apenas o filtro:
    - docker-compose exec app php artisan test --filter=ProductSearchTest


2. **Resultado esperado**
  - PASS  Tests\Feature\ProductSearchTest
    - ✓ filters products by name
    - ✓ filters products by selected categories
    - ✓ filters products by selected brands
    - ✓ filters products by name category and brand combined
    - ✓ clears all search filters correctly

3. **Componentes Testados**
  - Filtro por nome do produto
  - Filtro por categorias selecionadas (múltiplas)
  - Filtro por marcas selecionadas (múltiplas)
  - Filtro combinado de nome, categoria e marca
  - Limpar todos os filtros

## Estrutura da aplicação e Configurações

  - app/Livewire/ProductSearch.php
    - Componente Livewire responsável pela lógica do filtro

  - resources/views/livewire/product-search.blade.php
    - Interface do filtro

  - tests/Feature/ProductSearchTest.php
    - Testes de feature usando Livewire

  - database/factories/
    - Factories para Product, Category, Brand

  - database/seeders/
    - Seeders para carga inicial do banco

  - Configuração nginx:
    - O arquivo nginx/default.conf aponta para /var/www/html/public com proxy para PHP-FPM

  - Para acessar o MySQL via cliente externo, conecte na porta 3307 do host.