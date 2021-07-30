#!/bin/sh
LD_LIBRARY_PATH=/opt/shibboleth/lib64 /etc/init.d/shibd start 
/usr/sbin/httpd -D FOREGROUND