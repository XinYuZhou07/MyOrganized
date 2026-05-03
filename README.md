# MyOrganized – Daily Planner Personalizzato

MyOrganasied è un **daily planner intelligente e personalizzabile** che aiuta studenti, lavoratori e persone impegnate a organizzare la giornata in modo semplice e visivo.

In base alle risposte iniziali, il sistema genera una **giornata tipo** con:
- Calendario
- To-do list giornaliera
- Note  
e permette di aggiungere moduli extra (studio, fitness, lavoro, benessere, spiritualità, ecc.) per adattare il planner alla vita reale dell’utente.

---

## 0. Stack Tecnologico

**Frontend**
- HTML
- CSS
- Bootstrap / Tailwind (per la parte UI responsiva)

**Backend**
- JavaScript

**Database**
- MySQL

**Autenticazione**
- JWT (JSON Web Token)

---

## 1. Descrizione Generale della Funzionalità

La funzionalità principale del sito è un **daily planner personalizzato**.

### Idea di base

1. L’utente risponde a una serie di domande iniziali.
2. Il sistema genera un **planner base** con alcune sezioni standard:
   - Calendario
   - To-do list giornaliera
   - Note
3. L’utente può poi **aggiungere o rimuovere moduli** da diverse categorie, ad esempio:
   - Studio
   - Fitness
   - Lavoro
   - Benessere
   - Spiritualità / religione
   - Altro (hobby, vita personale, ecc.)

### Esempi di profili / moduli

- **Studente**
  - Voti / media
  - Blocchi di studio e ripasso

- **Appassionato di Fitness**
  - Tracker pasti
  - Allenamenti, passi, progressi

- **Venditore / Lavoratore**
  - Andamento vendite
  - Turni di lavoro / attività principali

Appena l’utente arriva sul sito, viene guidato da una breve “intervista” che aiuta il sistema a capire chi è e cosa gli serve.

---

## 2. Domande Iniziali (Raccolta Esigenze Utente)

All’ingresso, il sito propone una serie di domande per costruire un planner **sensato e non casuale**.

### Chi sei?

- Studente
- Studente-lavoratore
- Lavoratore a tempo pieno

### Quali sono le tue priorità?

- Studio / compiti
- Fitness / allenamento
- Lavoro / part-time
- Casa / faccende
- Tempo per sé (hobby, amici)
- Spiritualità / religione

### Quanto tempo hai al giorno?

- Mattina libera?
- Pomeriggio occupato?
- Solo sera?

### Quali obiettivi vuoi aggiungere al planner?

- Migliorare i voti
- Fare attività fisica regolare
- Seguire una routine di studio
- Dormire a orari più regolari
- Avere più tempo per il relax

---

## 3. Attività Principali dell’Utente

Dopo la raccolta delle informazioni, l’utente può:

- **Visualizzare** il daily planner base proposto dal sistema.
- **Modificare** i blocchi della giornata:
  - Cambiare orario di studio
  - Spostare l’allenamento
  - Aggiungere “tempo libero”, relax, hobby, ecc.
- **Aggiungere moduli/categorie opzionali**, ad esempio:
  - **Modulo Studente** → studio, compiti, ripasso verifiche, progetti
  - **Modulo Fitness** → allenamento, stretching, passi giornalieri, idratazione
  - **Modulo Lavoro** → turni, orari, pause, task principali
  - **Modulo Casa** → pulizie, commissioni, spesa, ordine
  - **Modulo Spiritualità** → momenti di preghiera/meditazione, lettura testi
- **Inserire obiettivi giornalieri** (to-do list collegata ai vari blocchi della giornata).
- **Salvare il planner personalizzato** per riutilizzarlo e modificarlo nei giorni successivi.

---

## 4. User Personas

### Sara – La studentessa con troppe verifiche
- **Età:** 17 anni  
- **Profilo:** Studentessa di scuola superiore  
- **Obiettivi:** Migliorare i voti, organizzare studio e verifiche, ridurre lo stress  
- **Problemi:**
  - Studia spesso all’ultimo
  - Ha orari scolastici variabili
  - Si dimentica compiti e scadenze  
- **Bisogni dal planner:**
  - Planner semplice e chiaro
  - Spazi dedicati a studio, verifiche e ripasso
  - Moduli extra per organizzare scuola + vita personale

---

### Luca – Il ragazzo che si allena e lavora part-time
- **Età:** 19 anni  
- **Profilo:** Universitario e dipendente part-time  
- **Obiettivi:** Incastrare studio, lavoro e palestra  
- **Problemi:**
  - Turni di lavoro che cambiano spesso
  - Nessuna routine fitness stabile
  - Rischio burnout per troppi impegni  
- **Bisogni dal planner:**
  - Modulo “Lavoro” per segnare i turni
  - Modulo “Fitness” con blocchi allenamento
  - Planner flessibile e modificabile al volo

---

