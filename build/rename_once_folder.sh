#!/bin/sh

# A handy bash script to be executed only once on the extension-specific directories

EXTENSION_NAME="XiroWeb - Tin TRENDING"
EXTENSION_ALIAS="xiroweb_trending"
EXTENSION_CLASS_NAME="XirowebTrending"
EXTENSION_DESC="XiroWeb - Tin TRENDING"
EXTENSION_NAMESPACE="Xiroweb"
TRANSLATION_KEY="XIROWEB_TRENDING"

find $1 -name "*foo*" -type d -exec rename "s/foo/$EXTENSION_ALIAS/" {} \;
find $1 -name "*foo*" -type f -exec rename "s/foo/$EXTENSION_ALIAS/" {} \;
