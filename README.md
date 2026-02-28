# NFES (MVP Bootstrap)

Base inicial do projeto NFES em **PHP 8.3 puro** com arquitetura MVC-like simples, segurança básica e estrutura preparada para evolução do MVP.

## Estrutura

- `public_html/`: entrypoint e arquivos públicos.
- `nfes_private/`: bootstrap, core, configurações, logs e uploads privados.
- `database/migrations/`: scripts SQL versionáveis.

## Requisitos

- PHP 8.3+
- MySQL 8+
- Apache/Nginx apontando webroot para `public_html`

## Primeiro passo

1. Crie banco `nfes` no MySQL.
2. Rode `database/migrations/001_initial_schema.sql`.
3. Configure variáveis de ambiente:
   - `APP_BASE_URL`
   - `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, `DB_PASS`
4. Suba servidor local com webroot `public_html`.

## Segurança implementada no bootstrap

- Sessão com `httponly` + `samesite=lax`
- Cabeçalhos de segurança (CSP, HSTS, XFO, etc.)
- CSRF token para `POST`
- PDO com prepared statements e emulação desligada

## Próximos passos sugeridos

- Onboarding com verificação de e-mail + LGPD
- CRUD de clientes e catálogo
- Kanban de orçamentos com automações
- Geração de PDF com Dompdf
