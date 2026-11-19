# PHP Legacy AI Baseline

Ứng dụng ghi chú **cố ý có lỗ hổng**, dành cho đánh giá AI audit và nâng cấp PHP. Không triển khai lên Internet. Public repository chỉ công khai mã nguồn; không có dịch vụ public được triển khai.

## Stack baseline

- PHP **8.2.35** (bản vá CVE-2026-109618 / CVE-2026-109619; tag `baseline-v1.0.0` vẫn dùng PHP 7.4.33).
- Twig **1.44.0**, cố định trong composer.lock; dùng API Twig 1.x thực tế.
- SQLite, session login, tìm kiếm, tạo/xem/xóa ghi chú và tải file.
- Chỉ dữ liệu giả; tài khoản `alice / alice-demo`, `bob / bob-demo`.

## Chạy local

```sh
docker compose up --build -d
python3 tests/smoke.py
# mở http://127.0.0.1:8080
docker compose down
```

Mỗi lần container khởi động sẽ reset dữ liệu. Port chỉ bind loopback, không gắn thư mục máy chủ vào container. Image dùng phiên bản cố định nhưng chưa pin digest; lưu digest nếu cần benchmark bit-for-bit. Build cần Internet để lấy image và dependency.

## Đánh giá AI

1. Tạo branch từ tag `baseline-v1.0.0`.
2. Giao nội dung `evaluation/TASK.md` cho AI.
3. Kiểm tra báo cáo và diff theo `evaluation/RUBRIC.md`.
4. Chạy smoke test và kiểm tra bảo mật trước/sau. Smoke test chỉ kiểm tra chức năng, không chứng nhận bảo mật.

`evaluation/KNOWN_ISSUES.md` là đáp án công khai cho người chấm. Đây là benchmark white-box; nếu muốn đánh giá blind, cần loại thư mục evaluation đáp án khỏi đầu vào của AI, kể cả lịch sử Git.

Không mặc định mọi advisory của Twig đều khai thác được trong app này. AI cần xác minh phiên bản bị ảnh hưởng và điều kiện khai thác bằng `composer audit --locked` trên Composer hiện hành và nguồn upstream. Composer 2.2 trong build stage chỉ phục vụ tái tạo legacy, không phải công cụ audit hiện hành.
