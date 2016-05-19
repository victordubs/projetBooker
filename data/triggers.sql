CREATE function f_artiste_delete()
returns trigger
as $$ begin
	if old.id is not null then
		delete from liaisonArtisteGroupe
		where idArtiste=old.id;
		delete from liaisonArtisteRole
		where idArtiste=old.id;
	end if;
	return old;
end;
 $$ language 'plpgsql';



CREATE TRIGGER t_artiste_delete
BEFORE DELETE
ON artiste
FOR EACH ROW
EXECUTE procedure f_artiste_delete();

------------------------------------------------------------------------------------
------------------------------------------------------------------------------------

CREATE function f_evenement_delete()
returns trigger
as $$ begin
	if old.id is not null then
		delete from liaisonGroupeEvenement
		where idGroupe=old.id;
	end if;
	return old;
end;
 $$ language 'plpgsql';



CREATE TRIGGER t_evenement_delete
BEFORE DELETE
ON evenement
FOR EACH ROW
EXECUTE procedure f_evenement_delete();



