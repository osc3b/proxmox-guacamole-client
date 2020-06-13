#!/bin/bash
nmap -sP -n 192.168.1.0/24 | egrep '192.168.|MAC' | paste -d ' '  - -