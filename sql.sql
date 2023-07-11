create view laptopvue as (
    select 
    laptop.idreference,referencemarque.idprocesseur,marque.intitule as marque,referencemarque.intitule as reference,typeprocesseur.intitule as processeur,processeur.generation,referencemarque.ram,referencemarque.ecran,referencemarque.disquedur,referencemarque.prix,sum(laptop.qte) as qte
    from laptop 
    join referencemarque on referencemarque.id=laptop.idreference 
    join marque on marque.id=referencemarque.idmarque 
    join processeur on processeur.id=referencemarque.idprocesseur
    join typeprocesseur on processeur.idtypeprocesseur=typeprocesseur.id
    group by (laptop.idreference,referencemarque.idprocesseur,marque.intitule,referencemarque.intitule,typeprocesseur.intitule,processeur.generation,referencemarque.ram,referencemarque.ecran,referencemarque.disquedur,referencemarque.prix)
);

create view stockpointvente as(
    select transfert.idreference,referencemarque.idprocesseur,marque.intitule as marque,referencemarque.intitule as reference,typeprocesseur.intitule as processeur,processeur.generation,referencemarque.ram,referencemarque.ecran,referencemarque.disquedur,referencemarque.prix,sum(reception.qte) as qte,transfert.idpointvente
    from reception 
    join transfert on transfert.id=reception.idtransfert
    join referencemarque on referencemarque.id=transfert.idreference
    join marque on marque.id=referencemarque.idmarque 
    join processeur on processeur.id=referencemarque.idprocesseur
    join typeprocesseur on processeur.idtypeprocesseur=typeprocesseur.id 
    group by 
    (transfert.idreference,referencemarque.idprocesseur,marque.intitule,referencemarque.intitule,typeprocesseur.intitule,processeur.generation,referencemarque.ram,referencemarque.ecran,referencemarque.disquedur,referencemarque.prix,transfert.idpointvente);
);

create view transfertReference as(
    select idreference,sum(qte) from transfert group by (idreference)
);

create view renvoiReference as(
    select idreference,sum(qte) from renvoi group by (idreference)
);

create view venteReference as(
    select idreference,idpointvente,sum(qte) from vente group by (idreference,idpointvente)
);

create view renvoiReferenceP as(
    select idreference,idpointvente,sum(qte) from renvoi group by (idreference,idpointvente)
);

create view Perte as(
    select transfert.id,transfert.idpointvente,reception.datereception,transfert.qte as transfere,reception.qte as recu,transfert.qte-reception.qte as perdu,referencemarque.prixachat*(transfert.qte-reception.qte) as montant from transfert 
    join reception on transfert.id=reception.idtransfert 
    join referencemarque on referencemarque.id=transfert.idreference
);

create or replace view BeneficeVente as(
    select vente.*,referencemarque.prix*vente.qte as montant,referencemarque.prixachat*vente.qte as montantachat from vente  join referencemarque on referencemarque.id=vente.idreference
);

create view VueVente as(
    select BeneficeVente.*,referencemarque.intitule,(select extract(month from datevente)) as mois,(select extract(year from datevente)) as annee
    from BeneficeVente join referencemarque on referencemarque.id=beneficevente.idreference where supprime=0
);

create view VenteGlobal as(
    select extract(month from datevente) as mois,extract(year from datevente) as annee,sum(qte) as nb,sum(montant) as montant,sum(montantachat) as montantachat from beneficevente where supprime=0 group by (extract(month from datevente),extract(year from datevente)) order by mois
);

create view VentePointVente as(
    select extract(month from datevente) as mois,extract(year from datevente) as annee,idpointvente,sum(qte) as nb,sum(montant) as montantmontant,sum(montantachat) as montantachat from beneficevente group by (extract(month from datevente),idpointvente,extract(year from datevente)) order by mois
);

create view PerteMois as(
    select extract(month from datereception) as mois,extract(year from datereception) as annee,sum(montant) as montant from perte
    group by (extract(month from datereception),extract(year from datereception)) order by mois
);

create view PerteMoisPointVente as(
    select extract(month from datereception) as mois,extract(year from datereception) as annee,sum(montant) as montant,idpointvente
    from perte
    group by (extract(month from datereception),extract(year from datereception),idpointvente) order by mois
);

create view PerteMoisRenvoi as(
    select extract(month from daterenvoi) as mois,extract(year from daterenvoi) as annee,sum((qte-qterecu)*referencemarque.prixachat) as montant 
    from renvoi join referencemarque on referencemarque.id=renvoi.idreference
    group by (extract(month from daterenvoi),extract(year from daterenvoi))
);

create view PerteMoisRenvoiPointVente as(
    select extract(month from daterenvoi) as mois,extract(year from daterenvoi) as annee,sum((qte-qterecu)*referencemarque.prixachat) as montant,idpointvente 
    from renvoi join referencemarque on referencemarque.id=renvoi.idreference
    group by (extract(month from daterenvoi),extract(year from daterenvoi),idpointvente)
);