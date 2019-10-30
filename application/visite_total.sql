DROP TABLE IF EXISTS visite_station_service;
DROP TABLE IF EXISTS incontournable;
DROP TABLE IF EXISTS questionnaire_label;
DROP TABLE IF EXISTS questionnaire_type;
Drop TABLE IF EXISTS questionnaire_answer;

CREATE TABLE IF NOT EXISTS visite_station_service (
  id_visite_station_service int(11) NOT NULL AUTO_INCREMENT primary key,
  date_visite Date,
  id_station int(11),
  gerant varchar(200),
  id_users int(11),
  FOREIGN KEY (id_station) REFERENCES station_service(id_station),
  FOREIGN KEY (id_users) REFERENCES users(id_users)
);

CREATE TABLE IF NOT EXISTS incontournable (
    id_incontournable_visite int(11) NOT NULL AUTO_INCREMENT PRIMARY key,
    id_visite_station_service int(11),
    nom_incontournable varchar(200),
    FOREIGN KEY (id_visite_station_service) REFERENCES incontournable_station (id_visite_station_service)
);
CREATE TABLE IF NOT EXISTS questionnaire_label (
  id_questionnaire_label int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_incontournable_visite int(11),
  questionnaire text,
  FOREIGN KEY (id_incontournable_visite) REFERENCES incontournable(id_incontournable_visite)
);

CREATE TABLE IF NOT EXISTS questionnaire_type (
  id_questionnaire_type int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_questionnaire_label int(11),
  type_question varchar (200),
  FOREIGN KEY (id_questionnaire_label) REFERENCES questionnaire_label(id_questionnaire_label)
);

CREATE TABLE IF NOT EXISTS questionnaire_answer (
  id_questionnaire_answer int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_questionnaire_label int(11),
  answer VARCHAR(200),
  FOREIGN KEY (id_questionnaire_label) REFERENCES questionnaire_label(id_questionnaire_label)
);
