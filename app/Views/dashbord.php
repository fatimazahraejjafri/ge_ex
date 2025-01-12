<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Professeur</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }
    .container {
      display: flex;
      min-height: 100vh;
    }
    .sidebar {
      width: 250px;
      background-color: #2c3e50;
      color: white;
      padding: 20px;
    }
    .sidebar h2 {
      text-align: center;
    }
    .sidebar ul {
      list-style: none;
      padding: 0;
    }
    .sidebar ul li {
      margin: 10px 0;
    }
    .sidebar ul li a {
      color: white;
      text-decoration: none;
      padding: 10px;
      display: block;
    }
    .sidebar ul li a:hover {
      background-color: #34495e;
      border-radius: 5px;
    }
    .content {
      flex: 1;
      padding: 20px;
    }
    header {
      background-color: #e3a70f;
      color: white;
      padding: 10px;
      margin-bottom: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    table th, table td {
      padding: 10px;
      border: 1px solid #ddd;
      text-align: left;
    }
  </style>
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <h2>Professeur</h2>
      <ul>
        <li><a href="/dashboard">Accueil</a></li>
        <li><a href="#notes">Saisir des Notes</a></li>
        <li><a href="#classes">Mes Classes</a></li>
        <li><a href="/login/logout">Déconnexion</a></li>
      </ul>
    </aside>
    <main class="content">
      <header>
        <h1>Bienvenue, Professeur <?= session()->get('prof_name') ?? 'Invité' ?></h1>
      </header>

      <section id="notes">
        <h2>Saisir des Notes</h2>
        <form id="noteForm">
          <label for="filiere">Filière :</label>
          <select id="filiere" onchange="loadModules()">
            <option value="" disabled selected>Choisissez une filière</option>
          </select>
          <label for="module">Module :</label>
          <select id="module" disabled>
            <option value="" disabled selected>Choisissez un module</option>
          </select>

          <button type="button" onclick="loadStudents()">Charger les Étudiants</button>
        </form>

        <table id="studentTable" style="display:none;">
          <thead>
            <tr>
              <th>ID Étudiant</th>
              <th>Nom</th>
              <th>Note</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
        <button id="submitNotes" style="display:none;">Enregistrer</button>
      </section>
 </main>
  </div>
  <script>

    
    const professorId = <?= json_encode(session()->get('user_id')) ?>; // Get user_id from session

    document.getElementById('department').addEventListener('change', () => {
    const department = document.getElementById('department').value;
    const filiereSelect = document.getElementById('filiere');

    if (department === 'informatique') {
        filiereSelect.disabled = false; // Enable Filière dropdown
        loadFilieres(); // Load filieres dynamically
    } else {
        filiereSelect.disabled = true; // Disable Filière dropdown for other departments
        filiereSelect.innerHTML = '<option value="" disabled selected>Choisissez une filière</option>'; // Reset options
    }
});


    async function loadFilieres() {
        const response = await fetch(`<?= base_url("filiere/getFilieresByProf") ?>/${professorId}`);
        const filieres = await response.json();
        const filiereSelect = document.getElementById('filiere');
        filiereSelect.innerHTML = '<option value="" disabled selected>Choisissez une filière</option>';
        filieres.forEach(filiere => {
            const option = document.createElement('option');
            option.value = filiere.id_filiere;
            option.textContent = filiere.name;
            filiereSelect.appendChild(option);
        });
    }

    async function loadModules() {
        const idFiliere = document.getElementById('filiere').value;
        const response = await fetch(`<?= base_url("module/getModulesByFiliereAndProf") ?>/${idFiliere}/${professorId}`);
        const modules = await response.json();
        const moduleSelect = document.getElementById('module');
        moduleSelect.innerHTML = '<option value="" disabled selected>Choisissez un module</option>';
        modules.forEach(module => {
            const option = document.createElement('option');
            option.value = module.id_module;
            option.textContent = module.name;
            moduleSelect.appendChild(option);
        });
        moduleSelect.disabled = false;
        document.getElementById('loadStudents').disabled = false;
    }


    async function loadStudentsForModule(){
      const idFiliere = document.getElementById('filiere').value;
      if (!idFiliere) {
        alert('Veuillez sélectionner une filière avant de charger les étudiants.');
        return;
    }
    const response = await fetch(`<?= base_url("etudiant/getStudentsByFiliere") ?>/${idFiliere}`);
    const students = await response.json();
    const studentTable = document.getElementById('studentTable');
    studentTable.innerHTML = '';
    students.forEach(user => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${user.id_user}</td>
            <td>${user.last_name}</td>
            <td>${user.first_name}</td>
            <td><input type="number" name="note" min="0" max="20" step="0.5"></td>
        `;
        studentTable.appendChild(row);
    });
    document.getElementById('studentSection').classList.remove('hidden');
    }


    document.addEventListener('DOMContentLoaded', loadFilieres);


    async function loadModules() {
      const filiereId = document.getElementById('filiere').value;
      const response = await fetch(`/module/getModulesByFiliereAndProf/${filiereId}/<?= session()->get('user_id') ?>`);
      const modules = await response.json();
      const moduleSelect = document.getElementById('module');
      moduleSelect.innerHTML = '<option value="" disabled selected>Choisissez un module</option>';
      modules.forEach(module => {
        moduleSelect.innerHTML += `<option value="${module.id_module}">${module.name}</option>`;
      });
      moduleSelect.disabled = false;
    }

    async function loadStudents() {
      const moduleId = document.getElementById('module').value;
      const response = await fetch(`/etudiant/getStudentsByFiliere/${moduleId}`);
      const students = await response.json();
      const table = document.getElementById('studentTable');
      const tbody = table.querySelector('tbody');
      tbody.innerHTML = '';
      students.forEach(student => {
        tbody.innerHTML += `
          <tr>
            <td>${student.id_user}</td>
            <td>${student.name}</td>
            <td><input type="number" name="grade[${student.id_user}]" min="0" max="20"></td>
          </tr>
        `;
      });
      table.style.display = 'table';
      document.getElementById('submitNotes').style.display = 'block';
    }
  </script>
</body>
</html>