### Martina – Vuole migliorare la sua routine
- **Età:** 21 anni  
- **Profilo:** Lavoratrice full-time  
- **Obiettivi:** Dormire meglio, fare più movimento, trovare tempo per sé  
- **Problemi:**
  - Giornate disorganizzate
  - Poco equilibrio lavoro/vita privata
  - Salta pasti o si dimentica di bere  
- **Bisogni dal planner:**
  - Modulo “Benessere” (acqua, pasti, sonno)
  - Reminder e obiettivi giornalieri
  - Planner che non sembri “solo scolastico”

---

### Yassin – Tiene molto alla spiritualità
- **Età:** 18 anni  
- **Profilo:** Studente-lavoratore  
- **Obiettivi:** Equilibrio tra studio, famiglia e spiritualità  
- **Problemi:**
  - Difficoltà a conciliare scuola, fede e vita sociale
  - Si dimentica di fare pause e arriva stanco a fine giornata  
- **Bisogni dal planner:**
  - Modulo “Spiritualità”
  - Orari completamente personalizzabili
  - Planner che rispetti le sue esigenze culturali

---

### Chiara – L’ansiosa organizzativa
- **Età:** 16 anni  
- **Profilo:** Studentessa  
- **Obiettivi:** Ridurre ansia e senso di caos  
- **Problemi:**
  - Ha bisogno di vedere tutto nero su bianco
  - Si dimentica spesso le attività
  - Si sente persa senza un programma chiaro  
- **Bisogni dal planner:**
  - Planner pulito e visivamente ordinato
  - To-do list con spunte
  - Possibilità di aggiungere note veloci

---

### Ahmed – L’atleta disciplinato
- **Età:** 20 anni  
- **Profilo:** Studente universitario + atleta  
- **Obiettivi:** Ottimizzare allenamenti, gestire studio, monitorare progressi  
- **Problemi:**
  - Ha tanti impegni ma fatica a incastrarli
  - Gli serve una visione precisa della giornata  
- **Bisogni dal planner:**
  - Modulo fitness avanzato
  - Spazi per tracking (passi, ripetizioni, tempi)
  - Planner che supporti performance e costanza

---

## 5. Organizzazione delle Feature

### Feature principale
- **Daily planner personalizzabile**

### Sotto-feature

#### 5.1 Onboarding / Intervista iniziale
- Schermata con domande guidate
- Scelta del profilo (studente, lavoratore, studente-lavoratore, ecc.)
- Scelta delle priorità (studio, fitness, lavoro, benessere, spiritualità…)

#### 5.2 Generazione planner base
- Creazione automatica di una struttura tipo:
  - **Mattina:** scuola / lavoro
  - **Pomeriggio:** studio / allenamento
  - **Sera:** relax / famiglia / hobby
- Struttura adattata alle risposte dell’utente

#### 5.3 Moduli aggiuntivi
Ogni modulo aggiunge sezioni specifiche al planner:

- **Modulo Studente**
  - Compiti
  - Ripasso verifiche
  - Progetti

- **Modulo Fitness**
  - Allenamenti
  - Idratazione
  - Passi / attività

- **Modulo Lavoro**
  - Turni
  - Pause
  - Attività principali

- **Modulo Casa**
  - Faccende
  - Spesa
  - Ordine camera / casa

- **Modulo Spiritualità**
  - Momenti di preghiera
  - Lettura testi sacri
  - Riflessione personale

#### 5.4 Editor del planner
- Modifica blocchi con un click
- Cambia orario, nome del blocco, durata
- Aggiunge note e obiettivi collegati a ogni blocco

#### 5.5 Salvataggio e visualizzazione
- Salvataggio del planner dell’utente
- Pagina “Il mio planner” per rivedere, aggiornare e riutilizzare il template creato

---

## 6. Valutazione: il planner è effettivamente efficace?

### Risponde ai bisogni reali?
Sì. Il planner parte da **domande concrete** sulla vita dell’utente (scuola, lavoro, obiettivi personali) invece di proporre un modello generico.

### È abbastanza flessibile?
Sì, perché:
- Fornisce una **base guidata** per chi non sa da dove iniziare.
- Permette di **aggiungere/rimuovere moduli**, ideale per chi vuole un alto livello di personalizzazione.

### È adatto a diversi tipi di utenti?
Sì. Il sistema è pensato per:
- Studenti
- Lavoratori
- Persone che si allenano
- Chi vuole dedicare tempo alla spiritualità o al benessere  
La personalizzazione avviene tramite moduli e priorità selezionate.

### L’AI migliora davvero l’esperienza?
Sì, perché l’AI può:
- Aiutare a costruire un planner sensato in pochi passaggi.
- Suggerire una distribuzione equilibrata degli impegni per evitare sovraccarico.
- Adattare il planner quando gli impegni cambiano (es. nuovi turni, esami, eventi).

---

*(TODO: se necessario, aggiungere una sezione “Come eseguire il progetto” con istruzioni per installazione, setup DB, variabili d’ambiente e comandi di avvio.)*
