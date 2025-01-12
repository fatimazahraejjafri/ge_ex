<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Professeur</title>
  <style>
    /* Global styles */
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
    }
    .dashboard {
      display: flex;
      min-height: 100vh;
    }
    /* Sidebar styles */
    .sidebar {
      width: 250px;
      background-color: #2c3e50;
      color: white;
      padding: 20px;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    }
    .sidebar h2 {
      text-align: center;
      margin-bottom: 20px;
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
      border-radius: 5px;
      transition: background-color 0.3s;
    }
    .sidebar ul li a:hover,
    .sidebar ul li a.active {
      background-color: #34495e;
    }
    /* Main content styles */
    .main-content {
      flex: 1;
      padding: 20px;
    }
    header {
      background-color: #e3a70f;
      color: white;
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
      padding: 10px;
      font-size: 16px;
      margin-bottom: 10px;
      border: 1px solid #ddd;
      border-radius: 5px;
    }
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
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    table th,
    table td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: left;
    }
    table th {
      background-color: #f4f4f4;
    }
    .hidden {
      display: none;
    }
  </style>
</head>
<body>
  <div class="dashboard">
    <!-- Barre latérale -->
    <aside class="sidebar">
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
            <option value="" disabled selected>Choisissez une filière</option>
          </select>
          <label for="module">Module :</label>
          <select id="module" name="module" disabled>
            <option value="" disabled selected>Choisissez un module</option>
          </select>
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
</script>

</body>
</html>
