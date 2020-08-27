# install
- in .env.local, fill: `DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7`
- if necesary replace `db_user` and `db_password`
- run these commands:
```
composer install
yarn install
yarn build

php bin/console doctrine:database:create
php bin/console doctrine:migration:migrate
```