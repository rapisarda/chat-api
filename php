#!/usr/bin/env bash

[[ -z $1 ]] && docker-compose exec php bash && exit $?

docker-compose exec php $@
