<?php
/**
 * In questo file gestisco tutte le query utilizzate per estrapolare i dati.
 */

/** 
 * Variabile contenente tutti i prefissi utilizzati, i quali mi permettono inoltre di accedere a Wikidata per poter estrapolare dati aggiuntivi utili al popolamento della pagine web.
 */

$prefix = "PREFIX tmo: <http://www.semanticweb.org/bruno/ontologies/2020/1/music_ontology#>
      PREFIX wd: <http://www.wikidata.org/entity/>
      PREFIX wdt: <http://www.wikidata.org/prop/direct/>
      PREFIX owl: <http://www.w3.org/2002/07/owl#>
      PREFIX schema: <http://schema.org/>
      PREFIX : <http://www.semanticweb.org/bruno/ontologies/2020/1/music_ontology#>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX foaf: <http://xmlns.com/foaf/0.1/>
      PREFIX wikibase: <http://wikiba.se/ontology#>
   PREFIX bd: <http://www.bigdata.com/rdf#>";

/** 
 * Insieme di query che mi permettono di estrapolare i dati significativi dei vari elementi presenti nell'ontologia, i quali saranno poi visualizzati quando l'utente cercherà i singoli individui attraverso la barra di ricerca.
 */

$query_solo_search = $prefix . 'Select ?artista ?commento ?immagine
        WHERE { BIND ("' . $name . '" as ?name)
          ?artista rdf:type :Solo .
          ?artista rdfs:comment ?commento.
          ?artista :nome ?nome
          FILTER regex(?nome, ?name)
        BIND (?artista as ?tmoAgent)
          ?tmoAgent owl:sameAs ?Agent.
          SERVICE <https://query.wikidata.org/sparql> {
          OPTIONAL { ?Agent wdt:P18 ?immagine}
         }
        }';

$query_gruppo_search = $prefix . 'Select ?artista ?nomeGruppo ?commento ?immagine
        WHERE { BIND ("' . $name . '" as ?name)
          ?artista rdf:type :Gruppo .
          ?artista rdfs:comment ?commento.
          ?artista :nome ?nomeGruppo .
          FILTER regex(?nomeGruppo, ?name)
        BIND (?artista as ?tmoAgent)
          ?tmoAgent owl:sameAs ?Agent.
          SERVICE <https://query.wikidata.org/sparql> {
          OPTIONAL { ?Agent wdt:P18 ?immagine}
         }
        } LIMIT 1';

$query_album_search = $prefix . 'Select ?album ?nomeAlbum ?commento ?immagine
        WHERE { BIND ("' . $name . '" as ?name)
          ?album rdf:type :Album .
          ?album rdfs:comment ?commento.
          ?album :haTitolo ?nome
          FILTER regex(?nome, ?name)
        BIND (?album as ?tmoAgent)
          ?tmoAgent owl:sameAs ?Agent.
          SERVICE <https://query.wikidata.org/sparql> {
          OPTIONAL { ?Agent wdt:P18 ?immagine}
         }
        }';

$query_tracce_search = $prefix . 'Select distinct ?traccia ?commento ?nomeTraccia
        WHERE { BIND ("' . $name . '" as ?name)
          ?traccia rdf:type :Traccia .
          ?traccia rdfs:comment ?commento.
          ?traccia :titoloTraccia ?nomeTraccia
          FILTER regex(?nomeTraccia, ?name)
         }';

$query_disco_search = $prefix . 'Select distinct ?disco ?commento ?nomeDisco ?immagine
        WHERE { BIND ("' . $name . '" as ?name)
          ?disco rdf:type :CasaDiscografica .
          ?disco rdfs:comment ?commento.
          ?disco :nome_casaDiscografica ?nomeDisco
          FILTER regex(?nomeDisco, ?name)
          BIND (?disco as ?tmoAgent)
          ?tmoAgent owl:sameAs ?Agent.
          SERVICE <https://query.wikidata.org/sparql> {
          OPTIONAL { ?Agent wdt:P154 ?immagine}
         }
         }';

/** 
 * Insieme di query che mi permettono di estrapolare i dati significativi dei vari elementi da Wikidata, i quali saranno poi visualizzati quando l'utente visualizzera' la pagina web relativa all'individuo selezionato.
 */

