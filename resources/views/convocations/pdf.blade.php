<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Convocation</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .box { border: 1px solid #000; padding: 20px; width: 80%; margin: auto; margin-top: 50px; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <div class="box">
        <h2>📅 Convocation à la Surveillance</h2>

        <p><strong>Nom :</strong> {{ $convocation->surveillant->prenom }} {{ $convocation->surveillant->nom }}</p>
        <p><strong>Email :</strong> {{ $convocation->surveillant->email }}</p>
        <p><strong>Classe concernée :</strong> {{ $convocation->niveau }}</p>
        <p><strong>Date :</strong> {{ $convocation->date }}</p>
        <p><strong>Heure :</strong> {{ $convocation->heure }}</p>
        <p><strong>Salle :</strong> {{ $convocation->salle->nom }}</p>

        <p style="margin-top: 30px;">Merci de vous présenter à l'heure mentionnée.</p>
    </div>
</body>
</html>
