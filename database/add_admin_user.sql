-- Insert admin user
INSERT INTO `users` (`id`, `username`, `name`, `email`, `tel`, `password`, `gender`, `is_admin`, `created_at`, `updated_at`) 
VALUES 
(1, 'admin', 'Administrator', 'admin@para4you.com', '+212600000000', '$2y$12$8CdJkv9Ot15lQMn55Ni5HOklSmhbE8aB7LDQxHC/R5Y4mYXgCZbpW', 'secret', 1, NOW(), NOW()); 