$query_solo_wikidata = $prefix . 'Select ?Agent ?immagine ?sesso ?cittadinanza ?birthname ?instagram ?spotify
        WHERE { BIND (<' . $id . '> as ?id)
        ?id owl:sameAs ?Agent.
          SERVICE <https://query.wikidata.org/sparql> {
          OPTIONAL { ?Agent wdt:P18 ?immagine}
          OPTIONAL { ?Agent wdt:P21 ?sesso}
          OPTIONAL { ?Agent wdt:P27 ?cittadinanza}
          OPTIONAL { ?Agent wdt:P1477 ?birthname}
          OPTIONAL { ?Agent wdt:P2003 ?instagram}
           OPTIONAL { ?Agent wdt:P1902 ?spotify}
         }
        }';

$query_gruppo_wikidata = $prefix . 'Select ?Agent ?immagine ?paese ?fondazione ?instagram ?spotify
        WHERE { BIND (<' . $id . '> as ?id)
        ?id owl:sameAs ?Agent.
          SERVICE <https://query.wikidata.org/sparql> {
          OPTIONAL { ?Agent wdt:P18 ?immagine}
          OPTIONAL { ?Agent wdt:P495 ?paese}
          OPTIONAL { ?Agent wdt:P2031 ?fondazione}
          OPTIONAL { ?Agent wdt:P2003 ?instagram}
           OPTIONAL { ?Agent wdt:P1902 ?spotify}
         }
        }';

$query_album_wikidata = $prefix . 'Select ?Agent ?immagine ?dataPub ?instagram ?spotify
        WHERE { BIND (<' . $id . '> as ?id)
        ?id owl:sameAs ?Agent.
          SERVICE <https://query.wikidata.org/sparql> {
          OPTIONAL { ?Agent wdt:P18 ?immagine}
          OPTIONAL { ?Agent wdt:P577 ?dataPub}
          OPTIONAL { ?Agent wdt:P2003 ?instagram}
           OPTIONAL { ?Agent wdt:P1902 ?spotify}
         }
        }';

$query_disco_wikidata = $prefix . 'Select ?Agent ?logo ?paese ?fondazione
        WHERE { BIND (<' . $id . '> as ?id)
        ?id owl:sameAs ?Agent.
          SERVICE <https://query.wikidata.org/sparql> {
          OPTIONAL { ?Agent wdt:P154 ?logo.}
          OPTIONAL { ?Agent wdt:P17 ?paese.}
          OPTIONAL { ?Agent wdt:P571 ?fondazione.}
         }
        }';

/** 
 * Insieme di query che mi permettono di estrapolare, dalla nostra ontologia, i dati significativi relativi agli artisti, come ad esempio le tracce composte o gli album pubblicati.
 */

$query_album = $prefix . 'Select Distinct ?album ?nomeAlbum
WHERE { {
          Select ?album ?nomeAlbum
        WHERE { BIND (<' . $id . '> as ?artista)
          ?artista :ha_album ?album.
          ?album :haTitolo ?nomeAlbum
        }
    } UNION { 
Select ?album ?nomeAlbum WHERE { 
BIND (<' . $id . '> as ?artista)
          ?ruolo :artistaPartecipanteGruppo ?artista.
          ?ruolo :gruppoPartecipante ?gruppo .
          ?gruppo :ha_album ?album .
          ?album :haTitolo ?nomeAlbum
}}
}';

$query_etichetta = $prefix . 'Select Distinct ?casaDiscografica ?nomeEtichetta
WHERE { {
          Select ?casaDiscografica ?nomeEtichetta
          WHERE { 
        BIND (<' . $id . '> as ?artista)
          ?artista :ha_etichetta ?casaDiscografica .
          ?casaDiscografica :nome_casaDiscografica ?nomeEtichetta 
        }
    } UNION { 
Select ?casaDiscografica ?nomeEtichetta WHERE { 
BIND (<' . $id . '> as ?artista)
          ?ruolo :artistaPartecipanteGruppo ?artista.
          ?ruolo :gruppoPartecipante ?gruppo .
          ?gruppo :ha_etichetta ?casaDiscografica .
          ?casaDiscografica :nome_casaDiscografica ?nomeEtichetta
}}
}';

