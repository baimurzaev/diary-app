## Запуск в докере

Linux console:

```
docker network create diarynet --gateway=172.16.0.1 --subnet 172.16.0.1/24

echo 172.16.0.2 diary.loc >> /etc/hosts

docker-compose build

docker-compose up -d
```

## Войти в контейнер и установить пакеты

```
docker exec -ti diary-app sh

su

composer install

# зпуск миграций производится из контейнера diary-app
php artisan migrate
```

## Открыть в браузере

```
http://diary.loc
```

## Управление БД (adminer)

```
http://172.16.0.5:8080/
```

## Сборка образов, запуск контейнеров

```
docker-start.sh
```

## Удаление всех контейнеров, образов...

```
docker_purge.sh
```
