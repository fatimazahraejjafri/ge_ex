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
<<<<<<< HEAD
    .dashboard {
      display: flex;
      min-height: 100vh;
    }
    /* Sidebar styles */
=======
    .container {
      display: flex;
      min-height: 100vh;
    }
>>>>>>> ef5019b065249b84255fd2345db4bede388fb09f
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
<<<<<<< HEAD
    .sidebar ul li a:hover,
    .sidebar ul li a.active {
=======
    .sidebar ul li a:hover {
>>>>>>> ef5019b065249b84255fd2345db4bede388fb09f
      background-color: #34495e;
      border-radius: 5px;
    }
<<<<<<< HEAD
    /* Main content styles */
    .main-content {
=======
    .content {
>>>>>>> ef5019b065249b84255fd2345db4bede388fb09f
      flex: 1;
      padding: 20px;
    }
    header {
      background-color: #e3a70f;
      color: white;
<<<<<<< HEAD
      padding: 20px;
      border-radius: 5px;
      margin-bottom: 20px;
    }
    header h1 {
      margin: 0;
    }
    header p {
      margin: 5px 0 0;
    }
    /* Form and table styles */
    form {
      margin-bottom: 20px;
    }
    form label {
      display: block;
      margin: 10px 0 5px;
    }
    form select,
    form button {
=======
>>>>>>> ef5019b065249b84255fd2345db4bede388fb09f
      padding: 10px;
      margin-bottom: 20px;
    }
<<<<<<< HEAD
    form button {
      background-color: #007bff;
      color: white;
      border: none;
      cursor: pointer;
    }
    form button:disabled {
      background-color: #ccc;
      cursor: not-allowed;
    }
=======
>>>>>>> ef5019b065249b84255fd2345db4bede388fb09f
    table {
      width: 100%;
      border-collapse: collapse;
    }
<<<<<<< HEAD
    table th,
    table td {
      border: 1px solid #ddd;
=======
    table th, table td {
>>>>>>> ef5019b065249b84255fd2345db4bede388fb09f
      padding: 10px;
      border: 1px solid #ddd;
      text-align: left;
    }
<<<<<<< HEAD
    table th {
      background-color: #f4f4f4;
    }
    .hidden {
      display: none;
    }
=======
>>>>>>> ef5019b065249b84255fd2345db4bede388fb09f
  </style>
</head>
<body>
  <div class="container">
    <aside class="sidebar">
<<<<<<< HEAD
      <img src="<?= base_url('images/homme.png'); ?>" alt="Maroc Image" style="width: 50%; height: auto; display: block; margin: auto;" />
      <ul>
        <li><a href="#saisir-notes" class="active">Saisir des Notes</a></li>
        <li><a href="#mes-classes">Mes Classes</a></li>
        <li><a href="#statistiques">Statistiques</a></li>
        <li><a href="/login/logout">Déconnexion</a></li>
      </ul>
    </aside>
    <!-- Contenu principal -->
    <main class="main-content">
    <header>
    <?php if (isset($professor) && $professor): ?>
        <h1>Bienvenue, Professeur <?= esc($professor['first_name']) . ' ' . esc($professor['last_name']) ?></h1>
    <?php else: ?>
        <h1>Bienvenue, Professeur</h1>
        <p>Impossible de récupérer les informations du professeur.</p>
    <?php endif; ?>
    <p>Sélectionnez une option dans le menu pour commencer.</p>
    </header>
    <section id="saisir-notes">
        <h2>Saisir des Notes</h2>
        <form id="noteForm">
        <label for="department">Département :</label>
          <select id="department" name="department">
            <option value="" disabled selected>Choisissez un département</option>
            <option value="informatique">Informatique</option>
          </select>
          <label for="filiere">Filière :</label>
          <select id="filiere" name="filiere" disabled onchange="loadModules()">
=======
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
>>>>>>> ef5019b065249b84255fd2345db4bede388fb09f
            <option value="" disabled selected>Choisissez une filière</option>
          </select>
          <label for="module">Module :</label>
          <select id="module" disabled>
            <option value="" disabled selected>Choisissez un module</option>
          </select>
<<<<<<< HEAD
          <button type="button" id="loadStudents" disabled onclick="loadStudentsForModule()">Charger les Étudiants</button>
        </form>
        <div id="studentSection" class="hidden">
          <h3>Liste des Étudiants</h3>
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Note</th>
              </tr>
            </thead>
            <tbody id="studentTable"></tbody>
          </table>
          <button type="button" id="submitNotes">Enregistrer les Notes</button>
        </div>
=======

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
>>>>>>> ef5019b065249b84255fd2345db4bede388fb09f
      </section>
 </main>
  </div>
  <script>
<<<<<<< HEAD
    
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
</script>

>>>>>>> 5e5b66518a2114f6e75870feb7f81a57978d741e
=======
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
>>>>>>> ef5019b065249b84255fd2345db4bede388fb09f
</body>
</html>