$query_faParteDiGruppo = $prefix . 'Select ?gruppo
        WHERE { BIND (<' . $id . '> as ?artista)
          ?ruolo :artistaPartecipanteGruppo ?artista.
          ?ruolo :gruppoPartecipante ?gruppo
        }';

$query_nomeArtista = $prefix . 'Select ?nome
        WHERE { BIND (<' . $id . '> as ?artista)
          ?artista rdfs:label ?nome
        }';

$query_generiArtistaOntologia = $prefix . 'Select Distinct ?id ?genere 
        WHERE { { select ?id ?genere WHERE { BIND (<' . $id . '> as ?id)
        ?album :album_di ?id.
        ?album :album_ha_traccia ?traccia.
        ?traccia :haGenere ?genere}
    } UNION { Select ?id ?genere
      WHERE {BIND (<' . $id . '> as ?id)
      ?id :performa ?traccia.
      ?traccia :haGenere ?genere}}}';

$query_genere_tot = $prefix .'Select distinct ?genere WHERE { {
    Select Distinct ?genere WHERE { 
        select ?genere WHERE { 
            BIND (<' . $id . '> as ?id)
        ?album :album_di ?id.
        ?album :album_ha_traccia ?traccia.
        ?traccia :haGenere ?genere
        }
    }
    } UNION { 
       Select ?id ?genere
       WHERE {
BIND (<' . $id . '> as ?id)
      ?id :performa ?traccia.
                ?traccia :haGenere ?genere
    }
    } UNION {
                Select distinct ?genere
        WHERE { BIND (<' . $id . '> as ?artista)
          ?ruolo :artistaPartecipanteGruppo ?artista.
          ?ruolo :gruppoPartecipante ?gruppo .
          ?gruppo :ha_album ?album .
          ?album :album_ha_traccia ?traccia .
          ?traccia :haGenere ?genere
        }    
    }}';

$query_generi_gruppo = 

$query_generiGruppoArtista = $prefix . 'Select distinct ?genere
        WHERE { BIND (<' . $id . '> as ?artista)
          ?ruolo :artistaPartecipanteGruppo ?artista.
          ?ruolo :gruppoPartecipante ?gruppo .
          ?gruppo :ha_album ?album .
          ?album :album_ha_traccia ?traccia .
          ?traccia :haGenere ?genere
        }';

$query_gruppo_membri = $prefix . 'select DISTINCT ?artista ?nomeArtista ?gruppo
          WHERE { BIND (<' . $id . '> as ?gruppo)
          ?ruolo :gruppoPartecipante ?gruppo .
          ?ruolo :artistaPartecipanteGruppo ?artista .
          ?artista :nome ?nomeArtista }';

$query_SoloPerformer_album = $prefix . 'select ?artista ?nomeArtista
          WHERE { BIND (<' . $id . '> as ?album)
          ?album :album_di ?artista .
          ?artista :nome ?nomeArtista .
          ?artista rdf:type :Solo  }';

$query_GruppoPerformer_album = $prefix . 'select ?artista ?nomeArtista
          WHERE { BIND (<' . $id . '> as ?album)
          ?album :album_di ?artista .
          ?artista :nome ?nomeArtista .
          ?artista rdf:type :Gruppo  }';

/** 
 * Insieme di query che mi permettono di estrapolare, dalla nostra ontologia, i dati significativi relativi agli album, come ad esempio le tracce contenute in essi.
 */


$query_album_release_performer_nome = $prefix . 'select ?release ?titoloAlbum ?numero
        WHERE { BIND (<' . $id . '> as ?album)
        ?album :pubblicato_in ?release.
        ?album :haTitolo ?titoloAlbum.
        ?album :numeroTracce ?numero }';

$query_tracce_album = $prefix . 'select ?traccia ?nomeTraccia
        WHERE { BIND (<' . $id . '> as ?album)
        ?album :album_ha_traccia ?traccia.
        ?traccia :titoloTraccia ?nomeTraccia
        }';

