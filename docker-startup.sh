#!/bin/bash

service cron start
service supervisor start

apache2ctl -DFOREGROUND
