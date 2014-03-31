#!/bin/bash
//usr/bin/git status --porcelain | egrep "^[ MA]{1,} .*" | awk '{ print $2 }'