$query_performer_album = $prefix . 'select ?artista ?nomeArtista ?tipo
        WHERE { BIND (<' . $id . '> as ?album)
        ?album :album_di ?artista.
        ?artista :nome ?nomeArtista.
        ?artista rdf:type ?tipo .
        MINUS {
          ?artista a ?t1, ?tipo.
          ?t1 rdfs:subClassOf ?tipo.
        } }';

$query_genere_album = $prefix . 'select DISTINCT ?genere
        WHERE { BIND (<' . $id . '> as ?album)
          ?album :album_ha_traccia ?traccia .
          ?traccia :haGenere ?genere
        }';

/** 
 * Insieme di query che mi permettono di estrapolare, dalla nostra ontologia, i dati significativi relativi ai generi, come ad esempio le tracce che afferiscono ad essi.
 */

$query_tracce_per_genere = $prefix . 'select DISTINCT ?traccia ?titoloTraccia ?genere
          WHERE { BIND ("' . $id . '" as ?genere)
          ?traccia rdf:type :Traccia .
          ?traccia :titoloTraccia ?titoloTraccia .
          ?traccia :haGenere ?generea .
          FILTER regex(?generea, ?genere)
        } LIMIT 10';

$query_album_per_genere = $prefix . 'select DISTINCT ?album ?titoloAlbum
        WHERE { BIND ("' . $id . '" as ?genere)
        ?album rdf:type :Album .
          ?album :album_ha_traccia ?traccia .
        ?album :haTitolo ?titoloAlbum.
          ?traccia :haGenere ?generea 
        FILTER regex(?generea, ?genere)
        }';

$query_artisti_per_genereSolo = $prefix . 'Select distinct ?artista ?nomeArtista WHERE {{
Select distinct ?artista ?nomeArtista WHERE { 
BIND ("' . $id . '" as ?genere)
          ?traccia rdf:type :Traccia .
          ?traccia :haGenere ?genere .
          ?traccia :performata_da ?artista .
          ?artista :nome ?nomeArtista .
          ?artista rdf:type :Solo .
}
    } UNION {
        Select distinct ?artista ?nomeArtista WHERE { 
BIND ("' . $id . '" as ?genere)
          ?traccia rdf:type :Traccia .
          ?traccia :haGenere ?genere .
          ?traccia :traccia_di_album ?album .
          ?album :album_di ?artista .
          ?artista rdf:type :Solo .
          ?artista :nome ?nomeArtista }
}
    }';

$query_artisti_per_genereGruppi = $prefix . 'Select distinct ?artista ?nomeArtista WHERE { 
BIND ("' . $id . '" as ?genere)
          ?traccia rdf:type :Traccia .
          ?traccia :haGenere ?genere .
          ?traccia :traccia_di_album ?album .
          ?album :album_di ?artista .
          ?artista :nome ?nomeArtista 
          MINUS {
          ?artista rdf:type :Solo.
        }}';

/** 
 * Insieme di query che mi permettono di estrapolare, dalla nostra ontologia, i dati significativi relativi alle tracce, come ad esempio la durata, il nome e il performer.
 */


$query_data_traccia = $prefix . 'select ?traccia ?titoloTraccia ?album ?titoloAlbum ?bpm ?genere ?scala ?durata ?precedente ?successiva ?titoloPrecedente ?titoloSuccessiva ?release ?nomeRelease ?canzone ?nomeCanzone
        WHERE { BIND (<' . $id . '> as ?traccia)
          ?traccia :titoloTraccia ?titoloTraccia .
          OPTIONAL { ?traccia :haGenere ?genere. }
          OPTIONAL { ?traccia :haDurata ?durata. }
          OPTIONAL { ?traccia :haBPM ?bpm. }
          OPTIONAL { ?traccia :haScala ?scala. }
          OPTIONAL { ?traccia :traccia_di_album ?album . }
          OPTIONAL { ?album :haTitolo ?titoloAlbum .}
          OPTIONAL {?traccia :traccia_precedente ?precedente .}
          OPTIONAL {?precedente :titoloTraccia ?titoloPrecedente .}
          OPTIONAL {?traccia :traccia_successiva ?successiva. }
          OPTIONAL {?successiva :titoloTraccia ?titoloSuccessiva. }
          OPTIONAL {?traccia :pubblicato_in ?release.}
          OPTIONAL {?release :nomeRelease ?nomeRelease. }
          OPTIONAL {?traccia :traccia_realizza ?canzone. }
          OPTIONAL {?canzone :titoloCanzone ?nomeCanzone }
        }';

