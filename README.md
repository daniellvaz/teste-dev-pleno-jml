# Migração do Sistema Legado para Laravel Moderno

Este projeto tem como objetivo migrar um sistema legado para uma aplicação Laravel moderna, mantendo funcionalidades essenciais e utilizando boas práticas do framework.

## Requisitos

- PHP >= 8.1  
- Laravel >= 10  
- Banco de dados MySQL
- Composer  

## Instalação

1. Clone o repositório:
   ```bash
   git clone <url-do-repositorio>
   cd nome-do-projeto/api
   
2. Altere o nome do arquivo .env.example para .env e ensira as credenciais do seu banco de dados mysql:

3. Rode as mitrations:
  ```bash
    php artisan migrate
  ```
   
4. Rode as seeds do projeto:
  ```bash
    php artisan db:seed FornecedorSeeder
  ```

5. Inicie o projeto:
  ```bash
    php artisan serve
  ```

## Funcionalidades

O sistema atualmente possui duas rotas principais:

1. **Listagem de Fornecedores**
   - Método: `GET`
   - Endpoint: `/fornecedores`
   - Retorna a lista de todos os fornecedores cadastrados no sistema.

2. **Criação de Novo Fornecedor**
   - Método: `POST`
   - Endpoint: `/fornecedores`
   - Permite cadastrar um novo fornecedor no sistema.
   - Campos esperados:
     - `nome` (string) – Nome do fornecedor
     - `email` (string) – E-mail do fornecedor
     - `cnpj` (string) – CNPJ do fornecedor

## Estrutura do Projeto

- **Routes**: Todas as rotas estão definidas no arquivo `routes/api.php`.
- **Controllers**: A lógica de cada rota está centralizada nos controllers, como `FornecedorController`.
- **Models**: O model `Fornecedor` representa os fornecedores no banco de dados.
- **Migrations**: O banco de dados é gerenciado através das migrations do Laravel.
- **Resources**: Respostas JSON são formatadas usando Laravel Resources.