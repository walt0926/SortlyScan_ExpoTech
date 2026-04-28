import sqlite3
import os

# Detecta la ruta de la carpeta src
BASE_DIR = os.path.dirname(os.path.abspath(__file__))

# Define las rutas subiendo un nivel a la carpeta database
DB_PATH = os.path.join(BASE_DIR, "..", "database", "sortlyscan.db")
SCHEMA_PATH = os.path.join(BASE_DIR, "..", "database", "schema.sql")
SEED_PATH = os.path.join(BASE_DIR, "..", "database", "seed.sql")

def inicializar():
    try:
        # Conecta y crea el archivo si no existe
        conexion = sqlite3.connect(DB_PATH)
        cursor = conexion.cursor()

        # Ejecuta el schema con las tablas de escuela, sección y usuario
        print("creando tablas con la nueva jerarquía...")
        with open(SCHEMA_PATH, 'r', encoding='utf-8') as f:
            cursor.executescript(f.read())

        # Carga los datos de prueba del mined y los maestros
        print("insertando datos iniciales...")
        with open(SEED_PATH, 'r', encoding='utf-8') as f:
            cursor.executescript(f.read())

        conexion.commit()
        conexion.close()
        print(f"éxito: base de datos lista en {DB_PATH}")

    except Exception as e:
        print(f"error: {e}")

if __name__ == "__main__":
    inicializar()