$query_album_traccia = $prefix . 'select ?album ?nomeAlbum
            WHERE { BIND (<' . $id . '> as ?traccia)
          ?traccia :traccia_di_album ?album .
          ?album :haTitolo ?nomeAlbum
      }';

$query_traccia_prec_succ = $prefix . 'select ?successiva ?nomeSuccessiva ?precedente ?nomePrecedente
            WHERE { BIND (<' . $id . '> as ?traccia)
          ?traccia :traccia_successiva ?successiva.
          ?successiva :titoloTraccia ?nomeSuccessiva.
          ?traccia :traccia_precedente ?precedente.
          ?precedente :titoloTraccia ?nomePrecedente.
      }';

$query_generi_traccia = $prefix . 'select ?genere
            WHERE { BIND (<' . $id . '> as ?traccia)
          ?traccia :haGenere ?genere
      }';

$query_release_traccia = $prefix . 'select ?release ?nomeRelease
            WHERE { BIND (<' . $id . '> as ?traccia)
          ?traccia :traccia_di_album ?album .
          ?album :pubblicato_in ?release .
          ?release :nomeRelease ?nomeRelease
      }';

$query_gruppi_traccia = $prefix . 'select ?artistaF ?artistaFNome
            WHERE { BIND (<' . $id . '> as ?traccia)
         ?traccia :ha_featuring ?artistaF. 
          ?artistaF :nome ?artistaFNome. 
          ?artistaF rdf:type :Gruppo
      }';

$query_solo_traccia = $prefix . 'select ?artistaF ?artistaFNome
            WHERE { BIND (<' . $id . '> as ?traccia)
         ?traccia :ha_featuring ?artistaF. 
          ?artistaF :nome ?artistaFNome. 
         ?artistaF rdf:type :Solo 
      }';

$query_performer_solo = $prefix . 'select DISTINCT ?traccia ?artista ?nomeArtista
   WHERE {{
          select DISTINCT ?traccia ?artista ?nomeArtista WHERE { 
          BIND (<' . $id . '> as ?traccia)
        ?traccia :performata_da ?artista .
        ?artista rdf:type :Solo .
        ?artista :nome ?nomeArtista
          }}
      UNION {
          select DISTINCT ?traccia ?artista ?nomeArtista WHERE { 
          BIND (<' . $id . '> as ?traccia)
        ?traccia :traccia_di_album ?album .
        ?album :album_di ?artista .
        ?artista rdf:type :Solo .
          ?artista :nome ?nomeArtista
          }}
      }
   ';

$query_performer_gruppo = $prefix . 'select DISTINCT ?traccia ?artista ?nomeArtista
   WHERE {{
          select DISTINCT ?traccia ?artista ?nomeArtista WHERE { 
          BIND (<' . $id . '> as ?traccia)
        ?traccia :performata_da ?artista .
        ?artista :nome ?nomeArtista .
        ?artista rdf:type :Gruppo .
          }}
      UNION {
          select DISTINCT ?traccia ?artista ?nomeArtista WHERE { 
          BIND (<' . $id . '> as ?traccia)
        ?traccia :traccia_di_album ?album .
        ?album :album_di ?artista .
          ?artista :nome ?nomeArtista .
          ?artista rdf:type :Gruppo
          }}
      }
   ';

/** 
 * Insieme di query che mi permettono di estrapolare, dalla nostra ontologia, i dati significativi relativi alle release, come ad esempio la casa discografica coinvolta.
 */

$query_data_release = $prefix . 'select ?nomeRelease ?casa ?nomeCasa ?data ?supporto
        WHERE { BIND (<' . $id . '>  as ?release)
          ?release :nomeRelease ?nomeRelease .
        ?release :data ?data .
        ?release :pubblicata_da ?casa .
        ?casa :nome_casaDiscografica ?nomeCasa .
        ?release :haSupporto ?supporto
      }';

