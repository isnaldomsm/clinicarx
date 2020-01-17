#!/bin/sh
# Adiciona novo bundle no projeto para ser avaliado
# modo de uso: ./addbundle.sh ../canditato.bundle

BUNDLE="$1"
RNAME="$(basename "$BUNDLE")"

cd avaliacao

if [ ! -r "$BUNDLE" ]; then
    echo "Arquivo bundle inválido!"
    exit 1
fi


if [ -n "`git status --porcelain`" ]; then
    echo "Projeto possúi alterações não confirmadas."
    echo "Não é possível continuar"
    exit 1
fi

git remote add $RNAME $BUNDLE
if [ $? != 0 ]; then
    echo "Saindo."
    exit 2
fi

git fetch $RNAME
git checkout -b "bundle/${RNAME%.bundle}" "$RNAME/master"
