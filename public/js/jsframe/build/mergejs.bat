java -jar js.jar build_all.js

java -jar yuicompressor-2.4.6.jar --nomunge --preserve-semi  --disable-optimizations --charset utf-8 all.js -o all_min.js
