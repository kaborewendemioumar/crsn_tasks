<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Guide utilisateur - CRSN Tasks</title>
	@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">
<main class="container py-4">
	<div class="mb-4">
		<a href="/" class="btn btn-outline-success">&larr; Retour</a>
	</div>

	<header class="mb-5">
		<h1 class="text-danger">Guide d'utilisation de CRSN Tasks</h1>
		<p class="lead mb-1">Guide utilisateur</p>
		<p>Plateforme de gestion et de suivi des tâches et des activités du Centre de Recherche en Santé de Nouna (CRSN).</p>
	</header>

	<section class="mb-5">
		<h2>I. Présentation de l'application</h2>
		<p>CRSN Tasks facilite la gestion des tâches et des activités au sein du Centre de Recherche en Santé de Nouna. Les membres d'une équipe peuvent recevoir des tâches, déposer leurs livrables, rédiger des rapports d'avancement et suivre leur progression. Les managers et les administrateurs disposent d'outils de supervision et de validation.</p>
		<p>L'application propose trois profils : <strong>Membre</strong>, <strong>Manager</strong> et <strong>Administrateur</strong>. Les principales fonctionnalités sont :</p>
		<ul>
			<li>la création et l'attribution de tâches ;</li>
			<li>le dépôt de livrables ;</li>
			<li>le suivi de la progression des tâches ;</li>
			<li>la rédaction et la soumission de rapports ;</li>
			<li>la validation ou le rejet des rapports et des livrables.</li>
		</ul>
	</section>

	<section class="mb-5">
		<h2>II. Gestion des identités et des accès</h2>

		<h3>1. Créer un compte</h3>
		<ol>
			<li>Ouvrez CRSN Tasks.</li>
			<li>Sur l'écran d'accueil, choisissez <strong>Inscription</strong>.</li>
			<li>Renseignez votre nom complet, votre adresse e-mail et votre mot de passe.</li>
			<li>Confirmez votre mot de passe, puis choisissez <strong>S'inscrire</strong>.</li>
		</ol>
		<p>Après l'inscription, votre compte reste inactif jusqu'à son activation par un administrateur. Selon l'organisation retenue, la création des comptes peut être réservée à l'administrateur, qui communiquera alors les identifiants aux membres.</p>

		<h3>2. Activer son compte</h3>
		<p>L'administrateur doit activer votre compte avant votre première connexion. Un e-mail vous informe lorsque le compte est activé.</p>

		<h3>3. Se connecter</h3>
		<ol>
			<li>Ouvrez le menu (icône à trois barres), puis choisissez <strong>Connexion</strong>.</li>
			<li>Saisissez votre adresse e-mail et votre mot de passe.</li>
			<li>Choisissez <strong>Se connecter</strong>.</li>
		</ol>
		<p>En cas d'oubli du mot de passe, utilisez le lien <strong>Mot de passe oublié</strong> pour recevoir un e-mail de réinitialisation. Ouvrez le lien reçu, saisissez votre nouveau mot de passe et confirmez-le. Vous pouvez également contacter l'administrateur pour demander une modification de votre mot de passe.</p>
		<p>Après la connexion, vous accédez à un tableau de bord adapté à votre rôle : Membre, Manager ou Administrateur.</p>
	</section>

	<section class="mb-5">
		<h2>III. Fonctionnalités pour les membres</h2>

		<h3>1. Consulter ses tâches</h3>
		<ol>
			<li>Depuis le tableau de bord, ouvrez l'onglet <strong>Mes tâches</strong>.</li>
			<li>Consultez les tâches qui vous sont attribuées et leurs informations : identifiant, plan associé, description, priorité, nombre de livrables prévus, statut, date d'affectation (début d'exécution) et date de fin d'exécution.</li>
		</ol>
		<p>Utilisez les options disponibles en haut de la liste pour filtrer ou trier les tâches, par exemple par échéance, statut ou priorité.</p>

		<h3>2. Déposer un livrable</h3>
		<ol>
			<li>Ouvrez le menu <strong>Livrables</strong>, puis choisissez <strong>Nouveau livrable</strong>.</li>
			<li>Sélectionnez la tâche concernée et importez le fichier depuis votre appareil (document, image, etc.).</li>
			<li>Ajoutez, si nécessaire, un commentaire décrivant le livrable.</li>
			<li>Choisissez <strong>Soumettre</strong>.</li>
		</ol>
		<p>Le livrable est transmis au manager pour examen. Son statut passe à <strong>En attente de validation</strong>. Vous serez informé de sa validation ou de son rejet.</p>

		<h3>3. Rédiger et soumettre un rapport</h3>
		<ol>
			<li>Depuis le tableau de bord, ouvrez <strong>Rapports</strong>, puis choisissez <strong>Nouveau rapport</strong>.</li>
			<li>Sélectionnez la tâche concernée.</li>
			<li>Rédigez le rapport dans l'éditeur intégré : activités réalisées, difficultés rencontrées et résultats obtenus.</li>
			<li>Joignez des pièces justificatives si nécessaire, puis vérifiez l'aperçu.</li>
			<li>Choisissez <strong>Soumettre</strong>.</li>
		</ol>
		<p>Le rapport est envoyé au manager pour évaluation et son statut passe à <strong>Soumis</strong>.</p>

		<h3>4. Consulter le statut d'un rapport</h3>
		<ol>
			<li>Ouvrez l'onglet <strong>Rapports</strong>.</li>
			<li>Consultez la liste de vos rapports et leur statut : <strong>Soumis</strong>, <strong>Validé</strong> ou <strong>Rejeté</strong>.</li>
			<li>Ouvrez un rapport pour lire les éventuels commentaires du manager.</li>
		</ol>

		<h3>5. Corriger un rapport rejeté</h3>
		<p>Un rapport rejeté est accompagné d'un commentaire du manager indiquant les motifs du rejet et les corrections attendues.</p>
		<ol>
			<li>Ouvrez le rapport concerné depuis <strong>Rapports</strong>.</li>
			<li>Lisez attentivement le commentaire du manager.</li>
			<li>Choisissez <strong>Corriger</strong>, puis apportez les modifications demandées.</li>
			<li>Choisissez <strong>Resoumettre</strong>.</li>
		</ol>
		<p>Le rapport corrigé repasse au statut <strong>Soumis</strong> pour une nouvelle évaluation.</p>

		<h3>6. Corriger un livrable rejeté</h3>
		<ol>
			<li>Ouvrez le menu <strong>Livrables</strong> et consultez le statut de vos livrables.</li>
			<li>Repérez le livrable rejeté et lisez le commentaire associé.</li>
			<li>Choisissez <strong>Remplacer le livrable</strong>, puis téléversez la version corrigée.</li>
			<li>Choisissez <strong>Soumettre</strong>.</li>
		</ol>
		<p>Le livrable corrigé est renvoyé pour examen.</p>
	</section>

	<section class="mb-5">
		<h2>IV. Fonctionnalités pour les managers et les administrateurs</h2>

		<h3>1. Suivre la progression</h3>
		<ol>
			<li>Depuis le tableau de bord, ouvrez <strong>Affectations</strong>, puis <strong>Progression</strong> (ou l'icône de graphique associée).</li>
			<li>Consultez l'indicateur visuel, présenté sous forme de barre ou de pourcentage, qui estime l'avancement des tâches à partir des livrables.</li>
			<li>Ouvrez le détail d'une tâche pour voir les étapes validées et celles qui restent à accomplir.</li>
		</ol>
		<p>Cette vue permet au manager ou à l'administrateur de superviser l'avancement de l'équipe.</p>

		<h3>2. Rôle commun du manager et de l'administrateur</h3>
		<p>Le manager et l'administrateur peuvent :</p>
		<ul>
			<li>créer et attribuer des tâches aux membres de leur équipe ;</li>
			<li>consulter la progression de l'équipe ;</li>
			<li>examiner, valider ou rejeter les livrables et les rapports soumis ;</li>
			<li>ajouter un commentaire explicatif en cas de rejet ;</li>
			<li>générer des synthèses de l'avancement des tâches de l'équipe.</li>
		</ul>

		<h3>3. Rôle spécifique de l'administrateur</h3>
		<p>L'administrateur dispose des droits les plus étendus. Il peut :</p>
		<ul>
			<li>gérer les comptes utilisateurs : création, activation et suspension ;</li>
			<li>attribuer les rôles Membre, Manager ou Administrateur.</li>
		</ul>
	</section>

	<section class="mb-5">
		<h2>V. Questions fréquentes</h2>

		<h3>Je n'ai pas reçu l'e-mail d'activation. Que faire ?</h3>
		<p>Vérifiez votre dossier de courriers indésirables. Si le problème persiste, contactez l'assistance ou l'administrateur.</p>

		<h3>J'ai oublié mon mot de passe. Comment le récupérer ?</h3>
		<p>Utilisez le lien <strong>Mot de passe oublié</strong> pour recevoir un e-mail de réinitialisation. Vous pouvez également contacter l'administrateur.</p>

		<h3>Pourquoi mon livrable a-t-il été rejeté ?</h3>
		<p>Consultez le commentaire du manager associé au livrable : il précise les corrections attendues.</p>

		<h3>Puis-je modifier un rapport déjà validé ?</h3>
		<p>Non. Un rapport validé ne peut plus être modifié. Seuls les rapports rejetés peuvent être corrigés et soumis à nouveau.</p>

		<h3>Comment savoir si mon compte a été activé ?</h3>
		<p>Vous recevrez un e-mail de confirmation lorsque votre compte sera activé. Vous pourrez alors vous connecter.</p>
	</section>

	<section class="mb-5">
		<h2>VI. Contact et assistance</h2>
		<p>Pour toute question ou difficulté lors de l'utilisation de CRSN Tasks :</p>
		<ul>
			<li>ouvrez le menu <strong>Aide</strong>, puis le <strong>Guide utilisateur</strong> ;</li>
			<li>contactez votre manager ou l'administrateur pour toute question concernant vos droits d'accès ou l'attribution de vos tâches.</li>
		</ul>
	</section>

	<footer class="border-top pt-3">
		<p class="mb-0">Guide utilisateur — CRSN Tasks</p>
	</footer>
</main>
</body>
</html>