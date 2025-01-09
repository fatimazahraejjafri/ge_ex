<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Gestion des Notes</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            height: 100vh;
            background-color:rgb(237, 159, 57);
            color: white;
            padding: 20px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            padding: 20px;
        }

        .card {
            margin-bottom: 20px;
        }

        .btn-action {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 sidebar">
                 <a href="#">Vue d'ensemble</a>
                <a href="#">Gestion des Notes</a>
                <a href="#">Paramètres</a>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10 content">
                <h1>Gestion des Notes des Étudiants</h1>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Saisir les Notes pour la Matière : <strong>Mathématiques</strong></h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nom de l'Étudiant</th>
                                    <th>Note</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Jean Dupont</td>
                                    <td>
                                        <input type="number" class="form-control" placeholder="Entrez une note" value="85">
                                    </td>
                                    <td>
                                        <button class="btn btn-success btn-sm">Enregistrer</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Marie Curie</td>
                                    <td>
                                        <input type="number" class="form-control" placeholder="Entrez une note" value="90">
                                    </td>
                                    <td>
                                        <button class="btn btn-success btn-sm">Enregistrer</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Émilie Zola</td>
                                    <td>
                                        <input type="number" class="form-control" placeholder="Entrez une note" value="78">
                                    </td>
                                    <td>
                                        <button class="btn btn-success btn-sm">Enregistrer</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Résumé des Notes</h5>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nom de l'Étudiant</th>
                                    <th>Note Moyenne</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Jean Dupont</td>
                                    <td>85%</td>
                                </tr>
                                <tr>
                                    <td>Marie Curie</td>
                                    <td>90%</td>
                                </tr>
                                <tr>
                                    <td>Émilie Zola</td>
                                    <td>78%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
