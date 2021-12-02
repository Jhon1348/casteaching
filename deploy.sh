#!/usr/bin/env sh
git checkout production
git merge main --no-edit
git push origin production
git checkout main

# Copiat de https://forge.laravel.com/servers/512103/sites/1487951#/application
wget https://forge.laravel.com/servers/506186/sites/1498298/deploy/http?token=2m1fgbNsoZVJW89gjqMX8zoYkwDY7aatZJU0treS -O /dev/null
#wget https://forge.laravel.com/servers/512103/sites/1487951/deploy/http?token=PvB78NKBrfptI7VCwTEYJg4XXDI5aceWc9P6qxP6
