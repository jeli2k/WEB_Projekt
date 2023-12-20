# for Windows

# In Terminal:
# 1. go to script directory                           "cd"
# 2. run the following, depending on python version   "python init_database.py" or "python3 init_database.py"

import subprocess
import platform

host = "localhost"
user = "root"
password = ""
database = "hotel"

initial_sql = "schema/initial.sql"

# use the mysql command to execute the SQL script
command = [
    "mysql",
    "-h", host,
    "-u", user,
    f"-p{password}",
    database,
    "<", initial_sql
]

if platform.system() == "Windows":
    subprocess.run(" ".join(command), shell=True)
else:
    subprocess.run(command)