#!/bin/sh

# A handy bash script to be executed only once on the extension-specific directories

EXTENSION_NAME="XiroWeb - Tin TRENDING"
EXTENSION_ALIAS="xiroweb_trending"
EXTENSION_CLASS_NAME="XirowebTrending"
EXTENSION_DESC="XiroWeb - Tin TRENDING"
EXTENSION_NAMESPACE="Xiroweb"
TRANSLATION_KEY="XIROWEB_TRENDING"

find $1 -type f -not -name "*.sh" -exec gsed -i "s/\[EXTENSION_NAME\]/$EXTENSION_NAME/g" {} \;
find $1 -type f -not -name "*.sh" -exec gsed -i "s/\[PACKAGE_NAME\]/$EXTENSION_NAME/g" {} \;
find $1 -type f -not -name "*.sh" -exec gsed -i "s/\[PROJECT_NAME]/$EXTENSION_NAME/g" {} \;

find $1 -type f -not -name "*.sh" -exec gsed -i "s/com_foo/com_$EXTENSION_ALIAS/g" {} \;
find $1 -type f -not -name "*.sh" -exec gsed -i "s/COM_FOO/COM_$TRANSLATION_KEY/g" {} \;

find $1 -name "*.php" -type f -exec gsed -i "s/class Foo/class $EXTENSION_CLASS_NAME/g" {} \;
find $1 -name "*.php" -type f -exec gsed -i "s/ \* Foo/ \* $EXTENSION_CLASS_NAME/g" {} \;
find $1 -name "*.php" -type f -exec gsed -i "s/@var    Foo/@var    $EXTENSION_CLASS_NAME/g" {} \;
find $1 -name "*.php" -type f -exec gsed -i "s/new Foo/new $EXTENSION_CLASS_NAME/g" {} \;
find $1 -name "*.php" -type f -exec gsed -i "s/foo/$EXTENSION_ALIAS/g" {} \;
find $1 -name "*.php" -type f -exec gsed -i "s/FooInstaller/${EXTENSION_CLASS_NAME}Installer/g" {} \;
find $1 -name "*.php" -type f -exec gsed -i "s/Foo extends/$EXTENSION_CLASS_NAME extends/g" {} \;

find $1 -name "*.json" -type f -exec gsed -i "s/Foo Name/$EXTENSION_NAME/g" {} \;

find $1 -name "*.ini" -type f -exec gsed -i "s/\_FOO\=/\_$TRANSLATION_KEY\=/g" {} \;
find $1 -name "*.ini" -type f -exec gsed -i "s/\_FOO\_/\_$TRANSLATION_KEY\_/g" {} \;
find $1 -name "*.ini" -type f -exec gsed -i "s/[Ff]oo/$EXTENSION_NAME/g" {} \;

find $1 -name "*.xml" -type f -exec gsed -i "s/\_FOO/\_$TRANSLATION_KEY/g" {} \;
find $1 -name "*.xml" -type f -exec gsed -i "s/foo/$EXTENSION_ALIAS/g" {} \;

find $1 -name "*foo*" -type d -exec rename "s/foo/$EXTENSION_ALIAS/" {} \;
find $1 -name "*foo*" -type f -exec rename "s/foo/$EXTENSION_ALIAS/" {} \;

find $1 -type f -not -name "*.sh" -exec gsed -i "s/\[AUTHOR\]/Xiroweb/g" {} \;
find $1 -type f -not -name "*.sh" -exec gsed -i "s/\[AUTHOR_EMAIL\]/support@xiroweb.com/g" {} \;
find $1 -type f -not -name "*.sh" -exec gsed -i "s/\[COPYRIGHT\]/Copyright (c)2021 Xiroweb All rights reserved./g" {} \;
find $1 -type f -not -name "*.sh" -exec gsed -i "s/\[LICENSE\]/GNU General Public License version 2 or later; see LICENSE.txt/g" {} \;
find $1 -type f -not -name "*.sh" -exec gsed -i "s/\[AUTHOR_URL\]/https\:\/\/www\.xiroweb\.com/g" {} \;
