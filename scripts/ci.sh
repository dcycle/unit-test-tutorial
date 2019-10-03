#!/bin/bash
#
# Tests meant to be run on Circle CI.
#
set -e

docker run --rm -v "$(pwd)":/app phpunit/phpunit \
  --group myproject
