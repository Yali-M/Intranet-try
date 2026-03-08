#!/bin/bash

# Root directories
mkdir -p docs
mkdir -p public/assets/{icon-fonts/RemixIcons/fonts,audio,css,images/brand-logos,js,video}

# Docs files
touch docs/architecture.md
touch docs/database-schema.md
touch docs/api.md

# Public assets files
touch public/assets/icon-fonts/RemixIcons/fonts/index.html
touch public/assets/audio/perfect-beauty.mp3
touch public/assets/css/24-S5OW6U5D.jpg
touch public/assets/images/brand-logos/F_GROUP_BLEU.png
touch public/assets/js/add-products.js
touch public/assets/video/1.mp4

echo "Directory structure and files created successfully!"
