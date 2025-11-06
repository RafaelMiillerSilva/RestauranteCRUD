Guia de Configuração do Projeto Laravel – Restaurante

Siga os passos abaixo para clonar o projeto e configurá-lo do zero em outro computador.

1. Pré-requisitos

Certifique-se de ter instalado:

PHP ≥ 8.2

Composer

Git

2. Clonar o projeto

No terminal, execute:

git clone <URL_DO_REPOSITORIO>
cd <NOME_DO_PROJETO>

3. Instalar dependências
composer install
npm install
npm run dev


npm run dev é opcional, usado apenas se houver assets JS/CSS compilados via Vite.

4. Configurar ambiente

Copie o arquivo de exemplo .env.example para .env:

cp .env.example .env


Abra o .env e ajuste se necessário:

APP_KEY=           # Deixe vazio, será gerado
DB_DATABASE=restaurante_db
DB_USERNAME=root
DB_PASSWORD=


Gere a chave da aplicação Laravel:

php artisan key:generate

5. Criar banco de dados

No MySQL (ou PhpMyAdmin), crie o banco:

CREATE DATABASE restaurante_db;

6. Rodar migrations e seeders
php artisan migrate:fresh
php artisan db:seed


migrate:fresh limpa e recria todas as tabelas.

db:seed popula o banco com dados iniciais (clientes, pratos, ingredientes etc).

7. Iniciar o servidor local
php artisan serve