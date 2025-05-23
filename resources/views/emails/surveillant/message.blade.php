@component('mail::message')
# Bonjour  {{ $convocation->surveillant->nom }} {{ $convocation->surveillant->prenom }}

Vous êtes convoqué pour surveiller l'examen de la classe **{{ $convocation->niveau }}**.

- 🗓️ Date : **{{ $convocation->date }}**
- 🕒 Heure : **{{ $convocation->heure }}**
- 🏫 Salle : **{{ $convocation->salle->nom }}**

Merci de vous présenter à l'heure indiquée.

Veuillez consulter la convocation jointe en pièce jointe au format PDF.


Cordialement,  
Administration
@endcomponent
