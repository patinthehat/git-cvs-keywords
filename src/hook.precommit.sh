#!/bin/bash
echo "hook"

src/git-show-modified-files.sh
FROM_HOOK=precommit
export FROM_HOOK;

src/processor.php

FROM_HOOK=

