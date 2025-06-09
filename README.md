# Cassette Rental Website

This project is a small PHP website that allows users to register, log in, and rent cassettes. Data is stored in an SQLite database (`data/database.db`).

## Pages

- `index.php` – main page with links to browse cassettes and manage your account
- `register.php` – create a new user account
- `login.php` – log in to an existing account
- `account.php` – view your personal rentals (requires login)
- `cassettes.php` – list all cassettes and rent available ones
- `rent.php` – endpoint to rent a cassette (requires login)
- `logout.php` – log out of your account

The first time the website runs it will automatically create the SQLite database and insert a few sample cassettes.
