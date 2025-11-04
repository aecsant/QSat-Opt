from flask import Flask, request, jsonify
from qiskit_optimization import QuadraticProgram
from qiskit_optimization.algorithms import MinimumEigenOptimizer
from qiskit.algorithms import QAOA
from qiskit.primitives import Sampler
import mysql.connector, json, random
from datetime import datetime, timedelta

app = Flask(__name__)

# Load DB config
config = json.load(open('config.json'))

def get_db_connection():
    return mysql.connector.connect(
        host=config["host"],
        user=config["user"],
        password=config["password"],
        database=config["database"]
    )

@app.route('/optimize', methods=['GET'])
def optimize_satellite():
    sat_id = request.args.get('sat_id')
    db = get_db_connection()
    cur = db.cursor(dictionary=True)
    cur.execute("SELECT * FROM passes WHERE sat_id=%s", (sat_id,))
    passes = cur.fetchall()

    # ML/Quantum-inspired simulation: Random weight for simplicity
    qp = QuadraticProgram()
    for i, p in enumerate(passes):
        qp.binary_var(name=f"x{i}")
    qp.minimize(linear=[random.uniform(0.1,1.0) for _ in passes])
    qaoa = QAOA(sampler=Sampler(), reps=1)
    optimizer = MinimumEigenOptimizer(qaoa)
    result = optimizer.solve(qp)

    best = []
    for i, p in enumerate(passes):
        if result.x[i] > 0.5:
            best.append(p)

    # Save optimized windows
    for b in best:
        cur.execute("""
            INSERT INTO optimized_windows (sat_id, start_time, end_time, priority_score)
            VALUES (%s,%s,%s,%s)
        """, (sat_id, b['start_time'], b['end_time'], random.uniform(0.8,1.0)))
    db.commit()
    db.close()

    return jsonify({"sat_id": sat_id, "optimized_count": len(best)})

if __name__ == "__main__":
    app.run(host='0.0.0.0', port=5005)

