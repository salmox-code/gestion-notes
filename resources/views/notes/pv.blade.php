<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Procès-Verbal - {{ $classe }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
        }
        h2 {
            text-align: center;
            margin-bottom: 10px;
        }
        p {
            margin: 2px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <h2>Procès-Verbal des Notes</h2>
    <p><strong>Classe :</strong> {{ $classe }}</p>
    <p><strong>Matière :</strong> {{ $matiereNom }}</p>
    <p><strong>Date de génération :</strong> {{ now()->format('d/m/Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>Nom de l'étudiant</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notes as $note)
                <tr>
                    <td>{{ $note->etudiant->nom }} {{ $note->etudiant->prenom }}</td>
                    <td>{{ $note->valeur }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Signature de l'enseignant : __________________________
    </div>

</body>
</html>
