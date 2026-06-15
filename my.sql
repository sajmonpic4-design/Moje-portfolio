-- Utworzenie bazy danych
CREATE DATABASE IF NOT EXISTS aplikacja_sajmonc4;
USE aplikacja_sajmonc4;

-- Tabela pracownik (projekty)
CREATE TABLE IF NOT EXISTS pracownik (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tytul VARCHAR(100) NOT NULL,
    opis TEXT NOT NULL,
    technologia VARCHAR(50) NOT NULL,
    data_dodania TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Opcjonalnie: kilka przykładowych rekordów do testów
INSERT INTO pracownik (tytul, opis, technologia) VALUES
('Strona portfolio', 'Moja pierwsza strona portfolio z HTML i CSS', 'css'),
('Kalkulator JS', 'Prosty kalkulator w JavaScript', 'js'),
('System logowania', 'System logowania z użyciem PHP i MySQL', 'php'),
('Baza filmów', 'Zarządzanie bazą filmów w MySQL', 'mysql'),
('Aplikacja Python', 'Skrypt do analizy danych', 'python');