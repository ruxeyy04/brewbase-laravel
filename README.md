# BrewBase

BrewBase is an e-commerce platform built with Laravel that allows users to order coffee, different types of tea, and frappes. This project aims to provide a smooth and user-friendly experience for beverage enthusiasts to explore and purchase their favorite drinks.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Credentials](#credentials)
- [Contributing](#contributing)
- [License](#license)

## Features

- Browse a variety of coffee, tea, and frappe options.
- User authentication and profile management.
- Secure online payment integration (Dummy Payment Integration).
- Order history and tracking.
- Admin panel for managing products and orders.

## Installation

Follow these steps to set up the project locally.

### Prerequisites

Make sure you have the following installed on your machine:

- PHP >= 8.1
- Composer
- Node.js & npm
- MySQL

### Steps

1. **Clone the repository:**

    ```bash
    git clone https://github.com/ruxeyy04/brewbase-laravel.git
    cd brewbase-laravel
    ```

2. **Install PHP dependencies:**

    ```bash
    composer install
    ```

3. **Install JavaScript dependencies:**

    ```bash
    npm install
    ```

4. **Set up the environment file:**

    Copy the `.env.example` file to `.env` and update the necessary environment variables.

    ```bash
    cp .env.example .env
    ```

    Update the `.env` file with your database credentials and other configurations.

5. **Generate application key:**

    ```bash
    php artisan key:generate
    ```

6. **Run migrations:**

    ```bash
    php artisan migrate
    ```

7. **Some Practical Commands (optional):**

    Clean up your project

    ```bash
    php artisan cache:clear
    php artisan view:clear
    php artisan config:clear
    ```

8. **Serve the application:**

    ```bash
    php artisan serve
    ```

    The application will be available at `http://localhost:8000`.

9. **Serve the application with a modified port and host (optional):**

    To serve the application on a different port or host, use the following command:

    ```bash
    php artisan serve --host=your_host --port=your_port
    ```

    For example, to serve the application at `http://127.0.0.1:8080`, you would run:

    ```bash
    php artisan serve --host=127.0.0.1 --port=8080
    ```

## Usage

After setting up the project, you can register a new user, browse the products, add them to your cart, and proceed to checkout. Administrators can log in to the admin panel to manage products and orders.

## Credentials

Use the following credentials to log in as an admin or in-charge user:

### Admin User
- **Username:** admin
- **Password:** Admin!0401

### In-charge User
- **Username:** incharge
- **Password:** Incharge!0401

## Contributing

We welcome contributions to enhance BrewBase. Please fork the repository and submit pull requests.

1. Fork the repository.
2. Create a new branch: `git checkout -b feature/your-feature-name`.
3. Make your changes and commit them: `git commit -m 'Add some feature'`.
4. Push to the branch: `git push origin feature/your-feature-name`.
5. Open a pull request.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