/** 
 * Insieme di query che mi permettono di estrapolare, dalla nostra ontologia, i dati significativi relativi alle Case Discografiche, come ad esempio gli album pubblicati e gli artisti sotto contratto.
 */

$query_disco_release = $prefix . 'select ?release
        WHERE { BIND (<' . $id . '> as ?disco)
          ?disco :pubblica ?release .
      }';

$query_disco_nome = $prefix . 'select ?nomeDisco
        WHERE { BIND (<' . $id . '> as ?disco)
          ?disco :nome_casaDiscografica ?nomeDisco
      }';

$query_disco_performerSolo = $prefix . 'select ?artista ?nomeArtista
        WHERE { BIND (<' . $id . '> as ?disco)
          ?disco :ha_contrattato ?artista .
          ?artista rdf:type :Solo .
          ?artista :nome ?nomeArtista
          }';

$query_disco_performerGruppo = $prefix . 'select ?artista ?nomeArtista
        WHERE { BIND (<' . $id . '> as ?disco)
          ?disco :ha_contrattato ?artista .
          ?artista rdf:type :Gruppo .
          ?artista :nome ?nomeArtista
          }';

/** 
 * Insieme di query che mi permettono di estrapolare, dalla nostra ontologia, i dati significativi relativi alle canzoni, come ad esempio le tracce/cover tratte da essa.
 */

$query_data_canzone = $prefix . 'select ?canzone ?nomeCanzone
        WHERE { BIND (<' . $id . '> as ?traccia)
          ?traccia :realizzata_da ?canzone .
          ?canzone :nomeCanzone ?nomeCanzone 
          }';

$query_data_canzoneTraccia = $prefix . 'select distinct ?canzone ?nomeCanzone ?traccia ?nomeTraccia ?artista ?nomeArtista WHERE {{
select ?canzone ?nomeCanzone ?traccia ?nomeTraccia ?artista ?nomeArtista
        WHERE { BIND (<' . $id . '> as ?canzone)
          ?canzone :canzone_realizzata_da ?traccia .
          ?traccia :traccia_di_album ?album .
          ?album :album_di ?artista .
          ?artista :nome ?nomeArtista .
          ?traccia :titoloTraccia ?nomeTraccia .
          ?canzone :titoloCanzone ?nomeCanzone
          }
        } UNION {
               select ?canzone ?nomeCanzone ?traccia ?nomeTraccia ?artista ?nomeArtista
        WHERE { BIND (<' . $id . '> as ?canzone)
          ?canzone :canzone_realizzata_da ?traccia .
          ?traccia :performata_da ?artista .
          ?traccia :titoloTraccia ?nomeTraccia .
          ?artista :nome ?nomeArtista 
          } 
        }
        }';

$query_singoli_pubblicati = $prefix . 'select ?traccia ?nomeTraccia
        WHERE { BIND (<' . $id . '> as ?artista)
          ?artista :performa ?traccia .
          ?traccia :titoloTraccia ?nomeTraccia
          }';

$query_nomeCanzone = $prefix . 'select ?nomeCanzone
        WHERE { BIND (<' . $id . '> as ?canzone)
          ?canzone :titoloCanzone ?nomeCanzone 
          }';

$query_data_performataDa = $prefix . 'select ?canzone ?nomeCanzone ?traccia ?nomeTraccia ?artista ?nomeArtista
        WHERE { BIND (<' . $id . '> as ?canzone)
          ?canzone :canzone_realizzata_da ?traccia .
          ?traccia :performata_da ?artista .
          ?artista :nome ?nomeArtista .
          ?traccia :titoloTraccia ?nomeTraccia .
          ?canzone :titoloCanzone ?nomeCanzone
          }';

/** 
 * Funzione utilizzata per estrarre e visualizzare correttamente il nome della label ottenuta da Wikidata.
 */

function getWikiDataLabel($individual)
{
    $individual = str_replace("http://www.wikidata.org/entity/", "", $individual);
    $json       = file_get_contents('https://www.wikidata.org/w/api.php?action=wbgetentities&props=labels&format=json&ids=' . $individual . '&languages=it');
    $data       = json_decode($json, true);
    return $data['entities'][$individual]['labels']['it']['value'];
}

?>