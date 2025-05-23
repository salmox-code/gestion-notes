<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Convocation de Surveillance</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            margin: 30px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        .info {
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .footer {
            margin-top: 60px;
            text-align: right;
        }
    </style>
</head>
<body>

    <h2>Convocation à la Surveillance</h2>

    <div class="info">
        <p><strong>Surveillant :</strong> {{ $surveillant->prenom }} {{ $surveillant->nom }}</p>
        <p><strong>Classe :</strong> {{ $classe }}</p>
        <p><strong>Date :</strong> {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</p>
        <p><strong>Jour :</strong> {{ $jour }}</p>
        <p><strong>Salle :</strong> {{ $salle }}</p>
    </div>

    <div class="footer">
        <p><strong>Signature :</strong> __________________________</p>
    </div>

</body>
</html>
