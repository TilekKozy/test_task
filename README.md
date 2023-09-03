### Application

|  Т            |    В       |
| ---------     | -----:     |
| Laravel       |   v10.21.0 |
| PHP       |     8.2 |
| Postgesql |      15 |

# УСТАНОВКА 

#### 1. Клонируем проект

```code
git clone git@github.com:TilekKozy/test_dev.git
```

#### 2. Установите в каталоге проекта такой уровень разрешений, чтобы ее владельцем был пользователь без привилегий root

```code
sudo chown -R $USER:$USER test_dev
```

#### 3. Перейдите в каталог test_dev

```code
cd test_dev
```

#### 4. Копируем env.example и создаем .env

```code
docker run --rm -v $(pwd):/app composer install
```

#### 5. Копируем docker-lamp в директорию проекта

```code
git clone git@github.com:TilekKozy/docker-lamp.git
```

