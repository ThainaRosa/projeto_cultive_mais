# Cultive Mais

Plataforma web para o gerenciamento de resíduos orgânicos e apoio à agricultura familiar no contexto de Cotia/SP.

## Plano técnico

O desenvolvimento será realizado em incrementos pequenos, cada um validado e versionado localmente:

1. Preparação do ambiente Laravel e configuração segura para MySQL.
2. Orchid para a administração e autenticação Blade para a área pública.
3. Papéis centralizados (`admin`, `resident` e `partner`), policies e controle de acesso no backend.
4. Modelagem com Eloquent, migrations, enums, factories e seeders para usuários, endereços, resíduos, pontos e coletas.
5. Fluxos públicos para perfil, endereços, resíduos e solicitações de coleta, com validação por Form Requests.
6. Serviço transacional para transições de status e histórico de coletas.
7. Área do parceiro, mapa acessível com Leaflet/OpenStreetMap e telas administrativas Orchid.
8. Dashboard de indicadores, testes automatizados, revisão de segurança e documentação de uso.

## Requisitos atuais

- PHP 8.2 ou superior
- Composer
- Node.js e npm
- MySQL 8 ou compatível

> As credenciais locais pertencem exclusivamente ao arquivo `.env`, que não é versionado. Use `.env.example` como ponto de partida.

## Administração

O painel administrativo está disponível em `/admin`. Após configurar o banco e executar as migrations, crie o primeiro administrador localmente com:

```bash
php artisan orchid:admin
```

O comando solicita nome, e-mail e senha de forma interativa; nenhuma credencial padrão é incluída no projeto.
