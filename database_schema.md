# Gaming API Database Schema

## Tables and Relationships

### 1. users
- id (PK, VARCHAR(36), UUID)
- name (VARCHAR(255))
- email (VARCHAR(255), UNIQUE)
- email_verified_at (DATETIME, NULLABLE)
- password (VARCHAR(255))
- remember_token (VARCHAR(100), NULLABLE)
- created_at (DATETIME)
- updated_at (DATETIME)

### 2. publishers
- id (PK, BIGINT, AUTO_INCREMENT)
- name (VARCHAR(255))
- website (VARCHAR(255), NULLABLE)
- founded_year (INT, NULLABLE)
- description (TEXT, NULLABLE)
- created_at (DATETIME)
- updated_at (DATETIME)

### 3. developers
- id (PK, BIGINT, AUTO_INCREMENT)
- name (VARCHAR(255))
- website (VARCHAR(255), NULLABLE)
- founded_year (INT, NULLABLE)
- description (TEXT, NULLABLE)
- created_at (DATETIME)
- updated_at (DATETIME)

### 4. genres
- id (PK, BIGINT, AUTO_INCREMENT)
- name (VARCHAR(255))
- description (TEXT, NULLABLE)
- created_at (DATETIME)
- updated_at (DATETIME)

### 5. platforms
- id (PK, BIGINT, AUTO_INCREMENT)
- name (VARCHAR(255))
- manufacturer (VARCHAR(255), NULLABLE)
- release_date (DATE, NULLABLE)
- created_at (DATETIME)
- updated_at (DATETIME)

### 6. games
- id (PK, BIGINT, AUTO_INCREMENT)
- title (VARCHAR(255))
- slug (VARCHAR(255), NULLABLE)
- description (TEXT, NULLABLE)
- release_date (DATE, NULLABLE)
- price (DECIMAL(8,2), NULLABLE)
- steam_app_id (INT, NULLABLE)
- is_from_steam (BOOLEAN, DEFAULT false)
- publisher_id (FK to publishers.id, NULLABLE)
- created_at (DATETIME)
- updated_at (DATETIME)

### 7. game_developer (Pivot Table)
- id (PK, BIGINT, AUTO_INCREMENT)
- game_id (FK to games.id)
- developer_id (FK to developers.id)
- created_at (DATETIME)
- updated_at (DATETIME)

### 8. game_genre (Pivot Table)
- id (PK, BIGINT, AUTO_INCREMENT)
- game_id (FK to games.id)
- genre_id (FK to genres.id)
- created_at (DATETIME)
- updated_at (DATETIME)

### 9. game_platform (Pivot Table)
- id (PK, BIGINT, AUTO_INCREMENT)
- game_id (FK to games.id)
- platform_id (FK to platforms.id)
- release_date (DATE, NULLABLE)
- created_at (DATETIME)
- updated_at (DATETIME)

### 10. reviews
- id (PK, BIGINT, AUTO_INCREMENT)
- game_id (FK to games.id)
- user_id (FK to users.id)
- rating (INT, 1-5)
- comment (TEXT, NULLABLE)
- created_at (DATETIME)
- updated_at (DATETIME)

## Relationships

### One-to-Many:
- publishers → games (1:n)
- users → reviews (1:n)
- games → reviews (1:n)

### Many-to-Many:
- games ↔ developers (through game_developer)
- games ↔ genres (through game_genre)
- games ↔ platforms (through game_platform)

## Indexes:
- games.publisher_id
- games.steam_app_id
- reviews.game_id
- reviews.user_id
- All pivot table foreign keys
