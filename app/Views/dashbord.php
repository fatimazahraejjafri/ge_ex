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
    <!-- Sidebar -->
    <aside class="sidebar">
      <img src="<?= base_url('images/homme.png'); ?>" alt="Maroc Image" style="width: 50%; height: auto; display: block; margin: auto;" />
      <ul>
        <li><a href="#saisir-notes" class="active">Saisir des Notes</a></li>
        <li><a href="#mes-classes">Mes Classes</a></li>
        <li><a href="#statistiques">Statistiques</a></li>
        <li><a href="/login/logout">Déconnexion</a></li>
      </ul>
    </aside>
    <!-- Main Content -->
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
      <section id="methodSelection">
  <h2>Choisissez une méthode de saisie</h2>
  <label>
    <input type="radio" name="method" value="manual" checked>
    Saisie Manuelle
  </label>
  <label>
    <input type="radio" name="method" value="excel">
    Importation Excel
  </label>
</section>
      <section id="saisir-notes">
        <h2>Saisir des Notes</h2>
        <form id="noteForm" method="post" action="<?= base_url('insertGrades') ?>">
          <label for="filiere">Filière :</label>
          <select id="filiere" name="filiere" required>
            <option value="" disabled selected>Choisissez une filière</option>
            <!-- Dynamically filled by JavaScript -->
          </select>
          <label for="module">Module :</label>
          <select id="module" name="module" required>
            <option value="" disabled selected>Choisissez un module</option>
            <!-- Dynamically filled by JavaScript -->
          </select>
          <div id="studentsContainer" class="hidden">
            <h3>Étudiants</h3>
            <table>
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>Note</th>
                </tr>
              </thead>
              <tbody id="studentsTable">
                <!-- Dynamically filled by JavaScript -->
              </tbody>
            </table>
            <button type="button" onclick="submitGrades()">Enregistrer les Notes</button>
          </div>
        </form>
        <form id="noteForm2" class="hidden" method="post" action="<?= base_url('importExcel') ?>" enctype="multipart/form-data">
          <label for="filiere_excel">Filière :</label>
          <select id="filiere_excel" name="filiere_excel" required>
            <option value="" disabled selected>Choisissez une filière</option>
            <!-- Filled dynamically by JavaScript -->
          </select>

          <label for="module_excel">Module :</label>
          <select id="module_excel" name="id_module" required>
            <option value="" disabled selected>Choisissez un module</option>
            <!-- Filled dynamically by JavaScript -->
          </select>

          <label for="grades_file">Fichier Excel :</label>
          <input type="file" name="grades_file" id="grades_file" accept=".xls,.xlsx" required>
          <button type="submit">Importer depuis Excel</button>
        </form>
      </section>

    </main>
  </div>

  <script>
     async function submitGrades() {
    const activeForm = document.querySelector('form:not(.hidden)');
    const moduleId = activeForm.querySelector('select[name="module"]').value;
    const gradeInputs = activeForm.querySelectorAll('input[name^="grades"]');
    let grades = [];
    let isValid = true;

    gradeInputs.forEach(input => {
      const match = input.name.match(/\d+/);
      if (!match) return;
      const studentId = match[0];
      const grade = input.value;
      if (grade && (grade < 0 || grade > 20)) {
        isValid = false;
        alert(`La note pour l'étudiant ${studentId} est invalide. Les notes doivent être entre 0 et 20.`);
        return;
      }
      if (grade) grades.push({ id_user: studentId, grade: grade });
    });

    if (!isValid || grades.length === 0) return;

    const formData = new FormData();
    formData.append('id_module', moduleId);
    formData.append('grades', JSON.stringify(grades));

    try {
      const response = await fetch('<?= base_url("insertGrades") ?>', { method: 'POST', body: formData });
      if (response.ok) alert('Les notes ont été enregistrées avec succès !');
      else alert('Une erreur est survenue lors de l\'enregistrement des notes.');
    } catch (error) {
      console.error('Erreur lors de l\'envoi des données :', error);
    }
  }
   document.addEventListener('DOMContentLoaded', () => {
  const methodRadios = document.querySelectorAll('input[name="method"]');
  const manualForm = document.getElementById('noteForm');
  const excelForm = document.getElementById('noteForm2');
  const professorId = <?= json_encode(session()->get('id')) ?>;

  // Toggle between manual and Excel forms
  function toggleForms() {
    const selectedMethod = document.querySelector('input[name="method"]:checked').value;
    if (selectedMethod === 'manual') {
      manualForm.classList.remove('hidden');
      excelForm.classList.add('hidden');
    } else if (selectedMethod === 'excel') {
      manualForm.classList.add('hidden');
      excelForm.classList.remove('hidden');
    }
  }

  methodRadios.forEach(radio => {
    radio.addEventListener('change', toggleForms);
  });

  // Load filieres and modules for manual form
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
    const filiereId = document.getElementById('filiere').value;
    if (!filiereId) return;
    const response = await fetch(`<?= base_url("module/getModulesByFiliereAndProf") ?>/${filiereId}/${professorId}`);
    const modules = await response.json();
    const moduleSelect = document.getElementById('module');
    moduleSelect.innerHTML = '<option value="" disabled selected>Choisissez un module</option>';
    modules.forEach(module => {
      const option = document.createElement('option');
      option.value = module.id_module;
      option.textContent = module.name;
      moduleSelect.appendChild(option);
    });
  }

  // Load filieres and modules for Excel form
  async function loadFilieresExcel() {
    const response = await fetch(`<?= base_url("filiere/getFilieresByProf") ?>/${professorId}`);
    const filieres = await response.json();
    const filiereSelect = document.getElementById('filiere_excel');
    filiereSelect.innerHTML = '<option value="" disabled selected>Choisissez une filière</option>';
    filieres.forEach(filiere => {
      const option = document.createElement('option');
      option.value = filiere.id_filiere;
      option.textContent = filiere.name;
      filiereSelect.appendChild(option);
    });
  }

  async function loadModulesExcel() {
    const filiereId = document.getElementById('filiere_excel').value;
    if (!filiereId) return;
    const response = await fetch(`<?= base_url("module/getModulesByFiliereAndProf") ?>/${filiereId}/${professorId}`);
    const modules = await response.json();
    const moduleSelect = document.getElementById('module_excel');
    moduleSelect.innerHTML = '<option value="" disabled selected>Choisissez un module</option>';
    modules.forEach(module => {
      const option = document.createElement('option');
      option.value = module.id_module;
      option.textContent = module.name;
      moduleSelect.appendChild(option);
    });
  }

  // Load students for manual form
  async function loadStudents() {
    const moduleId = document.getElementById('module').value;
    if (!moduleId) return;
    const response = await fetch(`<?= base_url("etudiant/getStudentsByFiliere") ?>/${moduleId}`);
    const students = await response.json();
    const studentTable = document.getElementById('studentsTable');
    studentTable.innerHTML = '';
    students.forEach(student => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td>${student.id_user}</td>
        <td>${student.last_name}</td>
        <td>${student.first_name}</td>
        <td><input type="number" name="grades[${student.id_user}]" min="0" max="20" step="0.5" required></td>
      `;
      studentTable.appendChild(row);
    });
    document.getElementById('studentsContainer').classList.remove('hidden');
  }

  // Submit grades (manual form)
  async function submitGrades() {
    const activeForm = document.querySelector('form:not(.hidden)');
    const moduleId = activeForm.querySelector('select[name="module"]').value;
    const gradeInputs = activeForm.querySelectorAll('input[name^="grades"]');
    let grades = [];
    let isValid = true;

    gradeInputs.forEach(input => {
      const match = input.name.match(/\d+/);
      if (!match) return;
      const studentId = match[0];
      const grade = input.value;
      if (grade && (grade < 0 || grade > 20)) {
        isValid = false;
        alert(`La note pour l'étudiant ${studentId} est invalide. Les notes doivent être entre 0 et 20.`);
        return;
      }
      if (grade) grades.push({ id_user: studentId, grade: grade });
    });

    if (!isValid || grades.length === 0) return;

    const formData = new FormData();
    formData.append('id_module', moduleId);
    formData.append('grades', JSON.stringify(grades));

    try {
      const response = await fetch('<?= base_url("insertGrades") ?>', { method: 'POST', body: formData });
      if (response.ok) alert('Les notes ont été enregistrées avec succès !');
      else alert('Une erreur est survenue lors de l\'enregistrement des notes.');
    } catch (error) {
      console.error('Erreur lors de l\'envoi des données :', error);
    }
  }

  // Event listeners
  document.getElementById('filiere').addEventListener('change', loadModules);
  document.getElementById('module').addEventListener('change', loadStudents);

  if (document.getElementById('filiere_excel')) {
    document.getElementById('filiere_excel').addEventListener('change', loadModulesExcel);
    loadFilieresExcel();
  }

  loadFilieres(); // Manual form
});

  </script>
</body>
</html>
