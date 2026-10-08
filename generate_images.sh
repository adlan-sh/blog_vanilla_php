#!/usr/bin/env bash
set -e

mkdir -p public/assets/img

# slug:подпись для каждой картинки
images=(
    "php-1:PHP 1" "php-2:PHP 2" "php-3:PHP 3" "php-4:PHP 4"
    "php-5:PHP 5" "php-6:PHP 6" "php-7:PHP 7" "php-8:PHP 8"
    "js-1:JS 1"   "js-2:JS 2"   "js-3:JS 3"   "js-4:JS 4"
    "js-5:JS 5"   "js-6:JS 6"   "js-7:JS 7"   "js-8:JS 8"
    "devops-1:DevOps 1" "devops-2:DevOps 2" "devops-3:DevOps 3" "devops-4:DevOps 4"
    "devops-5:DevOps 5" "devops-6:DevOps 6" "devops-7:DevOps 7" "devops-8:DevOps 8"
    "db-1:DB 1" "db-2:DB 2" "db-3:DB 3" "db-4:DB 4"
    "db-5:DB 5" "db-6:DB 6" "db-7:DB 7" "db-8:DB 8"
    "arch-1:Arch 1" "arch-2:Arch 2" "arch-3:Arch 3" "arch-4:Arch 4"
    "arch-5:Arch 5" "arch-6:Arch 6" "arch-7:Arch 7" "arch-8:Arch 8"
)

for item in "${images[@]}"; do
    name="${item%%:*}"
    label="${item##*:}"
    url="https://placehold.co/800x500/2563eb/ffffff/png?text=$(printf '%s' "$label" | sed 's/ /+/g')"
    echo "→ $name.png"
    curl -sSL "$url" -o "public/assets/img/${name}.jpg"
done

echo "Готово: $(ls public/assets/img | wc -l) картинок."