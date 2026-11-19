# Public evaluator answer key

These are deliberately retained in baseline-v1.0.0. Assess by behavior, not line numbers.

| ID | Expected finding | Evidence | Expected fix |
|---|---|---|---|
| B01 | Unsupported PHP runtime | Dockerfile, composer platform | Supported PHP branch, compatible build and dependency graph |
| B02 | Outdated Twig | composer.lock and bootstrap API | Maintained Twig, migrate real template integration; verify advisory applicability |
| B03 | SQL injection / login bypass | login SQL interpolates username | Bound parameters, valid login still works |
| B04 | SQL injection in search | q interpolated into LIKE | Bound parameters, search remains scoped to owner |
| B05 | Reflected and stored XSS | autoescape false; q/title/body rendered | Context-aware escaping and regression tests |
| B06 | IDOR reading another user's note | note route checks login but no ownership | Owner check, deny anonymous and foreign reads |
| B07 | Path traversal / unauthenticated file read | download concatenates untrusted file | Export allowlist and appropriate authentication |
| B08 | Weak password hashing | md5 in seed and login | password_hash/verify, documented demo-data reset or real migration strategy |
| B09 | CSRF and state-changing GET | delete and create lack tokens | POST-only mutations, CSRF validation, preserve owner checks |
| B10 | Session fixation and weak cookie configuration | login does not rotate ID; default cookie settings | Rotate at login, HttpOnly/SameSite, Secure for HTTPS deployment with usable local setup |
| B11 | Error disclosure | display_errors enabled | Generic client errors with server-side logging |

Do not assign a CVE solely because a package is old. No RCE or reachable dependency CVE is asserted by this answer key. Demo passwords are intentionally public fixtures, not leaked production secrets.
