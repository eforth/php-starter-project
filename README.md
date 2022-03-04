
### Setup

Install dependencies using composer
```bash
composer install
```
Configure .env file

### Run App

```bash
php -S localhost:8000 -t public/
```

### Testing

Run npm install
```bash
npm install
```

Start selenium
```bash
npx selenium-standalone install && npx selenium-standalone start
```

Start app
```bash
php -S localhost:8000 -t public/
```

Run tests
```bash
vendor/codeception/codeception/codecept run
```