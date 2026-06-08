-- Voer dit uit in phpMyAdmin als game_name nog niet bestaat.
ALTER TABLE highscores
ADD COLUMN IF NOT EXISTS game_name VARCHAR(50) NOT NULL DEFAULT 'obstacle';
