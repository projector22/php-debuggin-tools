#!/bin/bash

# Usage: ./switch-php.sh 8.3

set -e

# Check input
if [[ -z "$1" ]]; then
  echo "Usage: $0 <php-version> (e.g., 8.3, 8.4)"
  exit 1
fi

VERSION="$1"
MODULE="php:remi-${VERSION}"

# Verify the module exists
AVAILABLE=$(dnf module list php | grep -E "remi-${VERSION}" || true)
if [[ -z "$AVAILABLE" ]]; then
  echo "❌ PHP version remi-${VERSION} not found in module list."
  echo "Try: sudo dnf module list php"
  exit 1
fi

echo "🔄 Switching PHP to version ${VERSION}..."

# Reset current PHP module
sudo dnf module reset php -y

# Enable the requested version
sudo dnf module enable "${MODULE}" -y

# Upgrade all relevant packages
sudo dnf distro-sync -y

echo "✅ PHP switched to:"
php -v
