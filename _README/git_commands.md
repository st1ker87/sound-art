
**inizio progetto da remoto**
*creazione repo vuota su github con repo-url*
[owner-user] https://github.com/{user}/{repo}.git
*creazione collaborazione*
[collaborator] accetta invito owner-user (email o repo-url in browser)
*download in locale di repo con creazione di local/master*
[collaborator] git clone https://github.com/{user}/{repo}.git

**inizio progetto da locale**
*dentro cartella progetto*
git init
*file readme*
git add README
*stage + commit*
git add .
git commit -m 'commit message'
*creazione in remoto della repo*
git remote add origin https://github.com/{user}/{repo}.git
*creazione in remooto della master branch*
git push -u origin master
*clonazione in locale della repo*
git clone https://github.com/{user}/{repo}.git

╭----------╮          ╭----------╮
|  origin  |          |  origin  |
|  master  |          |   task   |
╰----------╯          ╰----------╯
    ︱🡡                  🡡︱
    ︱︱               (1)︱︱
    ↓︱                  ︱↓
╭----------╮          ╭----------╮
|  local   | ------🡢 |  local   |
|  master  | 🡠------ |  task    |
╰----------╯          ╰----------╯

**creazione branch**
*aggiunta in locale branch task + switch su branch task*
[local/master] git checkout -b task
*aggiunta in remoto del branch task (-u equivale a --set-upstream)*
[local/task] git push -u origin task
[local/task] git push --set-upstream origin task

**inizio task su branch parallelo (task)**
*switch su branch local/master*
[local/task] git checkout master
*aggiornamento local/master allo stato di origin/master*
[local/master] git pull
*switch su branch parallelo*
[local/master] git checkout task
*aggiornaramento branch parallelo allo stato di origin/master*
[local/task] git merge origin/master 

**attività su branch parallelo (task)**
*controllo branch di lavoro*
[local/task] git branch
*controllo branch con messaggio ultimo commit*
[local/task] git branch -vv
*controllo stato di lavoro sul local/task*
[local/task] git status
*stage modifiche, singolo file o tutti i file*
[local/task] git add file_name
[local/task] git add .
*commit modifiche con messaggio*
[local/task] git commit -m 'messgge'
*stage + commit modifiche con messaggio*
[local/task] git commit -am 'messgge'
*aggiornamento origin/task*
[local/task] git push

**abbandonare modifiche locali su branch task**
*ricezione in locale dello stato di origin/task per riferiemento*
[local/task] git fetch
*sovrascrittura local/task con il riferimento origin/task*
[local/task] git reset --hard origin/task

**fine task su branch task**
*switch su local/master*
[local/task] git checkout master
*aggiornamento local/master*
[local/master] git merge task
*aggiornamento origin/master*
[local/master] git push

**log grafici flusso sviluppo**
*grafico con minor dettaglio*
git log --graph --decorate --oneline
*grafico con maggior dettaglio*
git log --graph --all --simplify-by-decoration


----------------------------------------------------------
DA CAPIRE MEGLIO

git pull origin master --allow-unrelated-histories

git push origin --delete prova







------------------------------------------------------------------------------
🡣🡡🡢🡠︱
╭ ╮ ╰ ╯

━ ┏ ┛ ┗ ┓ ┃ ┫ ╋ ┣ ︱ ┻ ┳ ,  ╱ and ═ ╔ ╝ ╚ ╗ ║ ╣ ╬ ╠ ─ ╩ ╦


 