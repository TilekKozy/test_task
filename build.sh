docker run --rm -v $(pwd):/app prooph/composer:8.2 install
cp .env.example .env
./vendor/bin/sail up -d
./vendor/bin/sail npm install
./vendor/bin/sail npm run build
./vendor/bin/sail php artisan key:generate
./vendor/bin/sail php artisan migrate --seed

