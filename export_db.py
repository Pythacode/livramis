import pymysql
import yaml
from datetime import datetime

with open("config.yaml", "r") as f:
    config = yaml.safe_load(f)

conn = pymysql.connect(
    host=config["host"],
    user=config["username"],
    password=config["password"],
    database=config["dbname"],
    charset="utf8mb4"
)

cursor = conn.cursor()
output = []
output.append(f"-- Export SQL - {datetime.now()}")
output.append(f"-- Database: {config['dbname']}\n")
output.append("SET FOREIGN_KEY_CHECKS=0;\n")

# Tables
cursor.execute("SHOW TABLES")
tables = [row[0] for row in cursor.fetchall()]

for table in tables:
    # Structure
    cursor.execute(f"SHOW CREATE TABLE `{table}`")
    create = cursor.fetchone()[1]
    output.append(f"DROP TABLE IF EXISTS `{table}`;")
    output.append(f"{create};\n")

    # Data
    cursor.execute(f"SELECT * FROM `{table}`")
    rows = cursor.fetchall()
    if rows:
        cursor.execute(f"SHOW COLUMNS FROM `{table}`")
        cols = ", ".join([f"`{col[0]}`" for col in cursor.fetchall()])
        for row in rows:
            values = ", ".join([
                "NULL" if v is None else f"'{str(v).replace(chr(39), chr(39)+chr(39))}'"
                for v in row
            ])
            output.append(f"INSERT INTO `{table}` ({cols}) VALUES ({values});")
        output.append("")

output.append("SET FOREIGN_KEY_CHECKS=1;")

filename = f"{config['dbname']}_export.sql"
with open(filename, "w", encoding="utf-8") as f:
    f.write("\n".join(output))

print(f"Export terminé : {filename}")
cursor.close()
conn.close()
