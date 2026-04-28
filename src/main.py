from flask import Flask, jsonify, request
import sqlite3
import os

app = Flask(__name__)

# Configuración de rutas para no tener errores de archivo
BASE_DIR = os.path.dirname(os.path.abspath(__file__))
DB_PATH = os.path.join(BASE_DIR, "..", "database", "sortlyscan.db")

@app.route('/')
def inicio():
    return jsonify({
        "estado": "servidor operativo",
        "proyecto": "sortlyscan expotech 2026"
    })

# 1. Acceso para alumnos usando el código del mined
@app.route('/acceso/escuela/<codigo_mined>', methods=['GET'])
def buscar_escuela(codigo_mined):
    conn = sqlite3.connect(DB_PATH)
    cursor = conn.cursor()
    cursor.execute("SELECT id, nombre FROM escuelas WHERE codigo_infraestructura = ?", (codigo_mined,))
    escuela = cursor.fetchone()
    conn.close()
    if escuela:
        return jsonify({"id": escuela[0], "nombre": escuela[1]})
    return jsonify({"error": "centro escolar no encontrado"}), 404

# 2. Login para maestros
@app.route('/login/maestro', methods=['POST'])
def login_maestro():
    datos = request.json
    usuario = datos.get('usuario')
    password = datos.get('password')
    
    conn = sqlite3.connect(DB_PATH)
    cursor = conn.cursor()
    cursor.execute("SELECT id, nombre, escuela_id FROM secciones WHERE maestro_usuario = ? AND maestro_password = ?", 
                   (usuario, password))
    maestro = cursor.fetchone()
    conn.close()
    
    if maestro:
        return jsonify({
            "mensaje": "ingreso exitoso",
            "seccion_id": maestro[0],
            "grado": maestro[1],
            "escuela_id": maestro[2]
        })
    return jsonify({"error": "usuario o contraseña incorrectos"}), 401

# 3. Listar alumnos de un salón (para que el niño elija su nombre)
@app.route('/seccion/<int:seccion_id>/alumnos', methods=['GET'])
def listar_alumnos(seccion_id):
    conn = sqlite3.connect(DB_PATH)
    cursor = conn.cursor()
    cursor.execute("SELECT id, nombre, puntos FROM usuarios WHERE seccion_id = ?", (seccion_id,))
    alumnos = [{"id": a[0], "nombre": a[1], "puntos": a[2]} for a in cursor.fetchall()]
    conn.close()
    return jsonify(alumnos)

# 4. Métricas para el director (suma de toda la escuela)
@app.route('/metricas/escuela/<int:escuela_id>', methods=['GET'])
def metricas_globales(escuela_id):
    conn = sqlite3.connect(DB_PATH)
    cursor = conn.cursor()
    query = """
        SELECT SUM(u.puntos) 
        FROM usuarios u
        JOIN secciones s ON u.seccion_id = s.id
        WHERE s.escuela_id = ?
    """
    cursor.execute(query, (escuela_id,))
    total = cursor.fetchone()[0]
    conn.close()
    return jsonify({"total_escuela": total or 0})

if __name__ == '__main__':
    app.run(debug=True)