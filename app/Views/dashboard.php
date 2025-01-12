<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Professeur</title>
  <style>
    /* Global styles */
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
    }

    .container {
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

    .sidebar ul li a:hover {
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
      padding: 10px;
      border: 1px solid #ddd;
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
  <div class="container">
    <!-- Sidebar -->
    <aside class="sidebar">
      <img src="dashboard/homme.png" alt="Professeur Image" style="width: 50%; height: auto; display: block; margin: auto;" />
      <h2>Professeur</h2>
      <ul>
        <li><a href="#saisir-notes" class="active">Saisir des Notes</a></li>
        <li><a href="#mes-classes">Mes Classes</a></li>
        <li><a href="#statistiques">Statistiques</a></li>
        <li><a href="#deconnexion">Déconnexion</a></li>
        <li><a href="/dashboard">Accueil</a></li>
      </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <header>
        <h1>Bienvenue, Professeur <?= session()->get('prof_name') ?? 'Invité' ?></h1>
        <p>Sélectionnez une option dans le menu pour commencer.</p>
      </header>

      <!-- Section : Saisir des Notes -->
      <section id="saisir-notes">
        <h2>Saisir des Notes</h2>
        <form id="noteForm">
          <label for="department">Département :</label>
          <select id="department" name="department">
            <option value="" disabled selected>Choisissez un département</option>
            <option value="informatique">Informatique</option>
          </select>

          <label for="filiere">Filière :</label>
          <select id="filiere" name="filiere" disabled></select>

          <label for="module">Module :</label>
          <select id="module" name="module" disabled></select>

          <button type="button" id="loadStudents" disabled>Charger les Étudiants</button>
        </form>

        <!-- Liste des Étudiants -->
        <div class="student-list hidden" id="studentSection">
          <h3>Liste des Étudiants</h3>
          <table id="studentTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Note</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
          <button type="button" id="submitNotes">Enregistrer les Notes</button>
        </div>
      </section>
    </main>
  </div>

  <script>
    const departmentSelect = document.getElementById("department");
    const filiereSelect = document.getElementById("filiere");
    const moduleSelect = document.getElementById("module");
    const loadStudentsButton = document.getElementById("loadStudents");
    const studentSection = document.getElementById("studentSection");
    const studentTable = document.getElementById("studentTable");

    // Mock data for filieres and modules
    const filieres = {
      informatique: ["Génie Logiciel", "Intelligence Artificielle"],
    };

    const modules = {
      "génie logiciel": ["Algorithmique", "Architecture des Ordinateurs"],
      "intelligence artificielle": ["Apprentissage Automatique", "Traitement du Langage Naturel"],
    };

    // Populate filieres based on department
    departmentSelect.addEventListener("change", () => {
      const department = departmentSelect.value;
      filiereSelect.innerHTML = `<option value="" disabled selected>Choisissez une filière</option>`;
      if (filieres[department]) {
        filieres[department].forEach((filiere) => {
          const option = document.createElement("option");
          option.value = filiere.toLowerCase();
          option.textContent = filiere;
          filiereSelect.appendChild(option);
        });
        filiereSelect.disabled = false;
      }
    });

    // Populate modules based on filiere
    filiereSelect.addEventListener("change", () => {
      const filiere = filiereSelect.value;
      moduleSelect.innerHTML = `<option value="" disabled selected>Choisissez un module</option>`;
      if (modules[filiere]) {
        modules[filiere].forEach((module) => {
          const option = document.createElement("option");
          option.value = module.toLowerCase();
          option.textContent = module;
          moduleSelect.appendChild(option);
        });
        moduleSelect.disabled = false;
      }
    });

    // Enable the button to load students
    moduleSelect.addEventListener("change", () => {
      loadStudentsButton.disabled = false;
    });

    // Load students dynamically
    loadStudentsButton.addEventListener("click", async () => {
      studentSection.classList.remove("hidden");
      studentTable.querySelector("tbody").innerHTML = "";

      const students = [
        { id_user: 1, name: "Ali", prenom: "Ahmed" },
        { id_user: 2, name: "Sara", prenom: "Mohamed" },
        { id_user: 3, name: "Youssef", prenom: "El Amrani" },
      ];

      students.forEach((student) => {
        const row = document.createElement("tr");
        row.innerHTML = `
          <td>${student.id_user}</td>
          <td>${student.name}</td>
          <td>${student.prenom}</td>
          <td><input type="number" name="grade[${student.id_user}]" min="0" max="20" step="0.5"></td>
        `;
        studentTable.querySelector("tbody").appendChild(row);
      });

      studentTable.style.display = "table";
      document.getElementById("submitNotes").style.display = "block";
    });
  </script>
</body>
</html>
