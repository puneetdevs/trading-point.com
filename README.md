## Project Overview

In this exercise you need to create a PHP application that will have a form with the following fields:
● Company Symbol
● Start Date (YYYY-mm-dd)
● End Date (YYYY-mm-dd)
● Email


## Prerequisites

- PHP 7.4 or higher
- MySQL or any other database
- Composer


## Installation

1. Clone the repository
git clone repoURL

2. Install dependencies

```bash
  npm install
```

Run vite

```bash
  npm run dev
  npm run build
```

Install PHP dependencies

```bash
  composer install
```

Generate Key

```bash
  php artisan key:generate
```

3. Create a `.env` file and set the database configurations
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=xm
DB_USERNAME=root
DB_PASSWORD=
```

4. Run the migrations to create the necessary tables and seed company data
```bash
php artisan migrate:fresh --seed

```

5. Add you rapid api key here
```bash
RAPID_API_KEY = ""
```

6. Add smtp credentials to get mails
```bash
MAIL_MAILER=smtp
MAIL_HOST=
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=
```

5. Start the application
```bash
php artisan serve
```

### Testing

To run the tests, use the following command:
```bash
php artisan test
```
Results
![image description](/public/image/test.png)


#### Form:
![image description](/public/image/home.png)


#### Table:
![image description](/public/image/table.png)

#### Chart:
![image description](/public/image/chart.png)

