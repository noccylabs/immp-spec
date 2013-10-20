#!/bin/bash

echo -n "Building " >&2
for F in spec/*.md; do
    echo -n "." >&2
    cat $F
    echo -en "\n\n\n"
done
echo "" >&2
