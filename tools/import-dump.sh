#!/bin/bash
# Script to import SQL dump into MySQL (local)
# Usage: ./import-dump.sh db_user db_pass
DB_USER=${1:-root}
DB_PASS=${2:-}
mysql -u${DB_USER} -p${DB_PASS} < sql/aguapotable_mysql_dump.sql
echo "Import complete. Ensure DB name 'aguapotable' exists or create it first."
