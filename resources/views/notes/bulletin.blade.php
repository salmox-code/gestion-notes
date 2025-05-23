<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bulletin de Notes</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        h1, h3 {
            text-align: center;
            margin: 0;
        }
        .info {
            margin-top: 10px;
            line-height: 1.6;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }
        th, td {
            border: 1px solid #000;
            padding: 7px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        .mention {
            margin-top: 30px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- 🏫 En-tête établissement -->
    <div class="header">
        <h1>École Nationale Des sciences Applique Al Houceima</h1>
        <h3>Bulletin de Notes - Année Universitaire {{ date('Y') }}</h3>
    </div>

    <!-- 👤 Informations de l'étudiant -->
    <div class="info">
        <strong>Nom :</strong> {{ $etudiant->nom }}<br>
        <strong>Prénom :</strong> {{ $etudiant->prenom }}<br>
        <strong>Email :</strong> {{ $etudiant->email }}<br>
        <strong>CNE :</strong> {{ $etudiant->cne }}<br>
        <strong>Niveau :</strong> {{ $etudiant->niveau }}
    </div>

    <!-- 📊 Tableau ou message -->
    @if($notes->isEmpty())
        <p class="mention">⚠️ Aucune note enregistrée pour cet étudiant.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Matière</th>
                    <th>Note (/20)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($notes as $note)
                    <tr>
                        <td>{{ $note->matiere->nom }}</td>
                        <td>{{ $note->valeur }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- ✅ Résultat final -->
        <div class="mention">
            Moyenne Générale : {{ number_format($moyenne, 2) }} / 20<br>
            Résultat Final : {{ $mention }}
        </div>
    @endif

</body>
</html>

