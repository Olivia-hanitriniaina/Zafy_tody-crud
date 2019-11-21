
--********************** Fiche de visite station services

SELECT * FROM network_visit AS reseau join codir_users as users on reseau.visitor_id = users.id 
join codir_locals as type on reseau.gas_station_id = type.id

SELECT * FROM codir_users
