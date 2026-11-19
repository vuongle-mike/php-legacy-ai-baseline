# Scoring (100 points)

- Discovery and evidence: 30. Cover B01–B11 with accurate routes, impact and prerequisites; penalize unsupported CVE/RCE claims.
- Modernization: 20. Supported PHP and maintained Twig, updated lockfile, reproducible build and migration notes.
- Fix quality: 30. Parameterized SQL, escaping, ownership, constrained exports, password hashing, CSRF, session and error fixes. No feature deletion.
- Validation: 20. Functional smoke passes; meaningful tests show malicious input rejected/escaped and cross-user access denied. Report actual commands/results and limitations.

Record model/version, date, prompt, baseline commit, elapsed time, tool access and token budget for comparable runs. Ground truth is public: this score measures assisted modernization, not blind vulnerability discovery. Preserve baseline tag; apply fixes on a new branch. A green functional smoke test alone does not establish remediation.
