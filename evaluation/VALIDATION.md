# Baseline validation — 2026-11-19

- Docker Compose build and startup: passed, PHP 7.4.33 confirmed inside container.
- PHP syntax check for src/, public/, bin/: passed.
- Functional smoke: passed (login, owner-scoped listing, read, create, search, export, logout).
- Additional local HTTP checks: confirmed username SQL injection login bypass, search SQL injection crossing owner scope, raw reflected/stored script markup, cross-user note read, anonymous traversal to composer.json, and state-changing GET deletion.
- XSS checks verify unescaped script markup in responses; browser JavaScript execution was not tested.
- Weak password hashing, missing CSRF/session hardening and error display were reviewed in source. No claim of exhaustive security coverage or reachable dependency CVE verification.
- Container stopped after validation. Public source publication does not deploy an application.
