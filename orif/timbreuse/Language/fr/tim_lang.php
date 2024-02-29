<?php
return [
    'monday' => 'lundi',
    'tuesday' => 'mardi',
    'wednesday' => 'mercredi',
    'thursday' => 'jeudi',
    'friday' => 'vendredi',
    'rowMorning' =>  '07:00 à 12:30',
    'rowAfternoon' =>  '12:30 à 17:45',
    'hourly' => 'horaire',
    'firstEntry' => 'première entrée',
    'lastOuting' => 'dernière sortie',
    'time' => 'temps',
    'week' => 'semaine',
    'enter' => 'entrée',
    'exit' => 'sortie',
    'hour' => 'heure',
    'enter/exit' => 'entrée/sortie',
    'timeTotal' => 'temps total',
    'day' => 'jour',
    'week' => 'semaine',
    'month' => 'mois',
    'today' => 'aujourd’hui',
    'all' => 'tout',
    'weekTime' => 'temps total de la semaine',
    'delete' => 'supprimer',
    'cancel' => 'annuler',
    'confirm' => 'confirmer',
    'addAccess' => 'Voulez-vous ajouter l’autorisation au compte site web « %s » de contrôler les pointages du compte pointeuse « %s » ?',
    'deleteAccess' => 'Voulez-vous supprimer l’autorisation du compte site web « %s » de contrôler les pointages du compte pointeuse « %s » ?',
    'add' => 'ajouter',
    'ci_users_list_title' => 'Accès au compte pointeuse « %s »',
    'username' => 'nom d’utilisateur',
    'id_site' => 'id site',
    'access' => 'accès',
    'yes' => 'oui',
    'no' => 'non',
    'id' => 'id',
    'name' => 'prénom',
    'surname' => 'nom',
    'ciUsername' => 'nom d’utilisateur du compte site web',
    'modifyDate' => 'date de modification',
    'back' => 'retour',
    'modifyTime' => 'temps modifié',
    'modify' => 'modifier',
    'modified' => 'modifié',
    'msgAsterisk' => '✱Données saisies ou modifiées sur le site web',
    'siteData' => 'données du site',
    'new_record' => 'nouveau pointage',
    'record' => 'pointer',
    'confirmDelete' => 'Êtes-vous sûr·e de vouloir supprimer ce pointage.',
    'badgeId' => 'Numéro du badge',
    'idLog' => 'Identifiant du pointage',
    'badgeDate' => 'date de pointage physique sur une pointeuse',
    'deleteDate' => 'date de suppression',
    'recordModification' => 'Modification du pointage',
    'confirmRestore' => 'Êtes-vous sûr·e de vouloir restorer ce pointage.',
    'restore' => 'restaurer',
    'timUsers' => 'utilisateurs de la pointeuse',
    'webUsers' => 'utilisateurs du site web',
    'users' => 'utilisateurs',
    'details' => 'détails',
    'deleted' => 'supprimé',
    'timUserEdit' => 'Édition utilisateur de la pointeuse',
    'siteAccountLabel' => 'modifier le lien compte site web ⇋ compte pointeuse',
    'allocationBadgeLabel' => 'modifier l’attribution des badges',
    'siteStatus' => 'site',
    'badges' => 'badges',
    'erase' => 'effacer',
    'edit_badge' => 'modifier attribution du badge ID %s.',
    'dealloc' => 'désattribuer',
    'badgesList' => 'Badges',
    'timUsersList' => 'Utilisateurs de la pointeuse',
    'webUsersList' => 'Utilisateurs du site web',
    'timUserRelation' => 'utilisateur lié à ce badge',
    'badge_not_available' => 'Ce numéro de badge n’est pas disponible, merci de choisir dans la liste.',
    'user_not_available' => 'Cet utilisateur n’est pas disponible, merci de choisir dans la liste.',
    'confirmDeleteBadge' => 'Ce badge est attribuer à l’utilisateur « %s %s ».',
    'confirmDeleteTimUser' => ' Cet utilisateur est attribué au badge ID « %s ».',
    'titleConfirmDeleteBadge' => 'Supprimer le badge ID %s',
    'titleconfirmDeleteTimUser' => 'Supprimer l’utilisateur « %s %s »',
    'titlePlanning' => 'planning hebdomadaire %s',
    'titleNewPlanning' => 'Nouveau planning hebdomadaire %s',
    'dueTime' => 'temps exigé',
    'offeredTime' => 'temps offert',
    'titleList' => 'liste des plannings %s',
    'dateBegin' => 'valable du',
    'dateEnd' => 'au',
    'dateColide' => 'Il y a un chevauchement entre un planning existant et les dates que vous avez saisies.',
    'dateNotBefore' => 'La date de début est après la date de fin.',
    'errorDate' => 'Une erreur est survenue avec une date.',
    'errorNoTimAccess' => 'Votre compte n\'est pas relié à un utilisateur de la timbreuse, merci de contacter un administrateur.',
    'planning' => 'planning',
    'Defaultplanning' => 'Planning par défaut',
    'confirmDeletePlanning' => 'Êtes-vous sûr·e de vouloir supprimer ce planning ?',
    'confirmPurgeDeletePlanning' => 'Êtes-vous sûr·e de vouloir supprimer définitivement ce planning ?',
    'titleConfirmDeletePlanning' => 'Supprimer le planning ID %s',
    'confirmRestorePlanning' => 'Êtes-vous sûr·e de vouloir restaurer ce planning ?',
    'titleConfirmRestorePlanning' => 'Restaurer le planning ID %s',
    'dateColideRestore' => 'Il y a un chevauchement entre un planning existant et les dates du planning à restaurer.',
    'monthDetail' => '1er au 31 du mois',
    'balance' => 'balance',
    'showDeletedPlanning' =>'Afficher les plannings supprimés',
    'workTime' =>'Temps de travail',
    'unDefineDate' => '–',
    'planningExplanation1' => '<p>Le <strong>temps exigé</strong> correspond au temps de travail attendu. (temps à l’Orif + temps aux cours)<p> '
        . '<p>Le <strong>temps offert</strong> correspond au temps qui est automatiquement ajouté à votre temps de travail, en plus vos heures timbrées. (temps des pauses + temps aux cours)</p> '
        . '<p>Exemple pour une personne à 100 %  (41 heures sur 5 jours) : </p> ',
    'planningExplanation2' => '<li>Pour une <em>journée de travail</em> à l’Orif, on devra indiquer 8:12 pour le <strong>temps exigé</strong> et on devra indiquer 0:30 pour le <strong>temps offert</strong> (deux pauses de 15 min.).</li> '
        . '<li>Pour une <em>journée de cours</em>, on devra indiquer 8:12 pour le <strong>temps exigé</strong> et également 8:12 pour le <strong>temps offert</strong>.</li> '
        . '<li>Pour un <em>jour férié</em>, on devra indiquer 00:00 pour le <strong>temps exigé</strong> et également 00:00 pour le <strong>temps offert</strong>.</li> ',
    'help' => 'aide',
    'rate' => 'taux',
    'title' => 'titre',
    'fieldUserGroupId' => 'Numéro du groupe d\'utilisateurs',
    'fieldUserSyncId' => 'Numéro de l\'utilisateur timbreuse',
    'fieldUserGroupName' => 'Nom du groupe d\'utilisateurs',
    'fieldName' => 'Nom',
    'fieldGroupParentName' => 'Nom du groupe parent',
    'createUserGroupTitle' => 'Ajouter un groupe d\'utilisateurs',
    'updateUserGroupTitle' => 'Modifier un groupe d\'utilisateurs',
    'userGroupList' => 'Groupe d\'utilisateurs',
    'selectParentGroup' => 'Sélectionner un groupe parent',
];
