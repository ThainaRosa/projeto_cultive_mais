# Cultive Mais

O Cultive Mais é uma plataforma web que conecta moradores e parceiros para facilitar o encaminhamento e a coleta de resíduos orgânicos em Cotia/SP. O sistema ajuda a reduzir o descarte inadequado, incentiva o reaproveitamento dos resíduos e divulga pontos de coleta locais.

## Tecnologias

- PHP 8.2 ou superior e Laravel 12
- MySQL
- Blade, Tailwind CSS e Alpine.js
- Laravel Breeze para autenticação
- Orchid para administração
- Vite e npm
- PHPUnit

## Instalação

Pré-requisitos: PHP, Composer, Node.js, npm e MySQL.

```bash
git clone <url-do-repositorio>
cd projeto_cultive_mais
composer install
npm install
```

Copie o arquivo de ambiente e gere a chave da aplicação:

```bash
cp .env.example .env
php artisan key:generate
```

No Windows, use `copy .env.example .env` no lugar de `cp`.

## Configuração do banco

Crie um banco MySQL e ajuste estas variáveis no arquivo `.env`:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cultive_mais
DB_USERNAME=root
DB_PASSWORD=
```

Crie as tabelas e os dados iniciais:

```bash
php artisan migrate
php artisan db:seed
```

O seed cadastra as categorias de resíduos orgânicos e três pontos de coleta fictícios em Cotia/SP.

## Administrador Orchid

O painel está disponível em `/admin`. Para criar um administrador, execute:

```bash
php artisan orchid:admin
```

Informe nome, e-mail e senha quando solicitado. O projeto não possui credenciais padrão.

## Executando o projeto

Em dois terminais, execute:

```bash
php artisan serve
```

```bash
npm run dev
```

Para gerar os recursos otimizados para produção:

```bash
npm run build
```

## Testes e formatação

```bash
php artisan test
vendor/bin/pint
```

No Windows, o formatador também pode ser executado com `vendor\bin\pint`.

## Perfis disponíveis

- `resident`: morador cadastrado pelo formulário público.
- `partner`: parceiro responsável por aceitar e realizar coletas.
- `admin`: administrador com acesso ao Orchid.

## Funcionalidades

- Páginas públicas sobre o projeto, resíduos orgânicos e pontos de coleta ativos.
- Cadastro e login de moradores.
- Cadastro, edição, visualização e cancelamento de resíduos pelo morador.
- Criação, acompanhamento e cancelamento de solicitações de coleta.
- Consulta, aceite, agendamento, conclusão e cancelamento de coletas pelo parceiro.
- Administração de usuários, categorias, pontos de coleta, resíduos e solicitações no Orchid.
- Dashboard administrativo com indicadores básicos do sistema.
