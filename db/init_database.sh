# for macOS/Linux

# in Terminal:
# 1. go into script directory   "cd"
# 2. allow script permissions   "chmod +x db/init_database.sh"
# 3. initiliaze database        "./db/init_database.sh"

#!/bin/bash

host="localhost"
user="root"
password=""
database="hotel"

initial_sql="schema/initial.sql"

# use the mysql command to execute the SQL script
mysql -h "$host" -u "$user" -p"$password" "$database" < "$initial_sql"

# error check
if [ $? -eq 0 ]; then
    echo "Database initialized successfully"
else
    echo "Error initializing the database"
fi
